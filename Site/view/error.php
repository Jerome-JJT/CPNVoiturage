<?php

ob_start();

$title = "CPNVoiturage - Erreur";
$pageTitle = "Erreur";

?>


<div>
  <h3>Le site est en maintenance, merci de réessayer plus tard.</h3>
</div>


<?php

  $content = ob_get_clean();
  require("view/gabarit.php");

?>
