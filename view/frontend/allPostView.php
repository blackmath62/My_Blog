<?php ob_start(); ?>
<div class="container ">
<section class="page-section">
    <!-- Blog Post -->
    <?php
    while ($postblog = $blogmodel->fetch()) {
        $title = $postblog['post_title'];
        $datepost = $postblog['post_date'];
        $postmessage = $postblog['post_content'];
        $postnumber = $postblog['post_id'];
        $postuser = $postblog['mail'];
        ?>
    <div class="text-center" id="<?=$postnumber?>">
            <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->

            <div class="card-body">
                <h2 class="card-title btn-xl btn-primary"><?= $title ?></h2>
                <p class="card-text"><?= substr($postmessage, 0, 200).'...' ?></p>
                <a href="index.php?action=longPost&id=<?=$postnumber?>" class="btn btn-primary">Lire plus ! &rarr;</a>
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