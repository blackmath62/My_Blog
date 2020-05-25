<?php
namespace App;
use App\Entity\Autoloader;
use App\config\Request;

require('Entity/Autoloader.php');

Autoloader::register();
/*require __DIR__ . '/vendor/autoload.php';*/
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1); // Afficher plus d'erreur a retirer pour la mise en prod

// le fichier index, il s'agit du routeur qui va chercher les informations en fonction des données
// ce fichier renomme correctement la barre d'adresse
// a le même effet qu'include, c'est à dire pour ramener une page mais à l'avantage de ne rien renvoyer en cas d'erreur

require('controler/frontendControler.php');

$request = new Request();

$action = $request->get('action');

if (isset($action)) {
        switch ($action) {
                case 'connexion':
                        connexion();
                        break;
                case 'check_connexion':
                        $mail = $request->post('identifiant');
                        $mdp = $request->post('mdpconnect');
                        check_connexion($mail,$mdp);
                        break;
                case 'inscription':
                        register();
                        break;
                case 'check_register':

                        $identity = $request->post('identifiant');
                        $mdp = $request->post('mdpconnect');
                        $mdpcontrol = $request->post('mdp_register_verif');
                        $pseudo = $request->post('pseudo');
                        check_register($identity,$mdp,$mdpcontrol,$pseudo);
                        break;
                case 'passforget':
                        passforget();
                        break;
                case 'get_passforget':
                        get_passforget();
                        break;
                case 'passchange':
                        passchange($request->get('id'), $request->get('token'));
                        break;
                case 'send_Mail_Password':
                        send_Mail_Password();
                        break;
                case 'get_passchange':
                        get_passchange();
                        break;
                case 'listingComment':
                        frontendListingComment();
                        break;
                case 'blog':
                        allPost();
                        break;
                case 'longPost':
                        $postnumber = $request->get('id');
                        longPost($postnumber);
                        break;
                case 'admin':
                        getAdmin();
                        break;
                case 'commentaire':
                        $title = $request->post('subject');
                        $content = $request->post('message');
                        $postId = $request->get("id");
                        $usersId = $request->getSession()['users_id'];
                        getComment($title,$content, $postId, $usersId);
                        break;
                case 'newPost':
                        if(!empty($request->post('subject'))){
                        $title = $request->post('subject');
                        $content = $request->post('message');
                        $usersId = $request->getSession()['users_id'];
                        newPost($title, $content, $usersId);
                        } else {
                        viewNewPost();
                        }
                        break;
                case 'listingPost':
                        frontendListingPost();
                        break;
                case 'deletePost':
                        $postnumber = $request->get('id');
                        deletePost($postnumber);
                        break;
                case 'changePost':
                        $postnumber = $request->get('id');
                        changePost($postnumber);
                        break;
                case 'updatePost':
                        $postnumber = $request->get(['id']);
                        $subject = $request->post('subject');
                        $message = $request->post('message');
                        updatePost($postnumber, $subject, $message);
                        break;
                case 'usersList':
                        usersList();
                        break;
                case 'changeLawUser':
                        $idLaw = $request->get('id');
                        $idUser = $request->get('userid');
                        ChangeLawUser($idLaw, $idUser);
                        break;
                case 'deleteUser':
                        deleteUser($request->get('userid'));
                        break;
                case 'mail':
                        $name = $request->post('name');
                        $mail = $request->post('email');
                        $subject = $request->post('subject');
                        $message = $request->post('message');
                        contact_me($name,$mail,$subject,$message);
                        break;
                case 'changeStatusComment':
                        $commentId = $request->get('id');
                        $validateId = $request->get('modification');
                        changeStatusComment($commentId,$validateId);
                        break;
        }
} else {
        home();
}
