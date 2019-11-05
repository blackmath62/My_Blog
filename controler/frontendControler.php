<?php

require_once('Model/MemberManager.php');

// connexion function

function pageNoFound()
{
    require('view/frontend/pageNoFound.php');
}

function connexion()
{
    session_start();
    if (isset($_SESSION['mail'])) {
        $mailconnect = $_SESSION['mail'];
        $ip = 'Déconnecté';
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
    session_start();
    session_destroy();
    header('Location: index.php');
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
            setcookie('mail', $mailconnect, time() + 365 * 24 * 3600, null, null, false, true); // On écrit un cookie

            $connect = $connexionmodel->getconnect($mailconnect);
            while ($profil = $connect->fetch()) { // on boucle sur le MemberManager/connect
                $isPasswordCorrect = password_verify($_POST['mdpconnect'], $profil['mdp']); // Comparaison du pass envoyé via le formulaire avec la base    
                if ($isPasswordCorrect)  // si c'est égale à 1  et le mot de passe est correct
                { // Comparaison du pass envoyé via le formulaire avec la base
                    session_start();   // connexion a une session utilisateur
                    $_SESSION['mail'] = $profil['mail'];
                    $_SESSION['law_label'] = $profil['law_label'];
                    $mailconnect = $_SESSION['mail'];
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
    require('view/frontend/htmlTemplate.php');
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

function blog()
{
    $blogmodel = new \memberSpace\Model\TheBlogManager(); // créer un Objet
    session_start();

    if (isset($_POST['postMessage']) and !empty($_POST['postMessage'])) {
        $mailConnect = $_SESSION['mail'];
        $postMessage = htmlspecialchars($_POST['postMessage']);
        $getPostMessage = $blogmodel->getPost($mailConnect, $postMessage); // injecter le message

    }

    require('view/frontend/blogView.php');
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
                $error = " Nous vous avons envoyé un mail pour réinitialiser votre mot de passe" . '</br>' . '</br>';

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

// Fonction pour demander la saisie du nouveau mot de passe
function passchange($idconnect, $controltoken)
{
    $error = 'Veuillez saisir votre nouveau mot de passe';
    session_start();
    $_SESSION['users_id'] = $idconnect;
    $_SESSION['token'] = $controltoken;
    require('view/frontend/connect/change-forgot-password.php');
}

// fonction quand l'utilisateur a changé son mot de passe
function get_passchange()
{
    session_start();
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
