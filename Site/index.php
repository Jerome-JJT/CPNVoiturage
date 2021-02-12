<?php


require("controler/views.php");




if(isset($_GET["action"]))
{
  switch($_GET["action"])
  {
    case "view":
      displayView();
      break;

    default:
      displayView();

  }
}
else
{
  displayView();
}
