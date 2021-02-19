<?php


require("controler/views.php");




if(isset($_GET["page"]))
{
  switch($_GET["page"])
  {
    case "home":
      displayHome();
      break;

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
else
{
  displayView();
}
