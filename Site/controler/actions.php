<?php



function loginAccount($post)
{
  if(isset($post["acronym"])
  && isset($post["password"]))
  {
    $acronym = strtoupper($post["acronym"]);
    $password = $post["password"];

    $loginQuery = "SELECT id, password FROM USERS WHERE acronym = :acronym";
    $loginData = array(":acronym" => $acronym);

    require_once("model/dbConnector.php");


    $result = executeQuerySelect($loginQuery, $loginData);

    if(count($result) == 1)
    {
      if(password_verify($password, $result[0]["password"]))
      {
        $_SESSION["id"] = $result[0]["id"];
        $_SESSION["acro"] = $acronym;

        header("Location:/");
      }
      else
      {
        displayLogin("Password faux", $acronym, "");
        exit();
      }
    }
    else
    {
      displayLogin("Compte existe pas", $acronym, "");
      exit();
    }
  }
  else
  {
    displayLogin("Error", "", "");
    exit();
  }
}

function createAccount($post)
{
  if(isset($post["acronym"])
  && isset($post["city"])
  && isset($post["password"])
  && isset($post["repeatPassword"]))
  {
    if($post["password"] == $post["repeatPassword"])
    {
      $acronym = strtoupper($post["acronym"]);
      $city = $post["city"];
      $password = password_hash($post["password"], PASSWORD_DEFAULT);

      $checkQuery = "SELECT id FROM USERS WHERE acronym = :acronym";
      $checkData = array(":acronym" => $acronym);

      require_once("model/dbConnector.php");


      $result = executeQuerySelect($checkQuery, $checkData);

      if(count($result) == 0)
      {
        $insertQuery = "INSERT INTO USERS (acronym, password, cityId, monArr, monDep, tueArr, tueDep, wedArr, wedDep, thuArr, thuDep, friArr, friDep) VALUES (:acronym, :password, :city, 1,2,1,2,1,2,1,2,1,2)";
        $insertData = array(":acronym" => $acronym, ":password" => $password, ":city" => $city);

        $confirm = executeQueryInsert($insertQuery, $insertData);

        if($confirm)
        {
          $getQuery = "SELECT id FROM USERS WHERE acronym = :acronym";
          $getData = array(":acronym" => $acronym);

          $getResult = executeQuerySelect($checkQuery, $checkData);
          $_SESSION["id"] = $getResult[0]["id"];
          $_SESSION["acro"] = $acronym;

          header("Location:/");
        }
      }
      else
      {
        displayLogin("Compte existe déjà", $acronym, $city);
        exit();
      }
    }
    else
    {
      displayLogin("Mots de passe différents", $post["acronym"], $post["city"]);
      exit();
    }
  }
  else
  {
    displayLogin("Error", "", "");
    exit();
  }
}



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
