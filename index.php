<?php
namespace App;
use App\Entity\Autoloader;
use App\config\Request;
use App\Controller\ControllerBackend;
use App\Controller\ControllerFrontend;
use Exception;

require 'Entity/Autoloader.php';

try{
Autoloader::registerAutoload();
session_start();

$request = new Request();
$controllerFront = new ControllerFrontend();
$controllerBackend = new ControllerBackend();
        
error_reporting(E_ALL);
ini_set("display_errors", 1); // Afficher plus d'erreur a retirer pour la mise en prod

// le fichier index, il s'agit du routeur qui va chercher les informations en fonction des données
// ce fichier renomme correctement la barre d'adresse
// a le même effet qu'include, c'est à dire pour ramener une page mais à l'avantage de ne rien renvoyer en cas d'erreur

$action = $request->get('action');
if (isset($action)) {
        switch ($action) {
                case 'connexion':
                        $controllerFront->connexion($request->stopSession());
                        break;
                case 'check_connexion':
                        $mail = $request->post('identifiant');
                        $mdp = $request->post('mdpconnect');
                        $controllerFront->check_connexion($mail,$mdp);
                        break;
                case 'inscription':
                        $controllerFront->registerPage();
                        break;
                case 'check_register':
                        $identity = $request->post('identifiant');
                        $mdp = $request->post('mdpconnect');
                        $mdpcontrol = $request->post('mdp_register_verif');
                        $pseudo = $request->post('pseudo');
                        $controllerFront->check_register($identity,$mdp,$mdpcontrol,$pseudo);
                        break;
                case 'passforget':
                        $controllerFront->passforget();
                        break;
                case 'get_passforget':
                        $mail = $request->post('identifiant');
                        $controllerFront->get_passforget($mail);
                        break;
                case 'passchange':
                        $idconnect = $request->get('id');
                        $controltoken = $request->get('token');
                        $request->getSession()->setter('users_id', $idconnect);
                        $request->getSession()->setter('token', $controltoken);
                        $controllerFront->passchange();
                        break;
                case 'send_Mail_Password':
                        $controllerFront->send_Mail_Password();
                        break;
                case 'get_passchange':
                        $controllerFront->get_passchange($request->getSession()->getter('users_id'), $request->getSession()->getter('token'));
                        break;
                case 'listingComment':
                        $controllerBackend->listingComment();
                        break;
                case 'blog':
                        $controllerFront->allPost();
                        break;
                case 'longPost':
                        $postnumber = $request->get('id');
                        $controllerFront->longPost($postnumber);
                        break;
                case 'admin':
                        $controllerBackend->getAdmin();
                        break;
                case 'commentaire':
                        $title = $request->post('subject');
                        $content = $request->post('message');
                        $postId = $request->get("id");
                        $usersId = $request->session('users_id');
                        $controllerFront->getComment($title,$content, $postId, $usersId);
                        break;
                case 'newPost':
                        if(!empty($request->post('subject'))){
                        $title = $request->post('subject');
                        $content = $request->post('message');
                        $usersId = $request->session('users_id');
                        $controllerBackend->newPost($title, $content, $usersId);
                        } else {
                        $controllerBackend->viewNewPost();
                        }
                        break;
                case 'listingPost':
                        $controllerBackend->listingPost();
                        break;
                case 'deletePost':
                        $postnumber = $request->get('id');
                        $controllerBackend->deletePost($postnumber);
                        break;
                case 'changePost':
                        $postnumber = $request->get('id');
                        $controllerBackend->changePost($postnumber);
                        break;
                case 'updatePost':
                        $postnumber = $request->get('id');
                        $subject = $request->post('subject');
                        $message = $request->post('message');
                        $controllerBackend->updatePost($postnumber, $subject, $message);
                        break;
                case 'usersList':
                        $controllerBackend->usersList();
                        break;
                case 'changeLawUser':
                        $idLaw = $request->get('id');
                        $idUser = $request->get('userid');
                        $controllerBackend->ChangeLawUser($idLaw, $idUser);
                        break;
                case 'deleteUser':
                        $controllerBackend->deleteUser($request->get('userid'));
                        break;
                case 'mail':
                        $name = $request->post('name');
                        $mail = $request->post('email');
                        $subject = $request->post('subject');
                        $message = $request->post('message');
                        $controllerFront->contact_me($name,$mail,$subject,$message);
                        break;
                case 'changeStatusComment':
                        $commentId = $request->get('id');
                        $validateId = $request->get('modification');
                        $controllerBackend->changeStatusComment($commentId,$validateId);
                        break;
        }
} else {
        $controllerFront->home();
}

}
catch(Exception $e){
        echo 'Erreur : ' . $e->getMessage();
        require_once 'view\frontend\error.php'; 
        throw new Exception('Aucun identifiant envoyé');
}
?>
<script language="javascript" type='text/javascript'>
    function session(){
        window.location="index.php?action=connexion"; //page de déconnexion
    }
    setTimeout("session()",300000); //ça fait bien 5min??? c'est pour le test
</script>