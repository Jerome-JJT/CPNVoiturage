<?php


function displayLogin($errorMsg = "", $acronym = "", $city = "")
{
  require_once("controler/requests.php");

  $citiesList = getCitesList();

  require("view/login.php");
}

function displayView($day = "mon")
{
  require_once("controler/requests.php");

  $comePass = getCarsList($day, "come");
  $backPass = getCarsList($day , "back");

  print_r($comePass);

  $cars = array(
    "come" => array(
      "solo" => array(),
      "cars" => array()
    ),
    "back" => array(
      "solo" => array(),
      "cars" => array()
    )
  );

  //print_r("<br><br>");
  //print_r($comePass);


  foreach ($comePass as $passenger)
  {
    if($passenger["DRIVER_ACRO"] == null)
    {
      array_push($cars["come"]["solo"], $passenger["PASS_ACRO"]);
    }
    else if(isset($cars["come"]["cars"][$passenger["DRIVER_ACRO"]]))
    {
      array_push($cars["come"]["cars"][$passenger["DRIVER_ACRO"]]["passengers"], $passenger["PASS_ACRO"]);
    }
    else if(!isset($cars["come"]["cars"][$passenger["DRIVER_ACRO"]]))
    {
      $cars["come"]["cars"][$passenger["DRIVER_ACRO"]] = array(
        "city" => $passenger["DRIVER_CITY"],
        "departHour" => "8h00",
        "arrivalHour" => $passenger["ARR"],
        "maxPlaces" => $passenger["places"],
        "passengers" => array($passenger["PASS_ACRO"])
      );
    }
  }

  foreach ($backPass as $passenger)
  {
    if($passenger["DRIVER_ACRO"] == null)
    {
      array_push($cars["back"]["solo"], $passenger["PASS_ACRO"]);
    }
    else if(isset($cars["back"]["cars"][$passenger["DRIVER_ACRO"]]))
    {
      array_push($cars["back"]["cars"][$passenger["DRIVER_ACRO"]]["passengers"], $passenger["PASS_ACRO"]);
    }
    else if(!isset($cars["back"]["cars"][$passenger["DRIVER_ACRO"]]))
    {
      $cars["back"]["cars"][$passenger["DRIVER_ACRO"]] = array(
        "city" => $passenger["DRIVER_CITY"],
        "departHour" => $passenger["DEP"],
        "arrivalHour" => "17h00",
        "maxPlaces" => $passenger["places"],
        "passengers" => array($passenger["PASS_ACRO"])
      );
    }
  }


  require("view/cars.php");
}

function displayProfil()
{
  require_once("controler/requests.php");

  $cityOptions = getCitesList();

  $startOptions = getPeriodOptions("come");

  $endOptions = getPeriodOptions("back");

  $userProfil = getUserProfile($_SESSION["id"]);

  print_r($userProfil);

  $days = array("mon" => "monday", "tue" => "tuesday", "wed" => "wednesday", "thu" => "thursday", "fri" => "friday");

  $profil = array(
    "city" => $userProfil["cityId"]
  );
  foreach ($days as $key => $day)
  {
    $profil[$day] = array(
      "enabled" => ($userProfil[$key."Arr"] != null && $userProfil[$key."Dep"] != null),
      "startWork" => ($userProfil[$key."Arr"]),
      "endWork" => ($userProfil[$key."Dep"])
    );
  }

  /*$profil = array(
    "city" => "Orbe",
    "monday" => array(
      "enabled" => true,
      "startWork" => "10h40",
      "endWork" => "16h00"
    ),
    "tuesday" => array(
      "enabled" => false,
      "startWork" => "8h00",
      "endWork" => "16h00"
    ),
    "wednesday" => array(
      "enabled" => true,
      "startWork" => "13h30",
      "endWork" => "16h00"
    ),
    "thursday" => array(
      "enabled" => false,
      "startWork" => "8h00",
      "endWork" => "16h10"
    ),
    "friday" => array(
      "enabled" => true,
      "startWork" => "8h00",
      "endWork" => "16h00"
    )
  );*/


  require("view/profile.php");
}


function displayAdmin()
{
  require("view/admin.php");
}
