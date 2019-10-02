<?php ob_start(); ?>
<div class="container ">

  <!-- Outer Row -->
    <div class="card-body align">
    <!-- Nested Row within Card Body -->
    <div class="col-lg-6 d-none d-lg-block "><a> <img class='col-lg-12 d-none d-lg-block' src="public/img/changepassword.jpg"></a></div>
    
    <div class="col-lg-6 d-none d-lg-block">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-2">Mot de passe oublié?</h1>
        <p class="mb-4">Entrez simplement votre adresse e-mail ci-dessous et nous vous enverrons un lien pour réinitialiser votre mot de passe!</p>
      </div>
      <form class="user " action='index.php?action=get_passforget' method='POST' name='controlmail'>
        <div class="form-group">
          <input type="email" class="form-control form-control-user" name="identifiant" aria-describedby="emailHelp" placeholder="Veuillez saisir votre adresse mail...">
        </div>
        <input type="submit" value='Réinitialisé le mot de passe par mail' class="btn btn-primary btn-user btn-block">
        <?php
        if (isset($error)) {
          echo $error;
        }
        ?>
      </form>
      <hr>
      <div class="text-center"><a class="small" href="index.php?action=inscription">Inscription !</a></div>
      <div class="text-center"><a class="small" href="index.php?action=connexion">Vous avez déjà un compte? S'identifier!</a></div>
    </div>

  </div>
</div>
<?php
$colorcontent = 'bg-gradient-warning';
$content = ob_get_clean();

require('view/frontend/templateConnect.php');
?>