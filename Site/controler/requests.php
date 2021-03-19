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
    $join = "LEFT JOIN PERIODS AS ARR ON DRIVER.".$day."Arr = ARR.id";
  }
  else if($direction == "back")
  {
    $select = "DEP.hour AS DEP,";
    $join = "LEFT JOIN PERIODS AS DEP ON DRIVER.".$day."Dep = DEP.id";
  }


  /*$sql = "
  SELECT TRAVELS.id, USERS.acronym AS PASS_ACRO, DRIVER.acronym AS DRIVER_ACRO, DRIVER_CITY.name AS DRIVER_CITY,
  TRAVEL_DAY.name AS TRAVEL_DAY, TRAVEL_DIR.name AS TRAVEL_DIR, ".$select." TRAVELS.places FROM USERS

  LEFT JOIN PASSENGERS ON USERS.id = PASSENGERS.userId
  LEFT JOIN TRAVELS ON PASSENGERS.travelId = TRAVELS.id
  LEFT JOIN USERS AS DRIVER ON TRAVELS.driverId = DRIVER.id
  LEFT JOIN CITIES AS DRIVER_CITY ON DRIVER.cityId = DRIVER_CITY.id

  LEFT JOIN DAYS AS TRAVEL_DAY ON TRAVELS.dayId = TRAVEL_DAY.id
  LEFT JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVELS.directionId = TRAVEL_DIR.id

  ".$join."

  WHERE (TRAVEL_DAY = :day OR TRAVEL_DAY.name IS NULL) AND
  (TRAVEL_DIR.name = :direction OR TRAVEL_DIR.name IS NULL)";*/


  $sql = "SELECT USERS.acronym AS PASS_ACRO, DRIVER.acronym AS DRIVER_ACRO, DRIVER_CITY.name AS DRIVER_CITY,
    TRAVEL_DAY.name AS TRAVEL_DAY, TRAVEL_DIR.name AS TRAVEL_DIR, ".$select." TRAVELS.places FROM TRAVELS

    INNER JOIN DAYS AS TRAVEL_DAY ON TRAVEL_DAY.id = TRAVELS.dayId
    INNER JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVEL_DIR.id = TRAVELS.directionId

    INNER JOIN USERS AS DRIVER ON DRIVER.id = TRAVELS.driverId
    INNER JOIN CITIES AS DRIVER_CITY ON DRIVER_CITY.id = DRIVER.cityId

    LEFT JOIN PASSENGERS ON PASSENGERS.travelId = TRAVELS.id
    LEFT JOIN USERS ON USERS.id = PASSENGERS.userId

    ".$join."

    WHERE (TRAVEL_DAY = :day OR TRAVEL_DAY.name IS NULL) AND (TRAVEL_DIR.name = :direction OR TRAVEL_DIR.name IS NULL)";




    $sql = "SELECT USERS.acronym AS PASS_ACRO, DRIVER.acronym AS DRIVER_ACRO, DRIVER_CITY.name AS DRIVER_CITY,
      TRAVEL_DAY.name AS TRAVEL_DAY, TRAVEL_DIR.name AS TRAVEL_DIR, ".$select." TRAVELS.places FROM USERS

      INNER JOIN DAYS AS TRAVEL_DAY ON TRAVEL_DAY.id = TRAVELS.dayId
      INNER JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVEL_DIR.id = TRAVELS.directionId

      INNER JOIN USERS AS DRIVER ON DRIVER.id = TRAVELS.driverId
      INNER JOIN CITIES AS DRIVER_CITY ON DRIVER_CITY.id = DRIVER.cityId

      LEFT JOIN PASSENGERS ON PASSENGERS.travelId = TRAVELS.id
      LEFT JOIN USERS ON USERS.id = PASSENGERS.userId

      ".$join."

      WHERE (TRAVEL_DAY = :day OR TRAVEL_DAY.name IS NULL) AND (TRAVEL_DIR.name = :direction OR TRAVEL_DIR.name IS NULL)";


  /*$sql = "SELECT USERS.acronym AS PASS_ACRO, DRIVER.acronym AS DRIVER_ACRO, DRIVER_CITY.name AS DRIVER_CITY,
    TRAVEL_DAY.name AS TRAVEL_DAY, TRAVEL_DIR.name AS TRAVEL_DIR, ".$select." TRAVELS.places FROM TRAVELS

    INNER JOIN DAYS AS TRAVEL_DAY ON TRAVEL_DAY.id = TRAVELS.dayId
    INNER JOIN DIRECTIONS AS TRAVEL_DIR ON TRAVEL_DIR.id = TRAVELS.directionId

    INNER JOIN USERS AS DRIVER ON DRIVER.id = TRAVELS.driverId
    INNER JOIN CITIES AS DRIVER_CITY ON DRIVER_CITY.id = DRIVER.cityId

    LEFT JOIN PASSENGERS ON PASSENGERS.travelId = TRAVELS.id
    LEFT JOIN USERS ON USERS.id = PASSENGERS.userId

    ".$join."

    WHERE (TRAVEL_DAY = :day OR TRAVEL_DAY.name IS NULL) AND (TRAVEL_DIR.name = :direction OR TRAVEL_DIR.name IS NULL)

    UNION

    SELECT USERS.acronym, NULL AS DRIVER_ACRO, NULL AS DRIVER_CITY,
    NULL AS TRAVEL_DAY, NULL AS TRAVEL_DIR, NULL AS ARR, NULL AS places FROM USERS

    LEFT JOIN PASSENGERS ON PASSENGERS.userId = USERS.id
    LEFT JOIN TRAVELS ON TRAVELS.driverId = USERS.id

    WHERE PASSENGERS.id IS NULL AND TRAVELS.driverId IS NULL
    ";*/

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
