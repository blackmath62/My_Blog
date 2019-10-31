<?php ob_start(); ?>


<p>Nous n'avons rien a afficher</p>


<?php

$content = ob_get_clean();

require('view/frontend/templateFrontend.php');
?>