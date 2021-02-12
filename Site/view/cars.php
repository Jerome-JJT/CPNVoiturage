<?php

ob_start();


?>

<div class="navi">
  <div class="nav-tab">
    <h3>Lundi</h3>
  </div>

  <div class="nav-tab">
    <h3>Mardi</h3>
  </div>

  <div class="nav-tab">
    <h3>Mercredi</h3>
  </div>

  <div class="nav-tab">
    <h3>Jeudi</h3>
  </div>

  <div class="nav-tab">
    <h3>Vendredi</h3>
  </div>

  <button><strong>Profil</strong></button>

</div>

<div id="monday" class="carDay">
  <div style="margin: 0 20px; height: 300px;">
    <div style="text-align: center; height: 15%; font-size: 20px"><strong>Aller</strong></div>

    <div style="width: 35%; height: 85%; display: inline-block; vertical-align: top; background-color: magenta">
      <strong>Ajout de voiture</strong><br><br>

      <label for="nbPlaces">Nombre de places passagers</label>
      <input id="nbPlaces" name="nbPlaces" type="number" value="4" min="1" max="10">

      <button>Ajouter ma voiture</button>
    </div

    ><div style="background-color: cyan; width: 65%; display: inline-block; vertical-align: top; height: 85%; overflow: scroll">
      <table style="border-collapse: collapse; margin: 5px; text-align: center">
        <tr>
          <th style="border: 1px solid black">Conducteur</th>
          <th style="border: 1px solid black">Seuls</th>
          <th style="border: 1px solid black">DWZ</th>

        </tr>

        <tr>
          <th style="border: 1px solid black">Ville</th>
          <td style="border: 1px solid black">───</td>
          <td style="border: 1px solid black">p</td>
        </tr>

        <tr>
          <th style="border: 1px solid black">Heure de départ</th>
          <td style="border: 1px solid black">───</td>
          <td style="border: 1px solid black">p</td>
        </tr>

        <tr>
          <th style="border: 1px solid black">Heure d'arrivée</th>
          <td style="border: 1px solid black">───</td>
          <td style="border: 1px solid black">p</td>
        </tr>

        <tr>
          <th style="border: 1px solid black">Places restantes</th>
          <td style="border: 1px solid black;">&infin;</td>
          <td style="border: 1px solid black">p</td>
        </tr>

        <tr>
          <th style="border: 1px solid black">───</th>
          <td style="border: 1px solid black;"><button>Quitter</button></td>
          <td style="border: 1px solid black"><button>Rejoindre</button></td>
        </tr>
      </table>
    </div>
  </div>


  <div style="width: 90%; margin: 15px 5%; border: 4px solid black; border-radius: 50% / 80%">
  </div>


  <div>
  </div>
</div>


<?php

$content = ob_get_clean();

?>
