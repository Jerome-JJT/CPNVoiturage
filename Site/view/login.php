<?php

ob_start();

$title = "CPNVoiturage - Login";
$pageTitle = "Connexion";

?>




<div id="login-page">
  <p style="text-align:center">
    Merci de vous connecter pour accéder au site
  </p>

  <div class="login-block">
    <h3>Connexion</h3>
    <table class="login-table">
      <tr>
        <th>Abréviation CPNV</th>

        <td><input type="text"></td>
      </tr>
      <tr>
        <th>Mot de passe</th>

        <td><input type="password"></td>
      </tr>

      <tr>
        <td colspan="2">
          <button class="mybutton">Login</button>
          <button class="mybutton">Mot de passe oublié</button>
        </td>
      </tr>
    </table>
  </div

  ><div class="login-bar">
  </div

  ><div class="login-block">
    <h3>Nouveau compte</h3>
    <table class="login-table">
      <tr>
        <th>Abréviation CPNV</th>

        <td><input type="text"></td>
      </tr>
      <tr>
        <th>Ville de passage</th>

        <td>
          <select id="villePassage" name="villePassage">
            <option>Yverdon</option>
            <option>Lausanne</option>
            <option>Vuiteboeuf</option>
            <option>Baulmes</option>
            <option>Orbe</option>
          </select>
        </td>
      </tr>
      <tr>
        <th>Mot de passe</th>

        <td><input type="password"></td>
      </tr>
      <tr>
        <th>Répéter le mot de passe</th>

        <td><input type="password"></td>
      </tr>
      <tr>
        <td colspan="2">
          <button class="mybutton">Créer</button>
        </td>
      </tr>
    </table>
  </div>


</div>




<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
