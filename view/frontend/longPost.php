<?php ob_start(); ?>
<div class="container ">
<section class="page-section">
    <!-- Blog Post -->
    <?php
    while ($postblog = $blogmodel->fetch()) {
        $chapo = $postblog['post_title'];
        $datepost = $postblog['post_date'];
        $postmessage = $postblog['post_content'];
        $postnumber = $postblog['post_id'];
        $postuser = $postblog['mail'];
        ?>
    <div class="text-center" id=<?=$postnumber?>>
            <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->

            <div class="card-body">
                <h2 class="card-title btn-xl btn-primary"><?= $chapo ?></h2>
                <p class="card-text"><?= $postmessage ?></p>
                
            </div>
            <div class="card-footer text-muted">
                Posté le <?= $datepost ?> par <?= $postuser ?>
            </div>
        </div>
    <?php } ?>
</section>
</div>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>