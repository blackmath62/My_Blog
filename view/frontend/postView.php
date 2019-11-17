<?php ob_start();?>
<div class="container ">
<section class="page-section">
    <!-- Blog Post -->
    <div class="text-center" id="<?=$postnumber?>">
            <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->

            <div class="card-body">
                <h2 class="card-title btn-xl btn-primary"><?= $title ?></h2>
                <p class="card-text"><?= $postmessage ?></p>
            </div>
            <div class="card-footer text-muted">
                Posté le <?= $datepost ?> par <?= $postuser ?>
            </div>
        </div>
</section>
<?php $postId = $_GET["id"]; ?>
<!--Commentaires-->
<section class="mb-4 center bg-primary pt-4" id="contact">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center text-white">Déposez un commentaire</h2>
    <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5 mx-auto">
            <form id="contact-form" name="contact-form" action="index.php?action=commentaire&id=<?=$postId ?>" method="POST">
                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0 text-white">
                        <label for="subject" class="">Titre</label>
                            <input type="text" id="subject" name="subject" class="form-control">
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
                            <textarea type="text" id="message" name="message" rows="5" class="form-control md-textarea"></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->
            </form>
            <div class="text-center m-5">
                <a class="btn btn-light btn-xl js-scroll-trigger" onclick="document.getElementById('contact-form').submit();">Envoyer</a>
            </div>
            <div class="status"></div>
        </div>
    </div>

</section>
</div>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>