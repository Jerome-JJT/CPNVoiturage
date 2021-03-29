<?php


function validateEDT($post)
{
  if(isset($post["data"]))
  {
    $data = str_getcsv($post["data"], "\n");

    $headers = str_getcsv($data[0], "\t");
    array_shift($data);

    $verifyHeaders = array("ABREV.", "JOUR", "HEURE", "DURÉE");

    $profCanvas = array(
      "ACRO" => "",
      "monArr" => null,
      "monDep" => null,
      "tueArr" => null,
      "tueDep" => null,
      "wedArr" => null,
      "wedDep" => null,
      "thuArr" => null,
      "thuDep" => null,
      "friArr" => null,
      "friDep" => null,
    );

    $_SESSION["edtData"] = array();
    foreach($data as $line)
    {
      $line = array_combine($headers, str_getcsv($line, "\t"));
      $flag = true;

      //Verify columns
      foreach ($verifyHeaders as $header)
      {
        if(!isset($line[$header]) || $line[$header] == "")
        {
          $flag = false;
        }
      }
      if(!$flag)
      {
        continue;
      }

      //Convert full name in day id
      $dayId = "";
      switch ($line["JOUR"]) {
        case 'lundi':
          $dayId = "mon";
          break;

        case 'mardi':
          $dayId = "tue";
          break;

        case 'mercredi':
          $dayId = "wed";
          break;

        case 'jeudi':
          $dayId = "thu";
          break;

        case 'vendredi':
          $dayId = "fri";
          break;

        default:
          $flag = false;
      }
      if(!$flag)
      {
        continue;
      }



      $line["HEURE"] = intval(explode("h", $line["HEURE"])[0]);
      $line["DURÉE"] = intval(explode("h", $line["DURÉE"])[0]);
      $search = array_search($line["ABREV."], array_column($_SESSION["edtData"], "ACRO"));

      //If user isn't processed, create array entry
      if($search === false)
      {
        array_push($_SESSION["edtData"], $profCanvas);

        $search = count($_SESSION["edtData"])-1;
        $_SESSION["edtData"][$search]["ACRO"] = $line["ABREV."];
      }


      //Get current arrival, departure hour
      $arr = $_SESSION["edtData"][$search][$dayId."Arr"];
      $dep = $_SESSION["edtData"][$search][$dayId."Dep"];

      //Compare if hour is earlier than arrival or later than departure
      if($arr == null || $arr > $line["HEURE"])
      {
        $_SESSION["edtData"][$search][$dayId."Arr"] = $line["HEURE"];
      }
      if($arr == null || $dep < $line["HEURE"]+$line["DURÉE"])
      {
        $_SESSION["edtData"][$search][$dayId."Dep"] = $line["HEURE"]+$line["DURÉE"];
      }
    }

    require("view/admin.php");
  }
}




function executeEDT()
{
  if(isset($_SESSION["edtData"]))
  {
    require_once("model/dbConnector.php");

    foreach($_SESSION["edtData"] as $line)
    {
      $upsertQuery = "INSERT INTO EDT (acronym, monArr, monDep, tueArr, tueDep, wedArr, wedDep, thuArr, thuDep, friArr, friDep)
      VALUES (:acronym, :monArr, :monDep, :tueArr, :tueDep, :wedArr, :wedDep, :thuArr, :thuDep, :friArr, :friDep)
      ON CONFLICT(acronym) DO
      UPDATE SET (monArr, monDep, tueArr, tueDep, wedArr, wedDep, thuArr, thuDep, friArr, friDep)=
      (:monArr, :monDep, :tueArr, :tueDep, :wedArr, :wedDep, :thuArr, :thuDep, :friArr, :friDep);";

      $upsertData = array(":acronym" => $line["ACRO"],
        ":monArr" => isset($line["monArr"]) ? $line["monArr"]+1 : null,
        ":monDep" => isset($line["monDep"]) ? $line["monDep"]+12 : null,
        ":tueArr" => isset($line["tueArr"]) ? $line["tueArr"]+1 : null,
        ":tueDep" => isset($line["tueDep"]) ? $line["tueDep"]+12 : null,
        ":wedArr" => isset($line["wedArr"]) ? $line["wedArr"]+1 : null,
        ":wedDep" => isset($line["wedDep"]) ? $line["wedDep"]+12 : null,
        ":thuArr" => isset($line["thuArr"]) ? $line["thuArr"]+1 : null,
        ":thuDep" => isset($line["thuDep"]) ? $line["thuDep"]+12 : null,
        ":friArr" => isset($line["friArr"]) ? $line["friArr"]+1 : null,
        ":friDep" => isset($line["friDep"]) ? $line["friDep"]+12 : null
      );

      $confirm = executeQueryInsert($upsertQuery, $upsertData);
    }

    unset($_SESSION["edtData"]);
    header("Location:/?admin");
  }
}
