<?php


function joinCar($travelId)
{
  $userId = $_SESSION["id"];

  require_once("model/dbConnector.php");

  $sql = "INSERT INTO PASSENGERS (userId, travelId)
  VALUES (:userId, :travelId)";

  $confirm = executeQuerySelect($sql, array(":userId" => $userId, ":travelId" => $travelId));
}
