<?php

ob_start();

$title = "CPNVoiturage - Profil";
$pageTitle = "Profil";



$days = array(
  "monday" =>     array("checkboxId" => "mondayChk",    "francais" => "lundi",    "start" => "monStart", "end" => "monEnd"),
  "tuesday" =>    array("checkboxId" => "tuesdayChk",   "francais" => "mardi",    "start" => "tueStart", "end" => "tueEnd"),
  "wednesday" =>  array("checkboxId" => "wednesdayChk", "francais" => "mercredi", "start" => "wedStart", "end" => "wedEnd"),
  "thursday" =>   array("checkboxId" => "thursdayChk",  "francais" => "jeudi",    "start" => "thuStart", "end" => "thuEnd"),
  "friday" =>     array("checkboxId" => "fridayChk",    "francais" => "vendredi", "start" => "friStart", "end" => "friEnd"),
);

?>




<div style="margin: 20px">
  <form method="POST" action="/?action=updateProfile">
  <label for="villePassage">
    <strong style="font-size: 16px">Ville de passage</strong>
  </label>
  <select id="villePassage" name="villePassage" autocomplete="off">
    <?php foreach($cityOptions as $oneCity): ?>
      <option value="<?= $oneCity["id"] ?>" <?= ($oneCity["id"] == $profil["city"]) ? "selected" : "" ?>><?= $oneCity["name"] ?></option>
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
          <th>Heure de début</th>

          <?php foreach($days as $id => $day): ?>
            <td>
              <select autocomplete="off"
                id="<?= $day["start"] ?>"
                name="<?= str_replace("Start", "Arr", $day["start"]) ?>">

                <?php foreach($startOptions as $start): ?>
                  <option
                    value="<?= $start["id"] ?>"
                    <?= $profil[$id]["startWork"]==$start["id"] ? "selected" : "" ?>>

                    <?= $start["hour"] ?>
                  </option>
                <?php endforeach ?>
              </select>
            </td>
          <?php endforeach ?>
        </tr>

        <tr>
          <th>Heure de fin</th>
          <?php foreach($days as $id => $day): ?>
            <td>
              <select autocomplete="off"
                id="<?= $day["end"] ?>"
                name="<?= str_replace("End", "Dep", $day["end"]) ?>">

                <?php foreach($endOptions as $end): ?>
                  <option
                    value="<?= $end["id"] ?>"
                    <?= $profil[$id]["endWork"]==$end["id"] ? "selected" : "" ?>>

                    <?= $end["hour"] ?>
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
      <?php if(isset($_GET["error"])): ?><p style="color:red">Error, user not found</p><?php endif ?>
      <button class="mybutton" type="submit">Sauvegarder</button>
      <button class="mybutton" type="button" onclick="window.location='/?action=importEDT'">Import de EDT</button>
    </div>
  </form>
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
