<?php ob_start(); ?>

  <div class="container">
  <section class="page-section">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 center-block mx-auto">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenue</h1>
                  </div>
                  <form class="user" action='index.php?action=check_connexion' method='POST'>
                    <div class="form-group">
                      <input type="email" name='identifiant' class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Veuillez entrer votre adresse mail...">
                    </div>
                    <div class="form-group">
                      <input type="password" name='mdpconnect' class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe">
                    </div>
                    <input type="submit" name='Valider' value='Se connecter' class="btn btn-primary btn-user btn-block">
                    <?php
                    if (isset($error)) {
                      echo $error;
                    }
                    ?>
                    <hr>

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="index.php?action=passforget">Mot de passe oublié?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="index.php?action=inscription">Inscription !</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    </section>
  </div>

<?php
$content = ob_get_clean();
require('view/frontend/htmlTemplate.php');
?>