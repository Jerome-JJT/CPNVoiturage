<?php

ob_start();

$title = "CPNVoiturage - Profil";
$pageTitle = "Profil";

?>




<div style="margin: 20px">
  <label for="villePassage">
    <strong style="font-size: 16px">Ville de passage</strong>
  </label>
  <select id="villePassage" name="villePassage">
    <option>Yverdon</option>
    <option>Lausanne</option>
    <option>Vuiteboeuf</option>
    <option>Baulmes</option>
    <option>Orbe</option>
  </select>
  <br>
  <br>

  <div style="overflow-x:scroll;">
    <table class="profilTable">
      <tr>
        <th>Trajet du jour</th>
        <th onclick="toggleChk('mondayChk')">
          <input id="mondayChk" type="checkbox" onchange="updateDay(this.id)"><label for="mondayChk">Trajet lundi</label>
        </th>
        <th onclick="toggleChk('tuesdayChk')">
          <input id="tuesdayChk" type="checkbox" onchange="updateDay(this.id)"><label for="tuesdayChk">Trajet mardi</label>
        </th>
        <th onclick="toggleChk('wednesdayChk')">
          <input id="wednesdayChk" type="checkbox" onchange="updateDay(this.id)"><label for="wednesdayChk">Trajet mercredi</label>
        </th>
        <th onclick="toggleChk('thursdayChk')">
          <input id="thursdayChk" type="checkbox" onchange="updateDay(this.id)"><label for="thursdayChk">Trajet jeudi</label>
        </th>
        <th onclick="toggleChk('fridayChk')">
          <input id="fridayChk" type="checkbox" onchange="updateDay(this.id)"><label for="fridayChk">Trajet vendredi</label>
        </th>
      </tr>

      <tr>
        <th>Heure d'arrivée</th>
        <td>
          <select id="monArr" name="monArr">
            <option>8h00</option>
            <option>8h50</option>
            <option>9h50</option>
            <option>10h35</option>
            <option>11h30</option>
            <option>11h30</option>
          </select>
        </td>
        <td>
          <select id="tueArr" name="tueArr">
            <option>8h00</option>
          </select>
        </td>
        <td>
          <select id="wedArr" name="wedArr">
            <option>8h00</option>
          </select>
        </td>
        <td>
          <select id="thuArr" name="thuArr">
            <option>8h00</option>
          </select>
        </td>
        <td>
          <select id="friArr" name="friArr">
            <option>8h00</option>
          </select>
        </td>
      </tr>

      <tr>
        <th>Heure de départ</th>
        <td>
          <select id="monDep" name="monDep">
            <option>8h00</option>
            <option>8h50</option>
            <option>9h50</option>
            <option>10h35</option>
            <option>11h30</option>
            <option>11h30</option>
          </select>
        </td>
        <td>
          <select id="tueDep" name="tueDep">
            <option>8h00</option>
          </select>
        </td>
        <td>
          <select id="wedDep" name="wedDep">
            <option>8h00</option>
          </select>
        </td>
        <td>
          <select id="thuDep" name="thuDep">
            <option>8h00</option>
          </select>
        </td>
        <td>
          <select id="friDep" name="friDep">
            <option>8h00</option>
          </select>
        </td>
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
    "mondayChk": ["monArr", "monDep"],
    "tuesdayChk": ["tueArr", "tueDep"],
    "wednesdayChk": ["wedArr", "wedDep"],
    "thursdayChk": ["thuArr", "thuDep"],
    "fridayChk": ["friArr", "friDep"]
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


  function toggleChk(id)
  {
    document.getElementById(id).checked = !document.getElementById(id).checked;
    document.getElementById(id).onchange();
  }

</script>


<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
