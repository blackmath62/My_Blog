<?php ob_start(); ?>
<div class="container ">
<section class="page-section">
    <!-- Blog Post -->
    <div class="text-center">
            <div class="card-body">
                Le post a été supprimé !
            </div>
        </div>
</section>
</div>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>