<?php


function displayLogin($errorMsg = "", $acronym = "", $city = "")
{
  require_once("controler/requests.php");

  $citiesList = getCitesList();

  require("view/login.php");
}

function displayView()
{
  //require_once("controler/requests.php");

  require("view/cars.php");
}

function displayProfil()
{
  require("view/profile.php");
}


function displayAdmin()
{

}
