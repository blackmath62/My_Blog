<?php ob_start(); ?>

<div class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center mt-5 pt-5">Administration</h2>
    <div class='flex'>
        <section class="page-section">
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Créer un nouveau post </p>
            <div class="row">
                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5 mx-auto">
                    <form id="contact-form" name="contact-form" action="index.php" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Titre</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->
                        <!--Grid row-->
                        <div class="row">
                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form center">
                                    <label for="message">Post</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->
                    </form>
                    <div class="text-center m-5">
                        <a class="btn btn-primary btn-xl js-scroll-trigger text-white" onclick="document.getElementById('contact-form').submit();">Déposer le post</a>
                    </div>
                    <div class="status"></div>
                </div>
            </div>
        </section>

        <section class="page-section">
            <div class="container">
                <p class="text-center w-responsive mx-auto mb-5">Liste des utilisateurs </p>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <div class="table-responsive">
                                <table class="table user-list">
                                    <thead>
                                        <tr>
                                            <th><span>Utilisateur</span></th>
                                            <th><span>date création</span></th>
                                            <th class="text-center"><span>droit</span></th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a class="">Mila Kunis</a>
                                            </td>
                                            <td>
                                                2013/08/08
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-default">Administrateur</span>
                                            </td>
                                            <td style="width: 25%;">
                                                <a href="#" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link danger">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pull-right">
                                <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!--Section: Contact v.2-->
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>