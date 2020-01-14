<?php ob_start(); ?>
<div class="container ">
    <section class="page-section">
        <!-- Blog Post -->
        <?php
        if (isset($_SESSION['law_id'])) {
            if ($_SESSION['law_id'] == 1) {
                $nbReport = $numberComment->fetchAll(PDO::FETCH_COLUMN);
                $nbCommentWait = $numberWaitComment->fetchAll(PDO::FETCH_COLUMN);
            }
        }
        while ($postblog = $blogmodel->fetch()) {
            $title = $postblog['post_title'];
            $datepost = $postblog['post_date'];
            $postmessage = $postblog['post_content'];
            $postnumber = $postblog['post_id'];
            $postuser = $postblog['mail'];
            $modificationDate = $postblog['modification_date'];
        ?>
            <div class="text-center border m-2" id="<?= $postnumber ?>">
                <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
                <h2 class="card-title btn-primary rounded-top p-2"><?= $title ?></h2>
                <div class="card-body center">

                    <div>
                        <div class="d-flex align-center justify-content-around">
                            <p class="card-text"><?= substr($postmessage, 0, 200) . '...' ?></p>

                            <?php if (!empty($_SESSION)) { // n'afficher que si l'utilisateur est administrateur
                                if ($_SESSION['law_id'] == 1) { ?>
                                    <?php
                                    if (in_array($postnumber, $nbReport, true)) { // n'afficher que s'il y a des commentaires signalés  
                                        $numberCommentReport = count(array_keys($nbReport, $postnumber, true));  // compter le nombre d'occurence de commentaire signalé pour le post
                                    ?>

                                        <div>
                                            <div class="d-flex">
                                                <a class="table-link">
                                                    <i class="fa fa-bell fa-3x fa-fw text-warning"></i>
                                                </a>
                                                <p class="h1 pl-2 pr-2"><?= $numberCommentReport ?></p>
                                            </div>

                                <?php
                                    }
                                }
                            }  ?>
                                <?php
                                if (isset($_SESSION['law_id'])) {
                                    if ($_SESSION['law_id'] == 1) {
                                        if (in_array($postnumber, $nbCommentWait, true)) { // n'afficher que s'il y a des commentaires signalés  
                                            $numberWaitComment = count(array_keys($nbCommentWait, $postnumber, true));  // compter le nombre d'occurence de commentaire signalé pour le post
                                ?>
                                            <div class="d-flex">
                                                <a class="table-link">
                                                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                                </a>
                                                <p class="h1 pl-2 pr-2"><?= $numberWaitComment ?></p>
                                            </div>
                                        </div>
                            <?php }
                                    }
                                } ?>

                        </div>
                        <div>
                            <a href="index.php?action=longPost&id=<?= $postnumber ?>" class="btn btn-primary">Lire plus ! &rarr;</a>
                        </div>
                    </div>


                </div>
                <div class="card-footer text-muted d-flex ">
                    <p class="d-flex mr-auto p-2">Posté le <?= $datepost ?> par <?= $postuser ?></p>
                    <?php if (isset($modificationDate)) { ?>
                        <p class="d-flex mr-right p-2">Modifié le <?= $modificationDate ?> par <?= $postuser ?></p>
                    <?php } ?>
                    <?php if (!empty($_SESSION)) {
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
                    } ?>
                    <!-- Modal HTML embedded directly into document -->
                    <div id="delete<?= $postnumber ?>" class="modal visible h-25 text-center">
                        <p class="p-2">Veuillez confirmer la suppression</p>
                        <div class="d-flex justify-content-center flex-column">
                            <a href="#" class="btn btn-xl btn-success m-2" rel="modal:close">Non ! je ne veux pas supprimer ce post !</a>
                            <a href="index.php?action=deletePost&id=<?= $postnumber ?>" class="btn btn-xl btn-danger m-2" rel="">Je suis sûr de vouloir le supprimer</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </section>
</div>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>