<?php


function joinCar($travelId, $day)
{
  $userId = $_SESSION["id"];

  require_once("model/dbConnector.php");

  $sql = "INSERT INTO PASSENGERS (userId, travelId)
  VALUES (:userId, :travelId)";

  $confirm = executeQueryInsert($sql, array(":userId" => $userId, ":travelId" => $travelId));

  header("Location:/?page=".$day);
}

function quitCar($dir, $day)
{
  $userId = $_SESSION["id"];

  require_once("model/dbConnector.php");

  $sql = "DELETE FROM PASSENGERS
  WHERE ROWID IN (
  	SELECT PASSENGERS.ROWID FROM PASSENGERS
    INNER JOIN TRAVELS ON TRAVELS.id = PASSENGERS.travelId

    INNER JOIN DIRECTIONS ON DIRECTIONS.id = TRAVELS.directionId
    INNER JOIN DAYS ON DAYS.id = TRAVELS.dayId

    WHERE (DIRECTIONS.name = :dir AND DAYS.name = :day)
  )";

  $confirm = executeQueryInsert($sql, array(":dir" => $dir, ":day" => ucfirst($day)));

  header("Location:/?page=".$day);
}


function createCar($dir, $day, $places)
{
  $userId = $_SESSION["id"];

  require_once("model/dbConnector.php");

  $sql = "INSERT INTO TRAVELS (directionId, dayId, places, driverId)
    VALUES (
    (SELECT id FROM DIRECTIONS WHERE name=:dir),
    (SELECT id FROM DAYS WHERE name=:day),
    :places, :userId)";

  $confirm = executeQueryInsert($sql, array(":dir" => $dir, ":day" => ucfirst($day), ":places" => $places, ":userId" => $userId));

  header("Location:/?page=".$day);
}

function deleteCar($car, $day)
{
  $userId = $_SESSION["id"];

  require_once("model/dbConnector.php");

  $sql = "DELETE FROM TRAVELS WHERE id = :car";

  $confirm = executeQueryInsert($sql, array(":car" => $car));


  $sql = "DELETE FROM PASSENGERS WHERE travelId = :car";
  $confirm = executeQueryInsert($sql, array(":car" => $car));

  header("Location:/?page=".$day);
}



function updateProfile($postData)
{
  $userId = $_SESSION["id"];

  require_once("model/dbConnector.php");

  $sql = "UPDATE USERS SET
  (cityId, monArr, monDep, tueArr, tueDep, wedArr, wedDep, thuArr, thuDep, friArr, friDep) =
  (:cityId, :monArr, :monDep, :tueArr, :tueDep, :wedArr, :wedDep, :thuArr, :thuDep, :friArr, :friDep)
  WHERE id = :userId";


  $confirm = executeQueryInsert($sql, array(
    ":cityId" => $postData["villePassage"],
    ":monArr" => $postData["monArr"],
    ":monDep" => $postData["monDep"],
    ":tueArr" => $postData["tueArr"],
    ":tueDep" => $postData["tueDep"],
    ":wedArr" => $postData["wedArr"],
    ":wedDep" => $postData["wedDep"],
    ":thuArr" => $postData["thuArr"],
    ":thuDep" => $postData["thuDep"],
    ":friArr" => $postData["friArr"],
    ":friDep" => $postData["friDep"],
    ":userId" => $userId));

  header("Location:/?page=profil");
}



function importEDT()
{
  $userId = $_SESSION["id"];
  $userAcro = $_SESSION["acro"];

  require_once("model/dbConnector.php");

  $sql = "SELECT id FROM EDT WHERE acronym = :acronym";
  $confirm = executeQuerySelect($sql, array(":acronym" => $userAcro));

  if(count($confirm) == 1)
  {
    $sql = "UPDATE USERS SET
      (monArr, monDep, tueArr, tueDep, wedArr, wedDep, thuArr, thuDep, friArr, friDep) =
      (
      	SELECT EDT.monArr, EDT.monDep, EDT.tueArr, EDT.tueDep, EDT.wedArr, EDT.wedDep, EDT.thuArr, EDT.thuDep, EDT.friArr, EDT.friDep FROM EDT
      	INNER JOIN USERS ON USERS.acronym = EDT.acronym

      	WHERE USERS.id = :userId
      )
      WHERE USERS.id = :userId";


    $confirm = executeQueryInsert($sql, array(":userId" => $userId));

    header("Location:/?page=profil");
  }
  else
  {
    header("Location:/?page=profil&error=true");
  }




}


























//.
