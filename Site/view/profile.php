<?php

ob_start();

$title = "CPNVoiturage - Profil";
$pageTitle = "Profil";

$cityOptions = array(
  "Yverdon",
  "Lausanne",
  "Vuiteboeuf",
  "Baulmes",
  "Orbe"
);

$startOptions = array(
  "8h00",
  "8h50",
  "9h50",
  "10h40",
  "11h30",
  "13h30",
  "14h20",
  "15h20",
  "16h10"
);

$endOptions = array(
  "8h45",
  "9h35",
  "10h35",
  "11h45",
  "12h15",
  "14h15",
  "15h05",
  "16h10",
  "16h55"
);


$profil = array(
  "city" => "Orbe",
  "monday" => array(
    "enabled" => true,
    "startWork" => "10h40",
    "endWork" => "16h00"
  ),
  "tuesday" => array(
    "enabled" => false,
    "startWork" => "8h00",
    "endWork" => "16h00"
  ),
  "wednesday" => array(
    "enabled" => true,
    "startWork" => "13h30",
    "endWork" => "16h00"
  ),
  "thursday" => array(
    "enabled" => false,
    "startWork" => "8h00",
    "endWork" => "16h10"
  ),
  "friday" => array(
    "enabled" => true,
    "startWork" => "8h00",
    "endWork" => "16h00"
  )
);


$days = array(
  "monday" =>     array("checkboxId" => "mondayChk",    "francais" => "lundi",    "start" => "monStart", "end" => "monEnd"),
  "tuesday" =>    array("checkboxId" => "tuesdayChk",   "francais" => "mardi",    "start" => "tueStart", "end" => "tueEnd"),
  "wednesday" =>  array("checkboxId" => "wednesdayChk", "francais" => "mercredi", "start" => "wedStart", "end" => "wedEnd"),
  "thursday" =>   array("checkboxId" => "thursdayChk",  "francais" => "jeudi",    "start" => "thuStart", "end" => "thuEnd"),
  "friday" =>     array("checkboxId" => "fridayChk",    "francais" => "vendredi", "start" => "friStart", "end" => "friEnd"),
);

?>




<div style="margin: 20px">
  <label for="villePassage">
    <strong style="font-size: 16px">Ville de passage</strong>
  </label>
  <select id="villePassage" name="villePassage" autocomplete="off">
    <?php foreach($cityOptions as $city): ?>
      <option value="<?=$city?>" <?= $city==$profil["city"] ? "selected='selected'" : "" ?>><?=$city?></option>
    <?php endforeach ?>
  </select>
  <br>
  <br>

  <div style="overflow-x:scroll;">
    <table class="profilTable">
      <tr>
        <th>Trajet du jour</th>

        <?php foreach($days as $id => $day): ?>
          <th>
            <input type="checkbox"
            id="<?= $day["checkboxId"] ?>"
            onchange="<?= "updateDay('".$day["checkboxId"]."'" ?>)"
            <?= $profil[$id]["enabled"] ? "checked" : "" ?>><!--

            --><label for="<?= $day["checkboxId"] ?>">Trajet <?= $day["francais"] ?></label>
          </th>
        <?php endforeach ?>

      </tr>

      <tr>
        <th>Heure de fin</th>

        <?php foreach($days as $id => $day): ?>
          <td>
            <select autocomplete="off"
              id="<?= $day["start"] ?>"
              name="<?= $day["start"] ?>">

              <?php foreach($startOptions as $start): ?>
                <option
                  name="<?= $start ?>"
                  <?= $profil[$id]["startWork"]==$start ? "selected" : "" ?>>

                  <?= $start ?>
                </option>
              <?php endforeach ?>
            </select>
          </td>
        <?php endforeach ?>
      </tr>

      <tr>
        <th>Heure de début</th>
        <?php foreach($days as $id => $day): ?>
          <td>
            <select autocomplete="off"
              id="<?= $day["end"] ?>"
              name="<?= $day["end"] ?>">

              <?php foreach($startOptions as $start): ?>
                <option
                  name="<?= $start ?>"
                  <?= $profil[$id]["endWork"]==$start ? "selected" : "" ?>>

                  <?= $start ?>
                </option>
              <?php endforeach ?>
            </select>
          </td>
        <?php endforeach ?>
      </tr>
    </table>
    <br>
  </div>

  <br>
  <div style="text-align: center;">
    <button class="mybutton">Sauvegarder</button>
    <button class="mybutton">Remettre par défaut</button>
  </div>
</div>


<script>
  let ids = {
    <?php foreach($days as $id => $day): ?>
      <?= "'".$day["checkboxId"]."': ['".$day["start"]."', '".$day["end"]."']," ?>
    <?php endforeach ?>
  };

  function updateDay(day)
  {
    if(typeof ids[day] != undefined)
    {
      ids[day].forEach(item => {
        document.getElementById(item).disabled = !document.getElementById(day).checked;
      });
    }
  }


  for (key in ids) {
    updateDay(key);
  }

</script>


<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
