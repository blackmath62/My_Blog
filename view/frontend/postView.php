<?php ob_start(); ?>
<div class="container ">
    <section class="page-section">
        <!-- Blog Post -->
        <div class="text-center border" id="<?= $postnumber ?>">
            <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->

            <div class="card-body">
                <h2 class="card-title btn-xl btn-primary"><?= $title ?></h2>
                <p class="card-text"><?= nl2br($postmessage) ?></p>
            </div>
            <div class="text-muted card-footer d-flex">
            <p class="mr-auto p-2">Posté le <?= $datepost ?> par <?= $postuser ?></p>
            <?php $modificationDate = $blogmodel['modification_date'];
                    ?>
            <?php if (isset($modificationDate)) { ?>
                <p class="mr-right p-2">Modifié le <?= $modificationDate ?> par <?= $postuser ?></p>
            <?php } ?>
            </div>
        </div>
    </section>
    <?php
    while ($listComment = $commentmodel->fetch()) {
        $commentId = $listComment['comment_id'];
        $commentTitle = $listComment['comment_title'];
        $dateComment = $listComment['comment_date'];
        $commentMessage = $listComment['comment_content'];
        $commentUser = $listComment['mail'];
        ?>
        <div class="card card-inner mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
                        <p class="text-secondary text-center"><?= $dateComment ?></p>
                    </div>
                    <div class="col-md-10">
                        <p><a href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong><?= $commentTitle ?></strong> par <?= $commentUser ?></a></p>
                        <p><?php echo nl2br($commentMessage) ?></p>
                        <!--Pour avoir les sauts de ligne à l'affichage-->
                        <p>
                            <a class="float-right btn text-white btn-danger" href="index.php?action=reportComment&commentid=<?=$commentId ?>&postid=<?=$postnumber ?>"> <i class="fa fa-bell"></i> Signaler</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    <?php }
    $postId = $_GET["id"]; ?>

    <?php

    if (isset($_SESSION['users_id'])) { ?>
        <!--Commentaires-->
        <section class="mb-4 center bg-primary pt-4" id="contact">
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
}
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>