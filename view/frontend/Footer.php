        <!-- Footer -->
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4">
                            <h3 class="m-4">Mon adresse</h3>
                            <p>18 rue de la statue de la liberté
                                <br>72500, Los Angeles</p>
                        </div>
                        <div class="footer-col col-md-4">
                            <h3 class="m-4">Réseaux Sociaux</h3>
                            <ul class="list-inline flex m-4">
                                <li>
                                    <a href="https://www.facebook.com/quepuisjefairepour.nous" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook fa-2x"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/Jardinew62" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter fa-2x"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/in/jerome-pochet-018b92177/" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin fa-2x"></i></a>
                                </li>

                            </ul>
                        </div>
                        <div class="footer-col col-md-4">
                            <h3 class="m-4">à propos</h3>
                            <p>C'est avec plaisir que nous discuterons de votre projet : <a href=mailto:jpochet@lhermitte.fr>jpochet@jpochet.fr</a>.</p>
                            <?php 
                            if(!empty($_SESSION) AND (!empty($_SESSION['law_id']))) {
                            if($_SESSION['law_id'] == 1){ ?>
                            <a href="index.php?action=admin">Administration</a>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 m-5">
                            Copyright &copy; pochetjerome
                        </div>
                    </div>
                </div>
            </div>
        </footer>