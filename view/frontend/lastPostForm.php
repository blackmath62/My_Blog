<!-- Services Section -->
<section class="p-5" id="services">
    <div class="container center">
        <!-- Blog Post -->
        <a class="h1 font-weight-bold">blog</a>
        <hr class="divider my-4">
        <div class="row row-cols-1 row-cols-md-3 card-group">
            <?php
            // todo voir pour récupérer le mail au lieu de l'ID = $postuser = $chapoHomePage->users_id() 
            foreach ($homePageChapo as $chapoHomePage) {
                $title = $chapoHomePage->post_title;
                $datepost = $chapoHomePage->post_date;
                $chapo = $chapoHomePage->post_chapo;
                $postuser = $chapoHomePage->Pseudo;
                $postnumber = $chapoHomePage->post_id;
            ?>

                    <div class="col mb-4 card m-2 border rounded p-0" id="<?= $postnumber ?>">
                        <div class="card-body">
                            <h2 class="card-title"><?= substr($title, 0, 25) . '...' ?></h2>
                            <p class="card-text"><?= $chapo . '...' ?></p>
                        </div>
                        <div>
                            <a href="index.php?action=longPost&id=<?= $postnumber ?>" class="btn btn-primary m-3">Lire plus ! &rarr;</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Posté le <?= $datepost ?> par <?= $postuser ?></small>
                        </div>
                    </div>
               

            <?php } ?>
        </div>
        <a class="btn btn-primary js-scroll-trigger text-center m-4 btn-xl" href="index.php?action=blog">Consulter tous mes posts</a>
    </div>
</section>