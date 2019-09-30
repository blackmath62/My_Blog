<?php ob_start(); ?>
<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block "><a> <img class='col-lg-12 d-none d-lg-block align' src="public/images/logrobylhermitte.png"></a></div>
        <div class="col-lg-7">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Inscription !</h1>
            </div>
            <form class="user" action='index.php?action=check_register' method='POST'>
              <!--
                <div class="form-group row">
                   <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Nom">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="prénom">
                  </div>
                </div>
                -->
              <div class="form-group">
                <input type="email" name="identifiant" class="form-control form-control-user" id="exampleInputEmail" placeholder="Mail">
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" name="mdpconnect" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe">
                </div>
                <div class="col-sm-6">
                  <input type="password" name="mdp_register_verif" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Resaisir le mot de passe">
                </div>
              </div>
              <p><input type="submit" name="Valider" value='Créer le compte' class="btn btn-primary btn-user btn-block"></p>
              <?php
              if (isset($error)) {
                echo $error;
                header('refresh:3; url= index.php?action=connexion');
              }
              ?>
              <hr>
              <!--
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
                -->
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="index.php?action=passforget">Mot de passe oublié?</a>
            </div>
            <div class="text-center">
              <a class="small" href="index.php?action=connexion">Vous avez déjà un compte? S'identifier!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
$colorcontent = 'bg-gradient-success';
$content = ob_get_clean();

require('view/frontend/templateConnect.php');
?>