<?php ob_start(); ?>





<?php

$content = ob_get_clean();

require('view/frontend/templateFrontend.php');
?>