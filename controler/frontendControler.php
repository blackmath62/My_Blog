<?php

require_once('Model/MemberManager.php');
require_once('Model/BlogManager.php');
require_once('Model/CommentManager.php');
require('entity/memberEntity.php');
require('entity/commentEntity.php');
require('entity/blogEntity.php');

function pageNoFound()
{
    require('view/frontend/pageNoFound.php');
}
// connexion function
function connexion()
{
    if (isset($_SESSION['mail'])) {
        $mailconnect = $_SESSION['mail'];
        $usersId = $_SESSION['users_id'];
        // Suppression des variables de session et de la session
        $connexionmodel = new \memberSpace\Model\MemberManager();
        session_start();
        session_unset();
        session_destroy();
    }
    require('view/frontend/connect/loginview.php');
}
function kill_connexion()
{
    session_start(); // Démarre une nouvelle session ou reprend une session existante
    session_unset(); // Détruit toutes les variables d'une session
    session_destroy(); // Détruit une session
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
        $check_connect = $connexionmodel->checkMailExist($mailconnect);
        $mailExist = $check_connect->rowCount(); // compter le nombre de ligne  

        if ($mailExist == 1) {

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
        if ($mailExist == 0 and !empty($mailconnect)) {
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
        $pseudo = htmlspecialchars($_POST['pseudo']);  //on déclare les variables
        $mdpconnect = password_hash($_POST['mdpconnect'], PASSWORD_DEFAULT); // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
        $check_connect = $connexionmodel->checkMailExist($mailconnect); // on vérifie si le compte n'existe pas déjà
        $mailExist = $check_connect->rowCount(); // compter le nombre de ligne 
        $check_pseudo = $connexionmodel->checkPseudoExist($pseudo); // on vérifie si le compte n'existe pas déjà
        $pseudoExist = $check_pseudo->rowCount(); // compter le nombre de ligne
        if ($mailExist == 1) {
            $error = "Le mail est déjà utilisé, veuillez choisir un autre mail ou vous connecter.";
        } elseif ($mailExist == 0) {
            
            if ($pseudoExist == 1) {
                $error = "Le pseudo est déjà utilisé, veuillez choisir un autre pseudo ou vous connecter.";
            } elseif ($pseudoExist == 0) {
                if ($_POST['mdpconnect'] == $_POST['mdp_register_verif']) //si les 2 mots de passes sont identiques
                {
                    $register = $connexionmodel->addRegister($mailconnect, $pseudo, $mdpconnect);
                    $error = " Nous avons créé votre compte " . $pseudo . " ! L'administrateur va débloquer votre compte pour que vous puissiez ajouter des commentaires sur le site internet" . '</br';
                }
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

function send_Mail_Password()
{
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
//  end connexion function

//  administration function
function getAdmin()
{
    require('view/backend/backendHome.php');
}

function newPost()
{
    if (!empty($_POST['subject']) and !empty($_POST['message'])) {
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
    $changePost = $connexionmodel->getChangePost($postnumber);
    $title = $changePost['post_title'];
    $message = $changePost['post_content'];
    require('view/backend/changePost.php');
}
function updatePost()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $postnumber = $_GET['id'];
    $title = $_POST['subject'];
    $message = $_POST['message'];
    $updatePost = $connexionmodel->updatePostNow($title, $message, $postnumber);
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
    $UsersLawmodel = new \memberSpace\Model\MemberManager(); // créer un Objet
    $allLaw = $UsersLawmodel->getLawList();
    $allUsers = $UsersLawmodel->getUsersList();
    /*echo '<pre>';
    var_dump($allUsers);
    echo '</pre>';
    die();*/
    require('view/backend/usersList.php');
}

function getReportComment()
{
    $Commentmodel = new \memberSpace\Model\CommentManager(); // créer un Objet
    $usersId = $_SESSION['users_id'];
    $postnumber = $_GET['postid'];
    $commentId = $_GET['commentid'];
    $commentModeration = $Commentmodel->commentReport($usersId, $postnumber, $commentId);
    header('Location:index.php?action=longPost&id=' . $_GET['postid']);
    /*$error = "Votre signalement a bien été enregistré";*/
    require('view/frontend/reportComment.php');
}
function getRemoveReport()
{
    $Commentmodel = new \memberSpace\Model\CommentManager(); // créer un Objet
    $usersId = $_SESSION['users_id'];
    $postnumber = $_GET['postid'];
    $commentId = $_GET['commentid'];
    $RemoveReportNow = $Commentmodel->removeReport($usersId, $postnumber, $commentId);
    header('Location:index.php?action=longPost&id=' . $_GET['postid']);
    /*$error = "Votre signalement a bien été enregistré";*/
    require('view/frontend/removeReportView.php');
}

function ChangeLawUser()
{
    $changeLawModel = new \memberSpace\Model\MemberManager(); // créer un Objet
    $idLaw = $_GET['id'];
    $idUser = $_GET['userid'];
    $changelaw = $changeLawModel->getChangeLawUser($idLaw, $idUser);
    header('Location: index.php?action=usersList');
    require('view/backend/changeLawView.php');
}

function deleteUser()
{
    $deleteUserModel = new \memberSpace\Model\MemberManager(); // créer un Objet
    $idUser = $_GET['userid'];
    $getDeleteUser = $deleteUserModel->deleteUser($idUser);
    header('Location: index.php?action=usersList');
    require('view/backend/deleteUserView.php');
}

function commentReport()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet

    //$commentReport = $connexionmodel -> commentReport();

    require('view/backend/commentReport.php');
}

//  end administration function

// site page function
function allPost() // Chapo post list
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $Commentmodel = new \memberSpace\Model\CommentManager(); // créer un Objet
    $allPostChapo = $connexionmodel->allPost();
    if ($_SESSION['law_id'] == 1) {
        $numberComment = $Commentmodel->numberCommentReport();
        $numberWaitComment = $Commentmodel->numberCommentWait();
    }
    require('view/frontend/allPostView.php');
}
function getComment()
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $title = $_POST['subject'];
    $content = $_POST['message'];
    $postId = $_GET["id"];
    $usersId = $_SESSION['users_id'];
    $blogmodel = $connexionmodel->addComment($title, $content, $postId, $usersId);
    require('view/frontend/postComment.php');
}

function home() // home page 3 last chapo post
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $homePage = $connexionmodel->lastPost();

    require('view/frontend/templateFrontend.php');
}
function longPost() // Long Post view
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $postnumber = $_GET['id'];
    $GetLongPost = $connexionmodel->getLongPost($postnumber);
    $postnumber = $GetLongPost->post_id();
    $commentConnexionModel = new \memberSpace\Model\CommentManager(); // créer un Objets
    // On affiche les status des commentaires et le nombre de signalement des commentaires validés
    if ($_SESSION['law_id'] = 1) {
        $allComment = $commentConnexionModel->commentInfo($postnumber); // Liste des commentaires en attente de validation et des commentaires signalés    
    } else {
        $commentmodel = $connexionmodel->postComment($postnumber); // affichage pour l'utilisateur des commentaires validés
        if (isset($_SESSION['users_id'])) {
            $usersId = $_SESSION['users_id'];
            $checkAllreadyReport = $commentConnexionModel->checkAllreadyReport($usersId, $postnumber); // Vu utilisateur, pour les commentaires qu'il a signalé
        }
    }
    require('view/frontend/postView.php');
}
// end site page function
