<?php ob_start(); ?>
<div class="container center">
  <div class=""><a> <img class='col-sm-6 mb-3 mb-sm-0' src="public/img/register.jpg"></a></div>
  <div class="align">
    <h1 class="h4 text-gray-900 mb-4">Inscription !</h1>
  </div>
  <form class="user center" action='index.php?action=check_register' method='POST'>
    <div class="form-group col-sm-6 mb-3 mb-sm-0"><input type="email" name="identifiant" class="form-control form-control-user" id="exampleInputEmail" placeholder="Mail"></div>
    <div class="form-group col-sm-6 mb-3 mb-sm-0"><input type="password" name="mdpconnect" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mot de passe"></div>
    <div class="form-group col-sm-6 mb-3 mb-sm-0"><input type="password" name="mdp_register_verif" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Resaisir le mot de passe"></div>
    <p><input type="submit" name="Valider" value='Créer le compte' class="btn btn-primary btn-user btn-block"></p>
    <div class="text-center"><a class="small" href="index.php?action=passforget">Mot de passe oublié?</a></div>
    <div class="text-center"><a class="small" href="index.php?action=connexion">Vous avez déjà un compte? S'identifier!</a></div>
    <?php
    if (isset($error)) {
      echo $error;
      header('refresh:3; url= index.php?action=connexion');
    }
    ?>
  </form>
</div>
<?php
$colorcontent = 'bg-gradient-success';
$content = ob_get_clean();
require('view/frontend/templateConnect.php');
?>