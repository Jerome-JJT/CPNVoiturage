<?php


function executeQuerySelect($query, $data = array()){
  $queryResult = array();

  $pdo = openDBConnexion();//open database connexion

  if ($pdo != null)
  {
    $stm = $pdo->prepare($query);
    $stm->execute($data);
    $queryResult = $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  $pdo = null;//close database connexion
  return $queryResult;
}


function executeQueryInsert($query, $data = array())
{
  $pdo = openDBConnexion();//open database connexion

  if ($pdo != null)
  {
    $stm = $pdo->prepare($query);
    $result = $stm->execute($data);
  }

  $pdo = null;//close database connexion
  return ($result === false ? false : true);
}


function openDBConnexion()
{
  try
  {
    $pdo = new PDO('sqlite:model/testDB.db');
  }
    catch (PDOException $exception)
  {
    require("view/error.php");
    exit();
  }

  return $pdo;
}
