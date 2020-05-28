<div class="container">
<section class="page-section">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7 center-block mx-auto">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Inscription !</h1>
              </div>
              <form class="user" action='index.php?action=check_register' method='POST'>
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">  
                <input type="email" name="identifiant" class="form-control form-control-user" id="exampleInputEmail" placeholder="Mail" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="pseudo" class="form-control form-control-user" id="pseudo" placeholder="Pseudo" required>
                </div>  
              </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="mdpconnect" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="mdp_register_verif" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Resaisir le mot de passe" required>
                  </div>
                </div>
                <p><input type="submit" name="Valider" value='Créer le compte' class="btn btn-primary btn-user btn-block"></p>
                <div class="center">
                <?php
                if (isset($error)) {
                  echo $error;
                }
                ?>
                </div>
                <hr>
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
    </section>
  </div>