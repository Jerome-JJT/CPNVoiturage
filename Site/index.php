<?php


require("controler/views.php");




if(isset($_GET["page"]))
{
  switch($_GET["page"])
  {
    case "login":
      displayLogin();
      break;

    case "view":
      displayView();
      break;

    case "profil":
      displayProfil();
      break;

    default:
      displayLogin();

  }
}
else
{
  displayLogin();
}
