<?php

ob_start();

$title = "CPNVoiturage - Login";
$pageTitle = "Connexion";

?>




<div id="login-page">
  <p style="text-align:center">
    Merci de vous connecter pour accéder au site
  </p>

  <p style="text-align:center; color: red">
    <?= $errorMsg ?>
  </p>

  <div class="login-block">
    <h3>Connexion</h3>

    <form method="POST" action="?action=loginAccount">
      <table class="login-table">
        <tr>
          <th>Abréviation CPNV</th>

          <td><input type="text" name="acronym" value="<?= $acronym ?>" required></td>
        </tr>
        <tr>
          <th>Mot de passe</th>

          <td><input type="password" name="password" required></td>
        </tr>

        <tr>
          <td colspan="2">
            <button type="submit" class="mybutton">Login</button>
            <a href="mailto:jerome.jaquemet@cpnv.ch"><button type="button" class="mybutton">Mot de passe oublié</button></a>
          </td>
        </tr>
      </table>
    </form>
  </div

  ><div class="login-bar">
  </div

  ><div class="login-block">
    <h3>Nouveau compte</h3>

    <form method="POST" action="?action=createAccount">
      <table class="login-table">
        <tr>
          <th>Abréviation CPNV</th>

          <td><input type="text" name="acronym" value="<?= $acronym ?>" required></td>
        </tr>
        <tr>
          <th>Ville de passage</th>

          <td>
            <select name="city" required>
              <?php foreach($citiesList as $oneCity): ?>
                <option value="<?= $oneCity["id"] ?>" <?= ($oneCity["id"] == $city) ? "selected" : "" ?>><?= $oneCity["name"] ?></option>
              <?php endforeach ?>
            </select>
          </td>
        </tr>
        <tr>
          <th>Mot de passe</th>

          <td><input type="password" name="password" required></td>
        </tr>
        <tr>
          <th>Répéter le mot de passe</th>

          <td><input type="password" name="repeatPassword" required></td>
        </tr>
        <tr>
          <td colspan="2">
            <button type="submit" class="mybutton">Créer</button>
          </td>
        </tr>
      </table>
    </form>
  </div>


</div>




<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
