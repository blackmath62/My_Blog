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
                        $mail = filter_var($request->post('identifiant'),FILTER_VALIDATE_EMAIL);
                        $mdp = filter_var($request->post('mdpconnect'), FILTER_SANITIZE_STRING);
                        $controllerFront->check_connexion($mail,$mdp);
                        break;
                case 'inscription':
                        $controllerFront->registerPage();
                        break;
                case 'check_register':
                        $identity = filter_var($request->post('identifiant'),FILTER_VALIDATE_EMAIL);
                        $mdp = filter_var($request->post('mdpconnect'), FILTER_SANITIZE_STRING);
                        $mdpcontrol = filter_var($request->post('mdp_register_verif'), FILTER_SANITIZE_STRING);
                        $pseudo = filter_var($request->post('pseudo'), FILTER_SANITIZE_STRING);
                        $controllerFront->check_register($identity,$mdp,$mdpcontrol,$pseudo);
                        break;
                case 'passforget':
                        $controllerFront->passforget();
                        break;
                case 'get_passforget':
                        $mail = filter_var($request->post('identifiant'), FILTER_VALIDATE_EMAIL);
                        $controllerFront->get_passforget($mail);
                        break;
                case 'passchange':
                        $idconnect = filter_var($request->get('id'), FILTER_VALIDATE_INT);
                        $controltoken = filter_var($request->get('token'), FILTER_SANITIZE_STRING);
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
                        $postnumber = filter_var($request->get('id'), FILTER_VALIDATE_INT);
                        $controllerFront->longPost($postnumber);
                        break;
                case 'admin':
                        $controllerBackend->getAdmin();
                        break;
                case 'commentaire':
                        $title = filter_var($request->post('subject'), FILTER_SANITIZE_STRING);
                        $content = filter_var($request->post('message'), FILTER_SANITIZE_STRING);
                        $postId = filter_var($request->get("id"),FILTER_VALIDATE_INT);
                        $usersId = filter_var($request->session('users_id'),FILTER_VALIDATE_INT);
                        $controllerFront->getComment($title,$content, $postId, $usersId);
                        break;
                case 'newPost':
                        if(!empty($request->post('subject'))){
                        $title = filter_var($request->post('subject'), FILTER_SANITIZE_STRING);
                        $content = filter_var($request->post('message'), FILTER_SANITIZE_STRING);
                        $usersId = filter_var($request->session('users_id'),FILTER_VALIDATE_INT);
                        $controllerBackend->newPost($title, $content, $usersId);
                        } else {
                        $controllerBackend->viewNewPost();
                        }
                        break;
                case 'listingPost':

                        $controllerBackend->listingPost();
                        break;
                case 'deletePost':
                        $postnumber = filter_var($request->get('id'),FILTER_VALIDATE_INT);
                        $controllerBackend->deletePost($postnumber);
                        break;
                case 'changePost':
                        $postnumber = filter_var($request->get('id'),FILTER_VALIDATE_INT);
                        $controllerBackend->changePost($postnumber);
                        break;
                case 'updatePost':
                        $postnumber = filter_var($request->get('id'),FILTER_VALIDATE_INT);
                        $subject = filter_var($request->post('subject'),FILTER_SANITIZE_STRING);
                        $message = filter_var($request->post('message'),FILTER_SANITIZE_STRING);
                        $controllerBackend->updatePost($postnumber, $subject, $message);
                        break;
                case 'usersList':
                        $controllerBackend->usersList();
                        break;
                case 'changeLawUser':
                        $idLaw = filter_var($request->get('id'),FILTER_VALIDATE_INT);
                        $idUser = filter_var($request->get('userid'),FILTER_VALIDATE_INT);
                        $controllerBackend->ChangeLawUser($idLaw, $idUser);
                        break;
                case 'deleteUser':
                        $controllerBackend->deleteUser($request->get('userid'));
                        break;
                case 'mail':
                        $name = filter_var($request->post('name'),FILTER_SANITIZE_STRING);
                        $mail = filter_var($request->post('email'),FILTER_VALIDATE_EMAIL);
                        $subject = filter_var($request->post('subject'),FILTER_SANITIZE_STRING);
                        $message = filter_var($request->post('message'),FILTER_SANITIZE_STRING);
                        $controllerFront->contact_me($name,$mail,$subject,$message);
                        break;
                case 'changeStatusComment':
                        $commentId = filter_var($request->get('id'),FILTER_VALIDATE_INT);
                        $validateId = filter_var($request->get('modification'),FILTER_SANITIZE_STRING);
                        $controllerBackend->changeStatusComment($commentId,$validateId);
                        break;
                default:$controllerFront->home();
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