<?php ob_start(); ?>
<section class="container ">
   <!-- Blog Post -->
   <?php 
                while ($postblog = $blogmodel->fetch()) {
        $chapo = $postblog['post_title'];
        $datepost = $postblog['post_date'];
        $postmessage = $postblog['post_content'];
        $postuser = $postblog['users_id'];
                    ?>
   <div class="text-center">
                <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
                
                <div class="card-body">
                    <h2 class="card-title"><?=$chapo ?></h2>
                    <p class="card-text"><?=$postmessage?></p>
                    <a href="#" class="btn btn-primary">Lire plus ! &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posté le <?= $datepost ?> par <?=$postuser ?>
                </div>
            </div>
                <?php } ?>  
</section>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>