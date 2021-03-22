<?php

ob_start();

$title = "Voitures - Lundi";
$pageTitle = "Lundi";

print_r($cars["come"]);

?>



<div class="travelDisplay">
  <div style="text-align: center; height: 15%; font-size: 20px">
    <strong>Aller</strong>
  </div>

  <div>
    <div class="travelCase" style="width: 35%">
      <strong>Ajout de voiture</strong><br><br>

      <?php if($userConf["come"]["isDriver"] == false && $userConf["come"]["isInCar"] == false): ?>
        <label for="nbPlaces">Nombre de places passagers</label>
        <input id="nbPlaces" name="nbPlaces" type="number" value="4" min="1" max="10"><br><br>

        <button class="mybutton">Ajouter ma voiture</button>

      <?php elseif($userConf["come"]["isDriver"] == true): ?>
        <label for="nbPlaces">Nombre de places passagers : <?= $userConf["come"]["isDriver"]["places"] ?></label><br><br>
        <button class="mybutton">Enlever ma voiture</button>

      <?php else: ?>
          Déjà dans une voiture
      <?php endif ?>
    </div

    ><div class="travelCase" style="width: 65%; overflow: scroll">
      <table class="carTable">
        <tr style="background-color:lightgray">
          <th>Conducteur</th>
          <th>Seuls</th>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <th><?= $car["driver"] ?></th>
          <?php endforeach ?>
        </tr>

        <tr style="background-color:white">
          <th>Ville</th>
          <td>───</td>

          <?php foreach($cars["come"]["cars"] as $car): ?>
            <td><?= $car["city"] ?></td>
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
            <td><?= intval($car["maxPlaces"])-count($car["passengers"]) ?></td>
          <?php endforeach ?>
        </tr>


        <?php $maxLines = count($cars["come"]["solo"]); ?>

        <?php foreach($cars["come"]["cars"] as $car) {
          $maxLines = (count($car["passengers"]) > $maxLines) ? count($car["passengers"]) : $maxLines;
        } ?>


        <?php for($i = 0; $i < $maxLines; $i++): ?>
          <tr style="background-color:<?= $i%2==0 ? 'lightgray' : 'white'?>">
            <td>Place <?= $i+1 ?></td>

            <td><?= isset($cars["come"]["solo"][$i]) ? $cars["come"]["solo"][$i] : "" ?></td>

            <?php foreach($cars["come"]["cars"] as $car): ?>
              <td><?= isset($car["passengers"][$i]) ? $car["passengers"][$i] : "" ?></td>
            <?php endforeach ?>
          </tr>
        <?php endfor ?>




        <tr style="background-color:<?= $maxLines%2==0 ? 'lightgray' : 'white'?>">
          <th style="">Actions</th>
          <td style="">
            <?php if($userConf["come"]["isInCar"] == true && $userConf["come"]["isDriver"] == false): ?>
              <button class="mybutton">Quitter</button>
            <?php endif ?>
          </td>


          <?php foreach($cars["come"]["cars"] as $id => $car): ?>
            <td style="">
              <?php if($userConf["come"]["isInCar"] == false && $userConf["come"]["isDriver"] == false): ?>
                <button class="mybutton" onclick="window.location='/?action=joinCar&travel=<?=$id?>'">Rejoindre</button>
              <?php endif ?>
            </td>
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


    <?php if($userConf["back"]["isDriver"] == false && $userConf["back"]["isInCar"] == false): ?>
      <label for="nbPlaces">Nombre de places passagers</label>
      <input id="nbPlaces" name="nbPlaces" type="number" value="4" min="1" max="10"><br><br>

      <button class="mybutton">Ajouter ma voiture</button>

    <?php elseif($userConf["back"]["isDriver"] == true): ?>
      <label for="nbPlaces">Nombre de places passagers : <?= $userConf["back"]["isDriver"]["places"] ?></label><br><br>
      <button class="mybutton">Enlever ma voiture</button>

    <?php else: ?>
      Déjà dans une voiture
    <?php endif ?>
  </div

  ><div class="travelCase" style="width: 65%; overflow: scroll">
    <table class="carTable">
      <tr style="background-color:lightgray">
        <th>Conducteur</th>
        <th>Seuls</th>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <th><?= $car["driver"] ?></th>
        <?php endforeach ?>
      </tr>

      <tr style="background-color:white">
        <th>Ville</th>
        <td>───</td>

        <?php foreach($cars["back"]["cars"] as $car): ?>
          <td><?= $car["city"] ?></td>
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
          <td><?= intval($car["maxPlaces"])-count($car["passengers"]) ?></td>
        <?php endforeach ?>
      </tr>


      <?php $maxLines = count($cars["back"]["solo"]); ?>

      <?php foreach($cars["back"]["cars"] as $car) {
        $maxLines = (count($car["passengers"]) > $maxLines) ? count($car["passengers"]) : $maxLines;
      } ?>


      <?php for($i = 0; $i < $maxLines; $i++): ?>
        <tr style="background-color:<?= $i%2==0 ? 'lightgray' : 'white'?>">
          <td>Place <?= $i+1 ?></td>

          <td><?= isset($cars["back"]["solo"][$i]) ? $cars["back"]["solo"][$i] : "" ?></td>

          <?php foreach($cars["back"]["cars"] as $car): ?>
            <td><?= isset($car["passengers"][$i]) ? $car["passengers"][$i] : "" ?></td>
          <?php endforeach ?>
        </tr>
      <?php endfor ?>




      <tr style="background-color:<?= $maxLines%2==0 ? 'lightgray' : 'white'?>">
        <th style="">Actions</th>
        <td style="">
          <?php if($userConf["back"]["isInCar"] == true && $userConf["back"]["isDriver"] == false): ?>
            <button class="mybutton">Quitter</button>
          <?php endif ?>
        </td>

        <?php foreach($cars["back"]["cars"] as $id => $car): ?>
          <td style="">
            <?php if($userConf["back"]["isInCar"] == false && $userConf["back"]["isDriver"] == false): ?>
              <button class="mybutton" onclick="window.location='/?action=joinCar&travel=<?=$id?>'">Rejoindre</button>
            <?php endif ?>
          </td>
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
