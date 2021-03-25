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
        if(isset($_GET["travel"]) && isset($_GET["day"]))
        {
          joinCar($_GET["travel"], $_GET["day"]);
        }
        else { header("Location:/"); }
      break;

      case "quitCar":
        if(isset($_GET["dir"]) && isset($_GET["day"]))
        {
          quitCar($_GET["dir"], $_GET["day"]);
        }
        else { header("Location:/"); }
      break;

      case "createCar":
        if(isset($_GET["dir"]) && isset($_GET["day"]) && isset($_GET["nbPlaces"]))
        {
          createCar($_GET["dir"], $_GET["day"], $_GET["nbPlaces"]);
        }
      else { header("Location:/"); }
      break;

      case "deleteCar":
        if(isset($_GET["car"]) && isset($_GET["day"]))
        {
          deleteCar($_GET["car"], $_GET["day"]);
        }
      else { header("Location:/"); }
      break;

      case "updateProfile":
        updateProfile($_POST);
      break;

      case "importEDT":
        importEDT();
      break;
  }
}
else if(isset($_GET["page"]) && $logged)
{
  switch($_GET["page"])
  {
    case "mon":
      displayView("mon");
      break;

    case "tue":
      displayView("tue");
      break;

    case "wed":
      displayView("wed");
      break;

    case "thu":
      displayView("thu");
      break;

    case "fri":
      displayView("fri");
      break;

    case "profil":
      displayProfil();
      break;

    default:
      header("Location:/?page=mon");

  }
}
else if($logged)
{
  header("Location:/?page=mon");
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
