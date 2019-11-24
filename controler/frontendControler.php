<?php

require_once('Model/MemberManager.php');
require_once('Model/BlogManager.php');

// connexion function

function pageNoFound()
{
    require('view/frontend/pageNoFound.php');
}

function connexion()
{
    if (isset($_SESSION['mail'])) {
        $mailconnect = $_SESSION['mail'];
        $usersId = $_SESSION['users_id'];
        // Suppression des variables de session et de la session
        $connexionmodel = new \memberSpace\Model\MemberManager();
        //$majIp = $connexionmodel->listConnect($ip, $mailconnect);
    }
    $_SESSION = array();
    session_destroy();
    require('view/frontend/connect/loginview.php');
}
function kill_connexion()
{
    session_destroy();
    header('Location: index.php');
}

function getAdmin(){

    require('view/backend/backendHome.php');
}

function check_connexion() // la fonction   la partie connexion est bonne ne plus toucher
{
    // Instanciation d'un objet dans un namespace
    // L'objet se trouve dans le model membermanager

    $connexionmodel = new \memberSpace\Model\MemberManager();

    if (isset($_POST['identifiant']) and isset($_POST['mdpconnect'])) {
        $mailconnect = htmlspecialchars($_POST['identifiant']);
        $mdpconnect = password_hash($_POST['mdpconnect'], PASSWORD_DEFAULT); // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
        $check_connect = $connexionmodel->check_exist($mailconnect);
        $userexist = $check_connect->rowCount(); // compter le nombre de ligne  

        if ($userexist == 1) {

            $connect = $connexionmodel->getconnect($mailconnect);
            while ($profil = $connect->fetch()) { // on boucle sur le MemberManager/connect
                $isPasswordCorrect = password_verify($_POST['mdpconnect'], $profil['mdp']); // Comparaison du pass envoyé via le formulaire avec la base    
                if ($isPasswordCorrect)  // si c'est égale à 1  et le mot de passe est correct
                { // Comparaison du pass envoyé via le formulaire avec la base
                    $_SESSION['mail'] = $profil['mail'];
                    $_SESSION['users_id'] = $profil['users_id'];
                    $_SESSION['law_label'] = $profil['law_label'];
                    $mailconnect = $_SESSION['mail'];
                    $_SESSION['law_id'] = $profil['law_id'];
                    header('Location: index.php');
                } elseif (isset($mailconnect)) {
                    $error = "Mail ou mot de passe incorrect !";
                }
            }
        }
        if ($userexist == 0 and !empty($mailconnect)) {
            $error = "Mail inconnu, veuillez créer un compte dans inscription.";
        }
    } else {
        $error = "Veuillez renseigner votre mail et mdp ";
    }
    
    require('view/frontend/connect/loginview.php');
}

function register()
{
    require('view/frontend//connect/registerview.php');
}


function check_register() // la fonction
{
    $connexionmodel = new \memberSpace\Model\MemberManager(); // on créé un nouvelle objet
    if (isset($_POST['identifiant']) and isset($_POST['mdpconnect']) and isset($_POST['mdp_register_verif'])) // on contrôle si l'id et les 2 mots de passe sont renseignés
    {
        $mailconnect = htmlspecialchars($_POST['identifiant']);  //on déclare les variables
        $mdpconnect = password_hash($_POST['mdpconnect'], PASSWORD_DEFAULT); // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
        $check_connect = $connexionmodel->check_exist($mailconnect); // on vérifie si le compte n'existe pas déjà
        $userexist = $check_connect->rowCount(); // compter le nombre de ligne 
        if ($userexist == 1) {

            $error = "Le mail est déjà utilisé, veuillez choisir un autre mail ou vous connecter.";
        } elseif ($userexist == 0) {
            if ($_POST['mdpconnect'] == $_POST['mdp_register_verif']) //si les 2 mots de passes sont identiques
            {

                $register = $connexionmodel->addRegister($mailconnect, $mdpconnect);

                $error = " Nous avons créé votre compte " . $mailconnect . " ! L'administrateur va débloquer votre compte pour que vous puissiez consulter le site intranet" . '</br';
            }
        }
    }
    require('view/frontend/connect/registerview.php');
}
// page mot de passe oublié
function passforget()
{
    $colorcontent = 'bg-gradient-warning';
    require('view/frontend/connect/forgot-password.php');
}

