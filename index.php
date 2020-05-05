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
                        check_connexion();
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
                        longPost();
                        break;
                case 'admin':
                        getAdmin();
                        break;
                case 'commentaire':
                        getComment();
                        break;
                case 'newPost':
                        newPost();
                        break;
                case 'listingPost':
                        frontendListingPost();
                        break;
                case 'deletePost':
                        deletePost();
                        break;
                case 'changePost':
                        changePost();
                        break;
                case 'updatePost':
                        updatePost();
                        break;
                case 'usersList':
                        usersList();
                        break;
                case 'changeLawUser':
                        ChangeLawUser();
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
                        changeStatusComment();
                        break;
        }
} else {
        home();
}
