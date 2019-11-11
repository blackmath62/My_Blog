
<?php ob_start(); ?>
<!-- Masthead -->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-uppercase text-white font-weight-bold">Pochet Jérôme</h1>
                <hr class="divider my-4">
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5">Développeur Web HTML, CSS, PHP, SQL</p>
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">à propos</a>
            </div>
        </div>
    </div>
</header>

<!-- About Section -->
<section class="page-section bg-primary" id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0">Etudiant sur Openclassroom, j'ai acquis les connaissances me permettant de développer des sites Web en utilisant les languages Html, Css, PHP et SQL.</h2>
                <hr class="divider light my-4">
                <p class="text-white-50 mb-4">Disponible immédiatement, mes connaissances me permettent d'éffectuer la création, la transformation et la maintenance de votre site Web</p>
                <a class="btn btn-light btn-xl js-scroll-trigger" href="public/doc/CV.pdf">Télécharger mon CV</a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="p-5" id="services">
    <div class="container center">
        <!-- Blog Post -->
        <a class="btn btn-primary btn-xl btn-block js-scroll-trigger text-center" href="#about">blog</a>
        <div class="flex">
        <?php

        while ($postblog = $blogmodel->fetch()) {
            $chapo = $postblog['post_title'];
            $datepost = $postblog['post_date'];
            $postmessage = $postblog['post_content'];
            $postuser = $postblog['mail'];
            $postnumber = $postblog['post_id'];
            ?>
            <div class="text-center" id=<?=$postnumber?>>
                <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
                <div class="card-body">
                    <h2 class="card-title"><?= $chapo ?></h2>
                    <p class="card-text"><?= substr($postmessage, 0, 200).'...' ?></p>
                    <a href="index.php?action=longPost" class="btn btn-primary">Lire plus ! &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posté le <?= $datepost ?> par <?= $postuser ?>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="public/img/portfolio/html5.png">
                    <img class="img-fluid " src="public/img/portfolio/html5.png" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            <h2>Le language HTML</h2>
                        </div>
                        <div class="project-name">
                            C'est là que tout a commencé, j'ai acquis les connaissances en Html me permettant de concevoir un site vitrine Statique, Ce language est la base de la conception Web.
                        </div>
                        <ul class="list-inline item-details">
                            <li>Projet:
                                <strong>Apprentissage de la conception d'un site Web Statique
                                </strong>
                            </li>
                            <li>Date:
                                <strong>samedi 2 mars 2019
                                </strong>
                            </li>
                            <li>Language:
                                <strong>HTML
                                </strong>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="public/img/portfolio/css3.png">
                    <img class="img-fluid" src="public/img/portfolio/css3.png" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            <h2>Language CSS</h2>
                        </div>
                        <div class="project-name">
                            Le CSS est un language qui permet de travailler sur la mise en page de votre site Web, ce language est incontournable dans la conception Web, il permet de faire des site Responsive !
                        </div>
                        <ul class="list-inline item-details">
                            <li>Projet:
                                <strong>Apprentissage de la mise en page de site Web
                                </strong>
                            </li>
                            <li>Date:
                                <strong>samedi 2 mars 2019
                                </strong>
                            </li>
                            <li>Language:
                                <strong>CSS
                                </strong>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="public/img/portfolio/php.png">
                    <img class="img-fluid" src="public/img/portfolio/php.png" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            <h2>Language PHP</h2>
                        </div>
                        <div class="project-name">
                            Le PHP est un language orienté serveur, c'est à dire que le site envoie des requêtes au serveur qui lui réponds en affichant les pages en fonction du compte client par exemple, ce language permet de créer des sites dynamiques avec des comptes clients, blogs, etc ...
                        </div>
                        <ul class="list-inline item-details">
                            <li>Projet:
                                <strong>Conception d'un Blog
                                </strong>
                            </li>
                            <li>Date:
                                <strong>Octobre 2019
                                </strong>
                            </li>
                            <li>Language:
                                <strong>PHP
                                </strong>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="public/img/portfolio/wordpress.png">
                    <img class="img-fluid" src="public/img/portfolio/wordpress.png" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            <h2>Création d'un site Web Wordpress</h2>
                        </div>
                        <div class="project-name">
                            Création d'un site Web avec le CMS Wordpress. Le client souhaitait avoir un site lui permettant de louer et vendre des chalets de luxe. Le site présenté les biens dans leurs intégralités (photos, descriptifs détaillés des biens). Le site contenait un formulaire de contact et était responsive
                        </div>
                        <ul class="list-inline item-details">
                            <li>Client:
                                <strong>Chalets et Caviar
                                </strong>
                            </li>
                            <li>Date:
                                <strong>samedi 2 mars 2019
                                </strong>
                            </li>
                            <li>CMS:
                                <strong>Wordpress
                                </strong>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="public/img/portfolio/boostraps.png">
                    <img class="img-fluid" src="public/img/portfolio/boostraps.png" alt="">
                    <div class="portfolio-box-caption p-3">
                        <div class="project-category text-white-50">
                            <h2>Boostraps</h2>
                        </div>
                        <div class="project-name">
                            Formé à l'utilisation de boostraps, je serai à même de mettre rapidement à bien votre projet de création de site Web totalement responsive, Effectivement, celui ci sera à la fois trés design et adapté aux smarphones, tablettes, phablettes et PC.
                        </div>
                        <ul class="list-inline item-details">
                            <li>Maitrise:
                                <strong>Bootstrap
                                </strong>
                            </li>
                            <li>Date:
                                <strong>lundi 8 avril 2019
                                </strong>
                            </li>
                            <li>interêt:
                                <strong>Site Web Design et responsive
                                </strong>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="public/img/portfolio/sql.png">
                    <img class="img-fluid" src="public/img/portfolio/sql.png" alt="">
                    <div class="portfolio-box-caption p-3">
                        <div class="project-category text-white-50">
                            <h2>Création de Base de données en SQL</h2>
                        </div>
                        <div class="project-name">
                            Création de base de données sur phpMySql pour diverses projets dont un concernant la restauration avec gestion des livraisons clients. La mission consistait en la gestion et la création de plat du jour, le stockage d'un fichier client avec mot de passe sécurisé, la gestion des livreurs qui sont géolocalisés.
                        </div>
                        <ul class="list-inline item-details">
                            <li>Client:
                                <strong>Express Food
                                </strong>
                            </li>
                            <li>Date:
                                <strong>Juillet 2019
                                </strong>
                            </li>
                            <li>Activité du client:
                                <strong>Restauration
                                </strong>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section -->
<!--Section: Contact v.2-->
<section class="mb-4 center bg-primary pt-4" id="contact">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center text-white">Contactez moi</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5 text-white">Envoyez moi un message, je me ferai un plaisir d'y répondre.</p>
    <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5 mx-auto">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="text-white">Votre nom</label>
                        </div>
                    </div>
                    <!--Grid column-->
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0 text-white">
                            <input type="text" id="email" name="email" class="form-control text-white">
                            <label for="email" class="">Votre mail</label>
                        </div>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0 text-white">
                            <input type="text" id="subject" name="subject" class="form-control text-white">
                            <label for="subject" class="">Objet</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form text-white center">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            <label for="message">Message</label>
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
<!--Section: Contact v.2-->
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>