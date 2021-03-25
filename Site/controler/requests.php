<?php

function getCitesList()
{
  require_once("model/dbConnector.php");

  $sql = "SELECT id, name FROM CITIES";

  $result = executeQuerySelect($sql);

  return $result;
}
/*
function getCarsList($day = "mon", $direction = "come")
{
  require_once("model/dbConnector.php");

  if($direction == "come")
  {
    $dayDir = $day."Arr";
  }
  else if($direction == "back")
  {
    $dayDir = $day."Dep";
  }

  $sql = "SELECT TRAVELS.id, DRIVER.acronym AS DRIVER_ACRO, DRIVER_CITY.name AS DRIVER_CITY, TRAVEL_DAY.name AS TRAVEL_DAY, TRAVEL_DIR.name AS TRAVEL_DIR, TRAVELS.places,
  PERIODS.hour AS HOUR FROM USERS

  INNER JOIN TRAVELS ON TRAVELS.driverId = USERS.id

  INNER JOIN USERS AS DRIVER ON DRIVER.id = TRAVELS.driverId
  INNER JOIN CITIES AS DRIVER_CITY ON DRIVER_CITY.id = DRIVER.cityId

  INNER JOIN DAYS AS TRAVEL_DAY ON TRAVEL_DAY.id = TRAVELS.dayId
  INNER JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVEL_DIR.id = TRAVELS.directionId

  INNER JOIN PERIODS ON PERIODS.id = DRIVER.".$dayDir."

  WHERE TRAVEL_DIR.name = :direction AND TRAVEL_DAY.name = :day";

  $drivers = executeQuerySelect($sql, array(":direction" => $direction, ":day" => ucfirst($day)));



  $sql = "SELECT USERS.acronym, DAY_PASS.travelId FROM USERS

  LEFT JOIN
  (SELECT * FROM PASSENGERS
  INNER JOIN TRAVELS ON TRAVELS.id = PASSENGERS.travelId

  INNER JOIN DAYS AS TRAVEL_DAY ON TRAVEL_DAY.id = TRAVELS.dayId
  INNER JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVEL_DIR.id = TRAVELS.directionId

  WHERE TRAVEL_DIR.name = :direction AND TRAVEL_DAY.name = :day)

  AS DAY_PASS ON DAY_PASS.userId = USERS.id";

  $users = executeQuerySelect($sql, array(":direction" => $direction, ":day" => ucfirst($day)));



  return array("d" => $drivers, "u" => $users);
}*/


function getCarsList($day = "mon", $direction = "come")
{
  require_once("model/dbConnector.php");

  if($direction == "come")
  {
    $dayDir = $day."Arr";
  }
  else if($direction == "back")
  {
    $dayDir = $day."Dep";
  }

  $sql = "SELECT TRAVELS.id, DRIVER.id AS DRIVER_ID, DRIVER.acronym AS DRIVER_ACRO, DRIVER_CITY.name AS DRIVER_CITY, DRIVER_CITY.id AS DRIVER_CITY_ID, TRAVEL_DAY.name AS TRAVEL_DAY, TRAVEL_DIR.name AS TRAVEL_DIR, TRAVELS.places,
  PERIODS.hour AS HOUR, PERIODS.id AS HOUR_ID FROM USERS

  INNER JOIN TRAVELS ON TRAVELS.driverId = USERS.id

  INNER JOIN USERS AS DRIVER ON DRIVER.id = TRAVELS.driverId
  INNER JOIN CITIES AS DRIVER_CITY ON DRIVER_CITY.id = DRIVER.cityId

  INNER JOIN DAYS AS TRAVEL_DAY ON TRAVEL_DAY.id = TRAVELS.dayId
  INNER JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVEL_DIR.id = TRAVELS.directionId

  INNER JOIN PERIODS ON PERIODS.id = DRIVER.".$dayDir."

  WHERE TRAVEL_DIR.name = :direction AND TRAVEL_DAY.name = :day";

  $result = executeQuerySelect($sql, array(":direction" => $direction, ":day" => ucfirst($day)));

  return $result;
}

function getPassengersList($day = "mon", $direction = "come")
{
  require_once("model/dbConnector.php");

  $sql = "SELECT USERS.id AS USER_ID, USERS.acronym, DAY_PASS.travelId FROM USERS

  LEFT JOIN
  (SELECT * FROM PASSENGERS
  INNER JOIN TRAVELS ON TRAVELS.id = PASSENGERS.travelId

  INNER JOIN DAYS AS TRAVEL_DAY ON TRAVEL_DAY.id = TRAVELS.dayId
  INNER JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVEL_DIR.id = TRAVELS.directionId

  WHERE TRAVEL_DIR.name = :direction AND TRAVEL_DAY.name = :day)

  AS DAY_PASS ON DAY_PASS.userId = USERS.id";

  $result = executeQuerySelect($sql, array(":direction" => $direction, ":day" => ucfirst($day)));

  return $result;
}



function getPeriodOptions($direction = "come")
{
  require_once("model/dbConnector.php");

  $sql = "
  SELECT PERIODS.id, PERIODS.hour FROM PERIODS

  INNER JOIN DIRECTIONS ON PERIODS.directionId = DIRECTIONS.id

  WHERE DIRECTIONS.name = :direction";

  $result = executeQuerySelect($sql, array(":direction" => $direction));

  return $result;
}


function getUserProfile($userId)
{
  require_once("model/dbConnector.php");

  $sql = "
  SELECT cityId, monArr, monDep, tueArr, tueDep, wedArr, wedDep, thuArr, thuDep, friArr, friDep FROM USERS

  WHERE USERS.id = :userId";

  $result = executeQuerySelect($sql, array(":userId" => $userId))[0];

  return $result;
}
