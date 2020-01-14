<?php ob_start(); ?>
<div class="container ">
    <section class="page-section">
        <!-- Blog Post -->
        <div class="text-center border" id="<?= $postnumber ?>">
            <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
            <h2 class="card-title btn-primary rounded p-2"><?= $title ?></h2>
            <div class="card-body">
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
    if($_SESSION['law_id'] == 1){
        $adminReportList = $checkAllReport->fetchAll(PDO::FETCH_COLUMN);
    }else{
    $reportList = $checkAllreadyReport->fetchAll(PDO::FETCH_COLUMN); // Vu utilisateur, pour les commentaires qu'il a signalé
    }
    while ($listComment = $commentmodel->fetch()) {
        $commentId = $listComment['comment_id'];
        $commentTitle = $listComment['comment_title'];
        $dateComment = $listComment['comment_date'];
        $commentMessage = $listComment['comment_content'];
        $commentUser = $listComment['mail'];
        ?>
        <div class="card card-inner mb-4">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-2 align-self-center">
                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
                        <p class="text-secondary text-center"><?= $dateComment ?></p>
                    </div>
                    <div class="col-md-10">
                        <div class="d-flex flex-column">
                        <p><a class="text-primary"><strong><?= $commentTitle ?></strong> par <?= $commentUser ?></a></p>
                        <p><?php echo nl2br($commentMessage) ?></p>
                        </div>
                        <!--Pour avoir les sauts de ligne à l'affichage-->
                        <p>
                        <?php
                        if($_SESSION['law_id'] == 1){
                             if (!empty($_SESSION)) {
                                if ($_SESSION['law_id'] == 1) { ?>
                                <a href="index.php?action=changePost&id=<?= $postnumber ?>" class="table-link">
                                    <span class="fa-stack ml-2">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse btn-warning rounded"></i>
                                    </span>
                                </a>
                                <a href="#delete<?= $postnumber ?>" rel="modal:open" class="table-link danger">
                                    <span class="fa-stack ml-2">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse btn-danger rounded"></i>
                                    </span>
                                </a>
                        <?php }
                        else{
                        if(in_array($commentId,$reportList,true)){
                            $numberReportComment = count(array_keys($adminReportList,$commentId,true));  // compter le nombre d'occurence de commentaire signalé pour le post
                        }
                    } ?>
                        <a class="float-right btn text-white btn-success" href="index.php?action=removeReport&commentid=<?= $commentId ?>&postid=<?= $postnumber ?>"> <i class="fa fa-bell-slash"></i> Retirer Signalement</a> 
                        <?php                     
                        }else{
                        ?>
                        <a class="float-right btn text-white btn-danger" href="index.php?action=reportComment&commentid=<?= $commentId ?>&postid=<?= $postnumber ?>"> <i class="fa fa-bell"></i> Signaler</a>
                            <?php
                    }     }                                         
                         ?> 
                        </p>   
                    </div>
                    <div class="card-footer w-100 center">
                    <?php 
                    if($listComment['validate_id'] <> 2 ){
                    ?>
                    <a class="btn text-white btn-primary m-2" href="index.php?action=removeReport&commentid=<?= $commentId ?>&postid=<?= $postnumber ?>"> <i class="fa fa-check "></i> Accepter le commentaire</a> 
                    <?php } 
                    if($listComment['validate_id'] <> 3 ){
                        ?>
                    <a class="btn text-white btn-danger m-2" href="index.php?action=removeReport&commentid=<?= $commentId ?>&postid=<?= $postnumber ?>"> <i class="fa fa-times "></i> Refuser le commentaire</a> 
                    <?php } 
                    if(isset($numberReportComment)){
                    if($numberReportComment > 0){
                    ?>
                    <a class="btn text-white btn-warning m-2" href="index.php?action=removeReport&commentid=<?= $commentId ?>&postid=<?= $postnumber ?>"> <i class="fa fa-bell "></i> <?=$numberReportComment ?> Signalement</a>
                    <?php } }
                    if($listComment['validate_id'] == 3){ ?>
                    <a class="text-danger">Le commentaire a déjà été Refusé </a>
                       <?php } ?>
                       <?php if($listComment['validate_id'] == 2){ ?>
                    <a class="text-primary">Le commentaire a déjà été accepté </a>
                       <?php } ?>
                       <?php if($listComment['validate_id'] == 1){ ?>
                    <a class="text-success">Nouveau commentaire ! </a>
                       <?php } ?>
                </div>
                </div>
            </div>
        </div>
    <?php }
    $postId = $_GET["id"]; ?>
    <?php // Comment Form
    if (isset($_SESSION['users_id'])) { ?>
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