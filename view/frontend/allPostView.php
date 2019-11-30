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
            <div class="text-center border m-2" id="<?= $postnumber ?>">
                <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
                <h2 class="card-title btn-primary rounded-top p-2"><?= $title ?></h2>
                <div class="card-body">
                    
                    <p class="card-text"><?= substr($postmessage, 0, 200) . '...' ?></p>
                    <a href="index.php?action=longPost&id=<?= $postnumber ?>" class="btn btn-primary">Lire plus ! &rarr;</a>
                </div>
                <div class="card-footer text-muted d-flex">
                    <p class="d-flex mr-auto p-2">Posté le <?= $datepost ?> par <?= $postuser ?></p>
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