function home()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $blogmodel = $connexionmodel -> lastPost();
    
    require('view/frontend/templateFrontend.php');
}
function longPost()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $postnumber = $_GET['id'];
    $blogmodel = $connexionmodel -> getLongPost($postnumber);
        $title = $blogmodel['post_title'];
        $datepost = $blogmodel['post_date'];
        $postmessage = $blogmodel['post_content'];
        $postnumber = $blogmodel['post_id'];
        $postuser = $blogmodel['mail'];
    $commentmodel = $connexionmodel -> postComment($postnumber);
       
    require('view/frontend/postView.php');

}
function newPost()
{
    if(!empty($_POST['subject']) and !empty($_POST['message'])){
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $title = $_POST['subject'];
    $content = $_POST['message'];
    $usersId = $_SESSION['users_id'];
    $newPost = $connexionmodel->newPost($title, $content, $usersId);
    }
    require('view/backend/newPost.php');
}
function changePost()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $postnumber = $_GET['id'];
    $changePost = $connexionmodel -> getChangePost($postnumber);
    /*$title = $changePost['post_title'];
    $message = $changePost['post_content'];
    */var_dump($changePost);
    die();
    require('view/backend/changePost.php');
}
function updatePost()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $updatePost = $connexionmodel -> updatePostNow($subject, $message, $postnumber);
    header('refresh:3; url= index.php?action=admin');
    require('view/backend/updatePost.php');
}
function deletePost()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $postnumber = $_GET['id'];
    $GetdeletePost = $connexionmodel->deletePostNow($postnumber);
    header('refresh:3; url= index.php?action=admin');
    require('view/backend/deletePost.php');
}
function usersList()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    
    //$usersList = $connexionmodel -> usersList();
    
    require('view/backend/usersList.php');
}
function commentModeration()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    
    //$commentModeration = $connexionmodel -> commentModeration();
    
    require('view/backend/commentModeration.php');
}
function commentReport()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    
    //$commentReport = $connexionmodel -> commentReport();
    
    require('view/backend/commentReport.php');
}
function allPost()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    
    $blogmodel = $connexionmodel -> allPost();
    
    require('view/frontend/allPostView.php');
}
function getComment()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $title = $_POST['subject'];
    $content = $_POST['message'];
    $postId = $_GET["id"];
    $usersId = $_SESSION['users_id']; 
    $blogmodel = $connexionmodel -> addComment($title, $content, $postId, $usersId);
    require('view/frontend/postComment.php');
}

// fonction qui envoie le mail à l'utilisateur
function get_passforget()
{
    $connexionmodel = new \memberSpace\Model\MemberManager(); // créer un Objet
    if (isset($_POST['identifiant'])) // si l'identifiant est renseigné
    {
        $mailconnect = htmlspecialchars($_POST['identifiant']); // déclaration de la variable mailconnect
        $check_connect = $connexionmodel->check_exist($mailconnect); // appel de la fonction qui vérifie l'existance du mail dans la BDD

        $userexist = $check_connect->rowCount(); // compter le nombre de ligne
        while ($profil = $check_connect->fetch()) // on boucle pour récupérer les infos sur l'user
        {
            if ($userexist == 1) // si l'user = 1 c'est qu'il existe
            {
                
                header('Location: index.php?action=send_Mail_Password');
                $id = $profil['users_id'];
                $receivetoken = $connexionmodel->getTokenpassforget($mailconnect); // appel du model qui prépare l'injection du Token
                $Token = $profil['mail'] . $profil['law_label'] . $profil['create_date_users']; // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
                $hash_Token = password_hash($Token, PASSWORD_DEFAULT); // On hash le token
                $addtoken = $receivetoken->execute(array($hash_Token, $mailconnect)); // On insere dans la BDD
                // Envoyer un mail avec le Token à l'utilisateur concerné
                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From:"Jpochet"<jpochet@lhermitte.fr>' . "\n";
                $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';

                $message = 'Bonjour, ' . '</br>' . '</br>' .
                    'Veuillez sur le lien ci dessous pour changer votre mot de passe : ' . '</br>' . '</br>'
                    . "<a href='http://localhost/my_blog/index.php?action=passchange&id=" . $id . "&token=" . $hash_Token . "'>Changer de mot de passe</a>"

                    . '</br>' . '</br>' . 'Cdt,';

                mail("$mailconnect", "Mot de passe oublié", $message, $header);
            } elseif (isset($mailconnect)) {
                $error = "Adresse mail inconnu";
            } else {
                $error = "Veuillez saisir un mail";
            }
        }
    }
    require('view/frontend/connect/change-forgot-password.php');
}

