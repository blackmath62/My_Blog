<?php session_start() ?>
     <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="public/img/youtube-1684601_640.png" alt="">
                    <div class="intro-text">
                        <span class="name">Pochet Jérôme</span>
                        <hr class="star-light">
                        <span class="skills">Développeur Web HTML, CSS, PHP, SQL</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Connaissances</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="public/img/portfolio/html5.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="public/img/portfolio/css3.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="public/img/portfolio/php.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="public/img/portfolio/wordpress.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="public/img/portfolio/boostraps.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="public/img/portfolio/sql.png" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- blog Section -->
    <section class="" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Blog</h2>
                    <hr class="star-light">
                </div>
            </div>
            <!-- Blog Post -->
            <div class="card mb-4 text-center">
                <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->
                <div class="card-body">
                    <h2 class="card-title">Chapo</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a href="#" class="btn btn-primary">Lire plus ! &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on January 1, 2017
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>à propos</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12">
                    <p>Etudiant sur Openclassroom, j'ai acquis les connaissances me permettant de développer des sites Web en utilisant les languages Html, Css, PHP et SQL.</p>
                </div>
                <div class="col-lg-12">
                    <p>Disponible immédiatement, mes connaissances me permettent d'éffectuer la création, la transformation et la maintenance de votre site Web</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="public/doc/CV.pdf" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Télécharger mon CV
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contactez moi !</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" action='index.php?action=send' novalidate>
                        <!--le probléme vient de là id -->
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nom</label>
                                <input type="text" class="form-control" placeholder="Nom / Prénom" id="name" name="name" required data-validation-required-message="Veuillez saisir votre nom.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Mail</label>
                                <input type="email" class="form-control" placeholder="Votre adresse mail" id="email" name="email" required data-validation-required-message="Veuillez renseigner votre adresse mail.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Votre message" id="message" name="message" required data-validation-required-message="Veuillez saisir un message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12 align-items-center">
                                <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Le language HTML</h2>
                            <hr class="star-primary">
                            <img src="public/img/html.png" class="img-responsive img-centered" alt="">
                            <p>C'est là que tout a commencé, j'ai acquis les connaissances en Html me permettant de concevoir un site vitrine Statique, Ce language est la base de la conception Web.</p>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Language CSS</h2>
                            <hr class="star-primary">
                            <img src="public/img/css.png" class="img-responsive img-centered" alt="">
                            <p>Le CSS est un language qui permet de travailler sur la mise en page de votre site Web, ce language est incontournable dans la conception Web, il permet de faire des site Responsive !</p>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Language PHP</h2>
                            <hr class="star-primary">
                            <img src="public/img/php.png" class="img-responsive img-centered" alt="">
                            <p>Le PHP est un language orienté serveur, c'est à dire que le site envoie des requêtes au serveur qui lui réponds en affichant les pages en fonction du compte client par exemple, ce language permet de créer des sites dynamiques avec des comptes clients, blogs, etc ...</p>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Création d'un site Web Wordpress</h2>
                            <hr class="star-primary">
                            <img src="public/img/wordpress.png" class="img-responsive img-centered" alt="">
                            <p>Création d'un site Web avec le CMS Wordpress. Le client souhaitait avoir un site lui permettant de louer et vendre des chalets de luxe. Le site présenté les biens dans leurs intégralités (photos, descriptifs détaillés des biens). Le site contenait un formulaire de contact et était responsive</p>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Boostraps</h2>
                            <hr class="star-primary">
                            <img src="public/img/bootstrap.png" class="img-responsive img-centered" alt="">
                            <p>Formé à l'utilisation de boostraps, je serai à même de mettre rapidement à bien votre projet de création de site Web totalement responsive, Effectivement, celui ci sera à la fois trés design et adapté aux smarphones, tablettes, phablettes et PC. </p>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Création de Base de données en SQL</h2>
                            <hr class="star-primary">
                            <img src="public/img/phpmyadmin.png" class="img-responsive img-centered" alt="">
                            <p>Création de base de données sur phpMySql pour diverses projets dont un concernant la restauration avec gestion des livraisons clients. La mission consistait en la gestion et la création de plat du jour, le stockage d'un fichier client avec mot de passe sécurisé, la gestion des livreurs qui sont géolocalisés. </p>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="">
                            <h2>Se connecter</h2>
                            <hr class="star-primary">
                            <img src="public/img/pageconnect.png" class="img-responsive img-centered" alt="">
                            <form action="index.php">
                                <div class="row"><label>Mail : <input id="exampleInputEmail" aria-describedby="emailHelp" type='email' method='POST' class="form-control"></label></div>
                                <div class="column"><label>Mot de passe : <input type='password' method='POST' class="form-control"></label></div>
                                <input type='submit' value='Se connecter' class="btn btn-success">
                                <p><a href="index.php/action=register">Créer un compte</a> </p>
                                <p><a href="index.php/action=forgotpassword" a>Mot de passe oublié ?</a></p>
                            </form>
                            </br>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>