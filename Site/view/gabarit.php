<html>
  <head>
    <link rel="stylesheet" href="view/styles/styles.css">
    <link rel="stylesheet" href="view/styles/cars.css">

    <title><?= $title != null ? $title : "CPNVoiturage" ?></title>
  </head>


  <body>
    <div id="site">
      <div id="title" style="height: 80px">
        <!--<h2>CPNVoiturage</h2>-->
        <img style="height:80px" src="view/images/PourGG.png">
      </div>


      <div id="content">
        <div id="nav-menu">
          <div class="day-select">

            <div class="day-tab">
              <strong>Jour</strong>
            </div>

            <div class="other-days">
              <div class="nav-tab">
                <strong>Lundi</strong>
              </div>

              <div class="nav-tab">
                <strong>Mardi</strong>
              </div>

              <div class="nav-tab">
                <strong>Mercredi</strong>
              </div>

              <div class="nav-tab">
                <strong>Jeudi</strong>
              </div>

              <div class="nav-tab">
                <strong>Vendredi</strong>
              </div>
            </div>
          </div>


          <div id="profil-button">
            <strong>Profil</strong>
          </div>
        </div> <!-- END NAVI-MENU -->


        <div id="page-content">
          <div style="text-align: center; height: 30px; margin-top: 5px; font-size: 20px">
            <strong><?= $pageTitle != null ? $pageTitle : "CPNVoiturage" ?></strong>
          </div>

          <?= $content ?>
        </div>
      </div><!-- END SITE -->

      <div id="footer">
      </div>

    </div>
  </body>
</html>
