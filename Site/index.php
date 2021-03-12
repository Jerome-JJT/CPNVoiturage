<?php

session_start();
require("controler/views.php");
require("controler/actions.php");

$logged = isset($_SESSION["id"]);
print_r($_SESSION);

if(isset($_GET["action"]))
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

if(isset($_GET["action"]) && $logged)
{
  switch($_GET["action"])
  {

  }
}

if(isset($_GET["admin"]) && $logged && $_SESSION["id"] == 1)
{
    displayAdmin();
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
else
{
  displayLogin();
}