function send_Mail_Password(){
    $error = " Nous vous avons envoyé un mail pour réinitialiser votre mot de passe, vous pouvez fermer cette fenêtre" . '</br>' . '</br>';
    require('view/frontend/pageNoFound.php');
}

// Fonction pour demander la saisie du nouveau mot de passe
function passchange($idconnect, $controltoken)
{
    $error = 'Veuillez saisir votre nouveau mot de passe';
    $_SESSION['users_id'] = $idconnect;
    $_SESSION['token'] = $controltoken;
    require('view/frontend/connect/change-forgot-password.php');
}

// fonction quand l'utilisateur a changé son mot de passe
function get_passchange()
{
    $idconnect = $_SESSION['users_id'];
    $controltoken = $_SESSION['token'];
    $connexionmodel = new \memberSpace\Model\MemberManager(); // créer un Objet
    if (isset($idconnect) and isset($controltoken)) {
        $check_id = $connexionmodel->check_id($idconnect); // appel de la fonction qui vérifie l'existance du mail dans la BDD
        while ($profil = $check_id->fetch()) // on boucle pour récupérer les infos sur l'user
        {
            if ($profil['token'] == $controltoken) {;
                $newpassword = $_POST['newmdp'];
                $controlnewpassword = $_POST['controlnewmdp'];
                if ($newpassword == $controlnewpassword) {
                    $hashnewpass =  password_hash($newpassword, PASSWORD_DEFAULT); // On hash le token
                    $cleartoken = '';
                    $error = 'vous avez bien changé de mot de passe';
                    $link = $connexionmodel->changepass($idconnect, $hashnewpass, $cleartoken); // appel du model qui prépare l'injection du Token
                    header('refresh:3; url= index.php?action=connexion');
                } else {
                    $error = 'Les mots de passes ne sont pas identiques';
                }
            } else {
                $error = 'Vous avez déjà changé votre mot de passe, rendez vous à la page de connexion';
                header('refresh:3; url= index.php');
            }
        }
    }
    require('view/frontend/connect/change-forgot-password.php');
}
/*
function getAdmin()
{
    session_start();
    $connexionmodelStates = new \memberSpace\Model\adminManager(); // créer un Objet
    $admin = $connexionmodelStates->sectionArticle(); // appel de la fonction qui vérifie l'existance du mail dans la BDD
    $droit = $connexionmodelStates->droitAdmin(); // appel de la fonction qui vérifie l'existance du mail dans la BDD
    $listdroit = $connexionmodelStates->listdroitAdmin(); // appel de la fonction qui vérifie l'existance du mail dans la BDD
    require('view/backend/administration.php');
}

function contact()
{
    session_start();
    require('view/frontend/contact.php');
}
function sendContact()
{
    session_start();

    $nom = htmlspecialchars($_POST['name']); // déclaration de la variable mailconnect
    $mail = htmlspecialchars($_POST['email']); // déclaration de la variable mailconnect
    $message = htmlspecialchars($_POST['message']); // déclaration de la variable mailconnect
    $header = "MIME-Version: 1.0\r\n";
    $header .= 'From:"Jpochet"<jpochet@lhermitte.fr>' . "\n";
    $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
    $header .= 'Content-Transfer-Encoding: 8bit';

    mail("jpochet@lhermitte.fr", "Mail en provenance de jpochet.fr", $message, $header);
    $error = "Votre mail a bien été envoyé !";
    header('Location: index.php');
    require('view/frontend/contact.php');
}
function profil()
{
    session_start();
    require('view/frontend/profil.php');
}*/
