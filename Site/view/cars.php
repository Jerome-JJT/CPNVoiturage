<?php

ob_start();

$title = "Voitures - Lundi";
$pageTitle = "Lundi";


/*$myCar = array(


);*/

$cars = array(
  "come" => array(
    "solo" => array("ZYX", "WVO", "ASD", "KIU"),

    "cars" => array(
      array(
        "conductor" => "DWZ",
        "place" => "Chavo",
        "departHour" => "8h00",
        "arrivalHour" => "9h00",
        "remainingPlaces" => "5",
        "passengers" => array(
          "ABC", "DEF", "GHI", "JKM"
        )
      ),
      array(
        "conductor" => "MWA",
        "place" => "Laus",
        "departHour" => "10h00",
        "arrivalHour" => "11h00",
        "remainingPlaces" => "2",
        "passengers" => array(
          "ABC", "DEF"
        )
      )
    ),
  ),
  "back" => array(
    "solo" => array(),

    "cars" => array(
      array(
        "conductor" => "DWZ",
        "place" => "Chavo",
        "departHour" => "16h00",
        "arrivalHour" => "17h00",
        "remainingPlaces" => "5",
        "passengers" => array(
          "ABC", "DEF"
        )
      )
    )

  )
);

?>



<div class="travelDisplay">
  <div style="text-align: center; height: 15%; font-size: 20px">
    <strong>Aller</strong>
  </div>

  <div>
    <div class="travelCase" style="width: 35%">
      <strong>Ajout de voiture</strong><br><br>

      <label for="nbPlaces">Nombre de places passagers</label>
      <input id="nbPlaces" name="nbPlaces" type="number" value="4" min="1" max="10">

      <button class="mybutton">Ajouter ma voiture</button>
    </div

    ><div class="travelCase" style="width: 65%; overflow: scroll">
      <table class="carTable">
        <tr style="background-color:white">
          <th>Conducteur</th>
          <th>Seuls</th>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <th><?= $car["conductor"] ?></th>
          <?php endforeach ?>
        </tr>

        <tr style="background-color:lightgray">
          <th>Ville</th>
          <td>───</td>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <td><?= $car["place"] ?></td>
          <?php endforeach ?>
        </tr>

        <tr style="background-color:white">
          <th>Heure de départ</th>
          <td>───</td>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <td><?= $car["departHour"] ?></td>
          <?php endforeach ?>
        </tr>

        <tr style="background-color:lightgray">
          <th>Heure d'arrivée</th>
          <td>───</td>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <td><?= $car["arrivalHour"] ?></td>
          <?php endforeach ?>
        </tr>

        <tr style="background-color:white">
          <th>Places restantes</th>
          <td>&infin;</td>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <td><?= $car["remainingPlaces"] ?></td>
          <?php endforeach ?>
        </tr>


        <?php $maxLines = count($cars["come"]["solo"]); ?>

        <?php foreach($cars["come"]["cars"] as $car) {
          $maxLines = (count($car["passengers"]) > $maxLines) ? count($car["passengers"]) : $maxLines;
        } ?>


        <?php for($i = 0; $i < $maxLines; $i++): ?>
          <tr style="background-color:<?= $i%2==0 ? 'lightgray' : 'white'?>">
            <td>Place <?= $i+1 ?></td>

            <td><?= $cars["come"]["solo"][$i] ?></td>

            <?php foreach($cars["come"]["cars"] as $car): ?>
              <td><?= $car["passengers"][$i] ?></td>
            <?php endforeach ?>
          </tr>
        <?php endfor ?>




        <tr style="background-color:<?= $maxLines%2==0 ? 'lightgray' : 'white'?>">
          <th style="">───</th>
          <td style=""><button class="mybutton">Quitter</button></td>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <td style=""><button class="mybutton">Rejoindre</button></td>
          <?php endforeach ?>
        </tr>
      </table>
    </div>
  </div>
</div>




<div style="width: 90%; margin: 15px 5%; border: 4px solid black; border-radius: 50% / 80%">
</div>




<div class="travelDisplay">
  <div style="text-align: center; height: 15%; font-size: 20px">
    <strong>Retour</strong>
  </div>

  <div class="travelCase" style="width: 35%">
    <strong>Ajout de voiture</strong><br><br>

    <label for="nbPlaces">Nombre de places passagers</label>
    <input id="nbPlaces" name="nbPlaces" type="number" value="4" min="1" max="10">

    <button class="mybutton">Ajouter ma voiture</button>
  </div

  ><div class="travelCase" style="width: 65%; overflow: scroll">
    <table class="carTable">
      <tr style="background-color:white">
        <th>Conducteur</th>
        <th>Seuls</th>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <th><?= $car["conductor"] ?></th>
        <?php endforeach ?>
      </tr>

      <tr style="background-color:lightgray">
        <th>Ville</th>
        <td>───</td>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <td><?= $car["place"] ?></td>
        <?php endforeach ?>
      </tr>

      <tr style="background-color:white">
        <th>Heure de départ</th>
        <td>───</td>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <td><?= $car["departHour"] ?></td>
        <?php endforeach ?>
      </tr>

      <tr style="background-color:lightgray">
        <th>Heure d'arrivée</th>
        <td>───</td>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <td><?= $car["arrivalHour"] ?></td>
        <?php endforeach ?>
      </tr>

      <tr style="background-color:white">
        <th>Places restantes</th>
        <td>&infin;</td>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <td><?= $car["remainingPlaces"] ?></td>
        <?php endforeach ?>
      </tr>


      <?php $maxLines = count($cars["back"]["solo"]); ?>

      <?php foreach($cars["back"]["cars"] as $car) {
        $maxLines = (count($car["passengers"]) > $maxLines) ? count($car["passengers"]) : $maxLines;
      } ?>


      <?php for($i = 0; $i < $maxLines; $i++): ?>
        <tr style="background-color:<?= $i%2==0 ? 'lightgray' : 'white'?>">
          <td>Place <?= $i+1 ?></td>

          <td><?= isset($cars["back"]["solo"][$i] ?></td>

          <?php foreach($cars["back"]["cars"] as $car): ?>
            <td><?= $car["passengers"][$i] ?></td>
          <?php endforeach ?>
        </tr>
      <?php endfor ?>




      <tr style="background-color:<?= $maxLines%2==0 ? 'lightgray' : 'white'?>">
        <th style="">───</th>
        <td style=""><button class="mybutton">Quitter</button></td>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <td style=""><button class="mybutton">Rejoindre</button></td>
        <?php endforeach ?>
      </tr>
    </table>
  </div>
</div>

<br>



<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
