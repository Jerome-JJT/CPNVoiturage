<?php

ob_start();

$title = "Voitures - Admin";
$pageTitle = "Administration";


?>



<div class="travelDisplay" style="background-color: white">
  <div style="text-align: center; height: 15%; font-size: 20px">
    <strong>Validation</strong>
  </div>

  <?php if(isset($headers) && isset($_SESSION["edtData"])): ?>
    <form method="POST" action="?action=executeEDT">
      <div style="width:90%; margin-left: 5%; height:75%; overflow: scroll">
        <table style="width:100%; height:100%; background-color: lightgray; border-collapse: collapse;">
          <tr>
            <?php foreach($profCanvas as $header => $value): ?>
              <th style="border: 1px solid black"><?= $header ?></th>
            <?php endforeach ?>
          </tr>

          <?php foreach($_SESSION["edtData"] as $line): ?>
            <tr>
              <?php foreach($profCanvas as $header => $value): ?>
                <td style="border: 1px solid black"><?= $line[$header] ?></td>
              <?php endforeach ?>
            </tr>
          <?php endforeach ?>
        </table>
      </div>
      <button style="margin-left: 5%;" type="submit">Executer</button>
    </form>
  <?php endif ?>
</div>


<div style="width: 90%; margin: 15px 5%; border: 4px solid black; border-radius: 50% / 80%">
</div>


<div class="travelDisplay">
  <div style="text-align: center; height: 15%; font-size: 20px">
    <strong>Données</strong>
  </div>

  <div>
    <form method="POST" action="?action=validateEDT">
      <textarea name="data" style="width: 90%; height: 70%; margin-left: 5%;"></textarea><br>
      <button style="margin-left: 5%;" type="submit">Envoyer</button>
    </form>
  </div>

</div>

<br>



<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
