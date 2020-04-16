<?php ob_start(); ?>
<!-- Portfolio Section -->
<section class="p-5 m-5">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-5 center">
                <a href="index.php?action=newPost">
                <i class="fa fa-plus-square fa-5x p-4" alt=""></i>

                    <div class="project-category text-center">
                        <h4>Créer un post</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-4 col-sm-5 center">
                <a href="index.php?action=listingPost">
                <i class="fa fa-pencil fa-5x p-4" alt=""></i>

                    <div class="project-category text-center">
                        <h4>Modifier un post</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-4 col-sm-5 center">
                <a href="index.php?action=listingPost">
                <i class="fa fa-trash fa-5x p-4" alt=""></i>

                    <div class="project-category text-center">
                        <h4>Supprimer un post</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-4 col-sm-5 center">
                <a href="index.php?action=usersList">
                <i class="fa fa-user fa-5x p-4" alt=""></i>

                    <div class="project-category text-center">
                        <h4>Utilisateurs</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-4 col-sm-5 center">
                <a href="index.php?action=listingComment">
                <i class="fa fa-comments fa-5x p-4" alt=""></i>

                    <div class="project-category text-center">
                        <h4>Modération des commentaires</h4>
                    </div>

                </a>
            </div>
            <div class="col-lg-4 col-sm-5 center d-none">
                <a href="index.php?action=blog">
                <i class="fa fa-bell fa-5x p-4" alt=""></i>

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