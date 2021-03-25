<html>
  <head>
    <link rel="stylesheet" href="view/styles/styles.css">
    <link rel="stylesheet" href="view/styles/cars.css">
    <link rel="stylesheet" href="view/styles/login.css">
    <link rel="stylesheet" href="view/styles/profil.css">

    <title><?= $title != null ? $title : "CPNVoiturage" ?></title>
  </head>


  <body>
    <div id="site">
      <div id="content">
        <div id="title" style="height: 80px">
          <!--<h2>CPNVoiturage</h2>-->
          <a href="/">
            <img src="view/images/PourGG.png">
          </a>
        </div>


        <div id="nav-menu">
          <div class="day-select">

            <div class="day-tab">
              <strong>Jour</strong>
            </div>

            <div class="other-days">
              <div class="nav-tab" onclick="window.location='?page=mon'">
                <strong>Lundi</strong>
              </div>

              <div class="nav-tab" onclick="window.location='?page=tue'">
                <strong>Mardi</strong>
              </div>

              <div class="nav-tab" onclick="window.location='?page=wed'">
                <strong>Mercredi</strong>
              </div>

              <div class="nav-tab" onclick="window.location='?page=thu'">
                <strong>Jeudi</strong>
              </div>

              <div class="nav-tab" onclick="window.location='?page=fri'">
                <strong>Vendredi</strong>
              </div>
            </div>
          </div>

          <?php if(isset($_SESSION["id"])): ?>
            <div id="profil-button" onclick="window.location='?action=signout'">
              <strong>Quitter</strong>
            </div>
          <?php endif ?>
          <?php if(isset($_SESSION["id"])): ?>
            <div id="profil-button" onclick="window.location='?page=profil'">
              <strong>Profil</strong>
            </div>
          <?php endif ?>
          <?php if(isset($_SESSION["id"]) && strlen($_SESSION["acro"]) > 3): ?>
            <div id="profil-button" onclick="window.location='?admin='">
              <strong>Admin</strong>
            </div>
          <?php endif ?>
        </div> <!-- END NAVI-MENU -->


        <div id="page-content">
          <div style="text-align: center; height: 30px; margin-top: 5px; font-size: 20px">
            <strong><?= $pageTitle != null ? $pageTitle : "CPNVoiturage" ?></strong>
          </div>
          <hr>
          <?php if(isset($_SESSION["acro"])): ?><p>Connecté en tant que <?= $_SESSION["acro"] ?></p><?php endif ?>
          <?= $content ?>
        </div>


        <div id="footer">
        </div>
      </div><!-- END SITE -->



    </div>
  </body>
</html>
