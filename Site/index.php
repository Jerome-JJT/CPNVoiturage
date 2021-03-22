<?php

session_start();
require("controler/views.php");

require("controler/actions.php");
require("controler/accountActions.php");
require("controler/adminActions.php");

$logged = isset($_SESSION["id"]);
$isAdmin = $logged && strlen($_SESSION["acro"]) > 3;

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
    case "signout":
      signOut();
      break;

    case "joinCar":
      if(isset($_GET["travel"]))
      {
        joinCar($_GET["travel"]);
      }
    else { header("Location:/"); }
      break;
  }
}
else if(isset($_GET["page"]) && $logged)
{
  switch($_GET["page"])
  {
    case "monday":
      displayView("mon");
      break;

    case "tuesday":
      displayView("tue");
      break;

    case "wednesday":
      displayView("wed");
      break;

    case "thursday":
      displayView("thu");
      break;

    case "friday":
      displayView("fri");
      break;

    case "profil":
      displayProfil();
      break;

    default:
      displayView("mon");

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
