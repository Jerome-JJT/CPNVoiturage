<?php

ob_start();

$title = "CPNVoiturage - Profil";
$pageTitle = "Profil";

?>



<strong>dffdgfdg</strong><br><br>

<label for="villePassage">Nombre de places passagers</label>
<input id="villePassage" name="villePassage" type="select">

<button class="mybutton">Ajouter ma voiture</button>


<table class="carTable">
  <tr>
    <th>Conducteur</th>
    <th>Seuls</th>
    <th>DWZ</th>

  </tr>

  <tr>
    <th>Ville</th>
    <td>───</td>
    <td>p</td>
  </tr>

  <tr>
    <th>Heure de départ</th>
    <td>───</td>
    <td>p</td>
  </tr>

  <tr>
    <th>Heure d'arrivée</th>
    <td>───</td>
    <td>p</td>
  </tr>

  <tr>
    <th>Places restantes</th>
    <td>&infin;</td>
    <td>p</td>
  </tr>

  <tr>
    <th style="">───</th>
    <td style=""><button class="mybutton">Quitter</button></td>
    <td style=""><button class="mybutton">Rejoindre</button></td>
  </tr>
</table>



s


<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
