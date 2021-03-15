<?php

function getCitesList()
{
  require_once("model/dbConnector.php");

  $sql = "SELECT id, name FROM CITIES";

  $result = executeQuerySelect($sql);

  return $result;
}

function getCarsList($day = "mon", $direction = "come")
{
  require_once("model/dbConnector.php");

  if($direction == "come")
  {
    $select = "ARR.hour AS ARR,";
    $join = "LEFT JOIN PERIODS AS ARR ON DRIVER.monArr = ARR.id";
  }
  else if($direction == "back")
  {
    $select = "DEP.hour AS DEP,";
    $join = "LEFT JOIN PERIODS AS DEP ON DRIVER.monDep = DEP.id";
  }

  $sql = "
  SELECT TRAVELS.id, USERS.acronym AS PASS_ACRO, DRIVER.acronym AS DRIVER_ACRO, DRIVER_CITY.name AS DRIVER_CITY,
  TRAVEL_DAY.name AS TRAVEL_DAY, TRAVEL_DIR.name AS TRAVEL_DIR, ".$select." TRAVELS.places FROM USERS

  LEFT JOIN PASSENGERS ON USERS.id = PASSENGERS.userId
  LEFT JOIN TRAVELS ON PASSENGERS.travelId = TRAVELS.id
  LEFT JOIN USERS AS DRIVER ON TRAVELS.driverId = DRIVER.id
  LEFT JOIN CITIES AS DRIVER_CITY ON DRIVER.cityId = DRIVER_CITY.id

  LEFT JOIN DAYS AS TRAVEL_DAY ON TRAVELS.dayId = TRAVEL_DAY.id
  LEFT JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVELS.directionId = TRAVEL_DIR.id

  ".$join."

  WHERE TRAVEL_DIR.name = :direction OR TRAVEL_DIR.name IS NULL";

  $result = executeQuerySelect($sql, array(":direction" => $direction));

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
