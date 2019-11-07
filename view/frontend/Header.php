    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php#page-top">Accueil</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#portfolio">Connaissances</a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#blog">Blog</a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#about">à propos</a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#contact">Contact</a>
                    </li>
                    <li class="page-scroll">
                        <?php if(isset($_SESSION['mail'])){?>
                            <a href="index.php?action=kill_connexion"><?php echo 'Se déconnecter';?> </a> 
                            
                        <?php } else { ?>
                            <a href="index.php?action=connexion"><?php echo 'Se connecter';?> </a> 
                            <?php } ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
