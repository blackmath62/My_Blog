<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1); // Afficher plus d'erreur a retirer pour la mise en prod

// le fichier index, il s'agit du routeur qui va chercher les informations en fonction des données
// ce fichier renomme correctement la barre d'adresse
// a le même effet qu'include, c'est à dire pour ramener une page mais à l'avantage de ne rien renvoyer en cas d'erreur

require('controler/frontendControler.php');
require('config/Request.php');

$request = new Request();

$action = $request->getGet()["action"];

if (isset($action)) {
        switch ($action) {
                case 'connexion':
                        connexion();
                        break;
                case 'check_connexion':
                        $mail = $request->getPost()['identifiant'];
                        $mdp = $request->getPost()['mdpconnect'];
                        check_connexion($mail,$mdp);
                        break;
                case 'inscription':
                        register();
                        break;
                case 'check_register':
                        check_register();
                        break;
                case 'passforget':
                        passforget();
                        break;
                case 'get_passforget':
                        get_passforget();
                        break;
                case 'passchange':
                        passchange($request->getGet()['id'], $request->getGet()['token']);
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
                        $postnumber = $request->getGet()['id'];
                        longPost($postnumber);
                        break;
                case 'admin':
                        getAdmin();
                        break;
                case 'commentaire':
                        $title = $request->getPost()['subject'];
                        $content = $request->getPost()['message'];
                        $postId = $request->getGet()["id"];
                        $usersId = $request->getSession()['users_id'];
                        getComment($title,$content, $postId, $usersId);
                        break;
                case 'newPost':
                        if(!empty($request->getPost()['subject'])){
                        $title = $request->getPost()['subject'];
                        $content = $request->getPost()['message'];
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
                        $postnumber = $request->getGet()['id'];
                        deletePost($postnumber);
                        break;
                case 'changePost':
                        $postnumber = $request->getGet()['id'];
                        changePost($postnumber);
                        break;
                case 'updatePost':
                        $postnumber = $request->getGet()['id'];
                        $subject = $request->getPost()['subject'];
                        $message = $request->getPost()['message'];
                        updatePost($postnumber, $subject, $message);
                        break;
                case 'usersList':
                        usersList();
                        break;
                case 'changeLawUser':
                        $idLaw = $request->getGet()['id'];
                        $idUser = $request->getGet()['userid'];
                        ChangeLawUser($idLaw, $idUser);
                        break;
                case 'deleteUser':
                        deleteUser($request->getGet()['userid']);
                        break;
                case 'mail':
                        $name = $request->getPost()['name'];
                        $mail = $request->getPost()['email'];
                        $subject = $request->getPost()['subject'];
                        $message = $request->getPost()['message'];
                        contact_me($name,$mail,$subject,$message);
                        break;
                case 'changeStatusComment':
                        $commentId = $request->getGet()['id'];
                        $validateId = $request->getGet()['modification'];
                        changeStatusComment($commentId,$validateId);
                        break;
        }
} else {
        home();
}
