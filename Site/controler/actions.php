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
