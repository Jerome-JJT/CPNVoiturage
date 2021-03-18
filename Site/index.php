<?php

session_start();
require("controler/views.php");
require("controler/actions.php");

$logged = isset($_SESSION["id"]);
$isAdmin = $logged && $_SESSION["id"] == 1;

//print_r($_SESSION);


if(isset($_GET["admin"]) && $logged && $isAdmin)
{
  displayAdmin();
  exit();
}
else if(isset($_GET["action"]) && $logged && $isAdmin)
{
  switch($_GET["action"])
  {
    case "validateEDT":
      validateEDT($_POST);
      break;

    case "executeEDT":
      executeEDT();
      break;
  }
}



if(isset($_GET["action"]) && $logged)
{
  switch($_GET["action"])
  {

  }
}
else if(isset($_GET["page"]) && $logged)
{
  switch($_GET["page"])
  {
    case "view":
      displayView();
      break;

    case "profil":
      displayProfil();
      break;

    default:
      displayView();

  }
}
else if($logged)
{
  displayView();
}


else if(isset($_GET["action"]))
{
  switch($_GET["action"])
  {
    case "createAccount":
      createAccount($_POST);
      break;

    case "loginAccount":
      loginAccount($_POST);
      break;
  }
}
else
{
  displayLogin();
}
