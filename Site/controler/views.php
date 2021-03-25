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

  $userId = $_SESSION["id"];
  $userAcro = $_SESSION["acro"];

  $comeCars = getCarsList($day, "come");
  $comePass = getPassengersList($day, "come");

  $backCars = getCarsList($day , "back");
  $backPass = getPassengersList($day , "back");

  $userProfil = getUserProfile($_SESSION["id"]);

  //print_r($comeCars); echo("<br><br>");
  //print_r($comePass); echo("<br><br>");

  //print_r(array_column($comeCars, "DRIVER_ID"));


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
      "cityId" => $driver["DRIVER_CITY_ID"],
      "arrivalId" => $driver["HOUR_ID"],
      "arrivalHour" => $driver["HOUR"],
      "maxPlaces" => $driver["places"],
      "passengers" => array()
    );
  }

  foreach ($comePass as $passenger)
  {
    if(in_array($passenger["USER_ID"], array_column($comeCars, "DRIVER_ID")))
    {
      continue;
    }

    if($passenger["travelId"] != null)
    {
      array_push($cars["come"]["cars"][$passenger["travelId"]]["passengers"], $passenger["acronym"]);
    }
    else
    {
      array_push($cars["come"]["solo"], $passenger["acronym"]);
    }
  }

  foreach ($backCars as $driver)
  {
    $cars["back"]["cars"][$driver["id"]] = array(
      "driver" => $driver["DRIVER_ACRO"],
      "city" => $driver["DRIVER_CITY"],
      "cityId" => $driver["DRIVER_CITY_ID"],
      "departHour" => $driver["HOUR"],
      "departId" => $driver["HOUR_ID"],
      "maxPlaces" => $driver["places"],
      "passengers" => array()
    );
  }

  foreach ($backPass as $passenger)
  {
    if(in_array($passenger["USER_ID"], array_column($backCars, "DRIVER_ID")))
    {
      continue;
    }

    if($passenger["travelId"] != null)
    {
      array_push($cars["back"]["cars"][$passenger["travelId"]]["passengers"], $passenger["acronym"]);
    }
    else
    {
      array_push($cars["back"]["solo"], $passenger["acronym"]);
    }
  }

  $userConf = array(
    "come" => array(
      "isDriver" => false,
      "isInCar" => true
    ),
    "back" => array(
      "isDriver" => true,
      "isInCar" => false
    )
  );

  $userConf["come"]["isDriver"] = array_search($userId, array_column($comeCars, "DRIVER_ID"));
  if($userConf["come"]["isDriver"] !== false){ $userConf["come"]["isDriver"] = $comeCars[$userConf["come"]["isDriver"]]; }

  $userConf["back"]["isDriver"] = array_search($userId, array_column($backCars, "DRIVER_ID"));
  if($userConf["back"]["isDriver"] !== false){ $userConf["back"]["isDriver"] = $backCars[$userConf["back"]["isDriver"]]; }



  $userConf["come"]["isInCar"] = $comePass[array_search($userAcro, array_column($comePass, "acronym"))]["travelId"] != null;
  $userConf["back"]["isInCar"] = $backPass[array_search($userAcro, array_column($backPass, "acronym"))]["travelId"] != null;

/*$userAcro
  $userConf["come"]["isDriver"] = in_array($userId, array_column($comeCars, "USER_ID"));
  $userConf["back"]["isDriver"] = in_array($userId, array_column($backCars, "USER_ID"));
*/
  require("view/cars.php");
}


function displayProfil()
{
  require_once("controler/requests.php");

  $cityOptions = getCitesList();

  $startOptions = getPeriodOptions("come");

  $endOptions = getPeriodOptions("back");

  $userProfil = getUserProfile($_SESSION["id"]);

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

  require("view/profile.php");
}


function displayAdmin()
{
  require("view/admin.php");
}
