<?php ob_start(); ?>

<div class="container">
    <section class="page-section">
        <div class="row h-100 align-items-center justify-content-center text-center">
Votre message a bien été envoyé !
        </div>
    </section>
</div>

<?php

$content = ob_get_clean();

require('view/frontend/htmlTemplate.php');
?>