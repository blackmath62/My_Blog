     <!-- Navigation -->
     <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
         <div class="container">
             <a class="navbar-brand js-scroll-trigger" href="index.php#page-top">Accueil</a>
             <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarResponsive">
                 <ul class="navbar-nav ml-auto my-2 my-lg-0">
                     <li class="nav-item">
                         <a class="nav-link js-scroll-trigger" href="index.php#about">à propos</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link js-scroll-trigger" href="index.php#services">Blog</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link js-scroll-trigger" href="index.php#portfolio">Portfolio</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact</a>
                     </li>
                     <li class="nav-item dropdown">
                         <?php if (isset($_SESSION['mail'])) { ?>
                             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <?php echo $_SESSION['mail']; ?> </a>
                                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href="index.php?action=monCompte">Mon compte</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href="index.php?action=kill_connexion">Se déconnecter</a>
                                 </div>
                             </a>
                         <?php } else { ?>
                             <a class="nav-link js-scroll-trigger" href="index.php?action=connexion"><?php echo 'Se connecter'; ?> </a>
                         <?php } ?>


                     </li>
                 </ul>
             </div>
         </div>
     </nav>