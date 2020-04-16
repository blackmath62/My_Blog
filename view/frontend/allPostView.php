<?php ob_start(); ?>
<div class="container ">
    <section class="page-section">
        <!-- Blog Post -->
        <?php
        // todo voir pour récupérer le mail au lieu de l'ID = $postuser = $chapoPostList->users_id()
        foreach ($allPostChapo as $chapoPostList) {
            $title = $chapoPostList->post_title;
            $datepost = $chapoPostList->post_date;
            $postmessage = $chapoPostList->post_content;
            $chapo = $chapoPostList->post_chapo;
            $postnumber = $chapoPostList->post_id;
            $postuser = $chapoPostList->users_id;
            $modificationDate = $chapoPostList->modification_date;
            $pseudo = $chapoPostList->Pseudo;
        ?>
            <div class="text-center border m-2" id="<?= $postnumber ?>">
                <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
                <h2 class="card-title btn-primary rounded-top p-2"><?= $title ?></h2>
                <div class="card-body center">

                    <div>
                        <div class="d-flex align-center justify-content-around">
                            <p class="card-text"><?= $chapo . '...' ?></p>
                        </div>
                        <div>
                            <a href="index.php?action=longPost&id=<?= $postnumber ?>" class="btn btn-primary">Lire plus ! &rarr;</a>
                        </div>
                    </div>


                </div>
                <div class="card-footer text-muted d-flex ">
                    <p class="d-flex mr-auto p-2">Posté le <?= $datepost ?> par <?= $pseudo ?></p>
                    <?php if (isset($modificationDate)) { ?>
                        <p class="d-flex mr-right p-2">Modifié le <?= $modificationDate ?> par <?= $pseudo ?></p>
                    <?php } ?>
                </div>
            </div>

        <?php } ?>
    </section>
</div>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>