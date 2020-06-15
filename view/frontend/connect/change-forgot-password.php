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
                    <h1 class="h4 text-gray-900 mb-2">Mot de passe oublié?</h1>
                  </div>
                  <form class="user" action='index.php?action=get_passchange' method='POST' name='changemdp'>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="newmdp" placeholder="Nouveau mot de passe">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="controlnewmdp" placeholder="Ressaisir le nouveau mot de passe">
                    </div>
                    <div class="form-group">
                      <input type="submit" value='Changer le mot de passe' class="btn btn-primary btn-user btn-block">
                    </div>
                    <div class="center">
                    <?php
                    if (isset($error)) {
                      ?>
                    <div class='center'>
                      <?= $error; ?>
                    </div>
                      <?php
                    }
                    ?>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="index.php?action=inscription">Inscription !</a>
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

    </div>
    </section>
  </div>
