<?php ob_start(); ?>
<div class="container ">
<section class="page-section">
    <!-- Blog Post -->
    <?php
    while($waitValidation  = $commentModeration->fetch()){ ?>
    <div class="text-center" id="">
            <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
            <div class="card-body">
                <h2 class="card-title btn-primary rounded"><?=$waitValidation['comment_title'] ?></h2>
                <p class="card-text"><?=$waitValidation['comment_content'] ?></p>
                <div>
                <a href="" class="btn btn-primary fa-check-circle-o">Accepter </a>
                <a href="" class="btn btn-danger fa fa-trash-o">Refuser </a> 
                </div>
            </div>
            <div class="card-footer text-muted">
                Posté le <?=$waitValidation['comment_date'] ?> par <?=$waitValidation['users_id'] ?>
            </div>
        </div>
    <?php } ?>
</section>
</div>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>