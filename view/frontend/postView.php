<?php ob_start(); ?>
<div class="container ">
    <section class="page-section">
        <!-- Blog Post -->
        <div class="text-center border" id="<?= $GetLongPost->post_id() ?>">
             <!--<img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
            <h2 class="card-title btn-primary rounded p-2"><?= $GetLongPost->post_title() ?></h2>
            <div class="card-body">
                <p class="card-text"><?= nl2br($GetLongPost->post_content()) ?></p>
            </div>
            <div class="text-muted card-footer d-flex">
                <p class="mr-auto p-2">Posté le <?= $GetLongPost->post_date() ?> par <?= $GetLongPost->users_id() ?></p>
                <?php
                if(!empty($GetLongPost->modification_date())){
                     ?>
                    <p class="mr-right p-2">Modifié le <?= $GetLongPost->modification_date() ?> par <?= $GetLongPost->users_id() ?></p>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php
     // todo voir pour récupérer le mail au lieu de l'ID = $commentUser = $comment->users_id();
    foreach ($getComment as $comment) {
        $commentId = $comment->comment_id();
        $commentValidateId = $comment->validate_id();
        $commentTitle = $comment->comment_title();
        $dateComment = $comment->comment_date();
        $commentMessage = $comment->comment_content();
        $commentUser = $comment->users_id();
        ?>
        <div class="card card-inner mb-4">
            <div class="card-body pb-0">
                <div class="row">
                    <!--<div class="col-md-2 align-self-center">
                         <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" /> 
                    </div>-->
                    <div class="col-md-10">
                        <div class="d-flex flex-column">
                        <p><a class="text-primary"><strong><?= $commentTitle ?></strong></a></p>
                        <p><?php echo nl2br($commentMessage) ?></p>
                        </div>
                        <!--Pour avoir les sauts de ligne à l'affichage-->
                       
                    </div>
                    <div class="card-footer w-100 center">
                    <p class="text-secondary text-center">Commentaire du <?= $dateComment ?> par <?= $commentUser ?></p>
                </div>
                </div>
            </div>
        </div>
    <?php }
    $postId = $_GET["id"]; ?>
    <?php // Comment Form
    if (isset($_SESSION['mail'])) { ?>
        <!--Commentaires-->
        <section class="mb-4 center bg-primary pt-4 rounded" id="contact">
            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center text-white">Déposez un commentaire</h2>
            <div class="row">
                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5 mx-auto">
                    <form id="contact-form" name="contact-form" action="index.php?action=commentaire&id=<?= $postId ?>" method="POST">
                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0 text-white">
                                    <label for="subject" class="">Titre</label>
                                    <input type="text" id="subject" name="subject" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->
                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="md-form text-white center">
                                    <label for="message">Message</label>
                                    <textarea type="text" id="message" name="message" rows="5" class="form-control md-textarea" required></textarea>
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->
                        <div class="text-center m-5">
                            <button class="btn btn-light btn-xl js-scroll-trigger">Envoyer</button>
                        </div>
                    </form>
                    <div class="status"></div>
                </div>
            </div>
        </section>
</div>
<?php
}
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>