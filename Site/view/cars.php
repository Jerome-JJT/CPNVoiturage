<?php

ob_start();

$title = "Voitures - Lundi";
$pageTitle = "Lundi";


?>



<div class="travelDisplay">
  <div style="text-align: center; height: 15%; font-size: 20px">
    <strong>Aller</strong>
  </div>

  <div class="travelCase" style="width: 35%; background-color: magenta">
    <strong>Ajout de voiture</strong><br><br>

    <label for="nbPlaces">Nombre de places passagers</label>
    <input id="nbPlaces" name="nbPlaces" type="number" value="4" min="1" max="10">

    <button class="mybutton">Ajouter ma voiture</button>
  </div

  ><div class="travelCase" style="background-color: cyan; width: 65%; overflow: scroll">
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
  </div>
</div>


<div style="width: 90%; margin: 15px 5%; border: 4px solid black; border-radius: 50% / 80%">
</div>


<div>
</div>



<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
