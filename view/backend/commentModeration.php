<?php ob_start(); ?>
<div class="container ">
<section class="page-section">
    <!-- Blog Post -->
    <div class="text-center" id="">
            <!-- <img class="card-img-top" src="public/img/oc.png" alt="Card image cap"> -->

            <div class="card-body">
                <h2 class="card-title btn-xl btn-primary">Titre</h2>
                <p class="card-text"></p>
                <a href="index.php?action=longPost&id=...." class="btn btn-primary">Lire plus ! &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                Posté le ..... par .....
            </div>
        </div>

</section>
</div>
<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>