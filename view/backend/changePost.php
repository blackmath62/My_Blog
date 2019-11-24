<?php ob_start(); ?>

<div class="container">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center mt-5 pt-5">Administration</h2>
    <section class="page-section">
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Modifier le post </p>
        <div class="row">
            <!--Grid column-->
            <div class="col-md-9 mb-md-0 mb-5 mx-auto">
                <form id="contact-form" name="contact-form" action="index.php?action=updatePost&id=<?=$postnumber?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <label for="subject" class="">Titre</label>
                                <input type="text" id="subject" name="subject" class="form-control" value="<?=$title ?>">
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
                                <textarea type="text" id="message" name="message" rows="6" class="form-control md-textarea"><?=$message ?></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="text-center m-5">
                    <a class="btn btn-primary btn-xl js-scroll-trigger text-white" onclick="document.getElementById('contact-form').submit();">Modifier le post</a>
                </div>
                <div class="status"></div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>