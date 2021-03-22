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

  $comeCars = getCarsList($day, "come");
  $comePass = getPassengersList($day, "come");

  $backCars = getCarsList($day , "back");
  $backPass = getPassengersList($day , "back");


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



  foreach ($comeCars as $driver)
  {
    $cars["come"]["cars"][$driver["id"]] = array(
      "driver" => $driver["DRIVER_ACRO"],
      "city" => $driver["DRIVER_CITY"],
      "departHour" => "8h00",
      "arrivalHour" => $driver["HOUR"],
      "maxPlaces" => $driver["places"],
      "passengers" => array()
    );
  }

  foreach ($comePass as $passenger)
  {
    if($passenger["travelId"] != null)
    {
      array_push($cars["come"]["cars"][$passenger["travelId"]]["passengers"], $passenger["acronym"]);
    }
    else
    {
      array_push($cars["come"]["solo"], $passenger["acronym"]);
    }
  }

  foreach ($backCars as $passenger)
  {
    $cars["back"]["cars"][$passenger["id"]] = array(
      "driver" => $passenger["DRIVER_ACRO"],
      "city" => $passenger["DRIVER_CITY"],
      "departHour" => $passenger["HOUR"],
      "arrivalHour" => "17h00",
      "maxPlaces" => $passenger["places"],
      "passengers" => array()
    );
  }

  foreach ($backPass as $passenger)
  {
    if($passenger["travelId"] != null)
    {
      array_push($cars["back"]["cars"][$passenger["travelId"]]["passengers"], $passenger["acronym"]);
    }
    else
    {
      array_push($cars["back"]["solo"], $passenger["acronym"]);
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
