<?php ob_start(); ?>
<!-- Portfolio Section -->
<section class="p-5 m-5">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-lg-2 col-sm-5 border">
                <a href="index.php?action=newPost">
                    <img class="img-fluid" src="public/img/add.jpg" alt="">

                    <div class="project-category text-center">
                        <h4>Créer un post</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-2 col-sm-5 border">
                <a href="index.php?action=blog">
                    <img class="img-fluid" src="public/img/modifier.jpg" alt="">

                    <div class="project-category text-center">
                        <h4>Modifier un post</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-2 col-sm-5 border">
                <a href="index.php?action=blog">
                    <img class="img-fluid" src="public/img/supprimer.jpg" alt="">

                    <div class="project-category text-center">
                        <h4>Supprimer un post</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-2 col-sm-5 border">
                <a href="index.php?action=usersList">
                    <img class="img-fluid" src="public/img/users.jpg" alt="">

                    <div class="project-category text-center">
                        <h4>Utilisateurs</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-2 col-sm-5 border">
                <a href="index.php?action=commentModeration">
                    <img class="img-fluid" src="public/img/moderation.jpg" alt="">

                    <div class="project-category text-center">
                        <h4>Modération des commentaires</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-2 col-sm-5 border">
                <a href="index.php?action=commentReport">
                    <img class="img-fluid" src="public/img/signaler.jpg" alt="">

                    <div class="project-category text-center project-name">
                        <h4 class="">Commentaires signalés</h4>
                    </div>

                </a>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>