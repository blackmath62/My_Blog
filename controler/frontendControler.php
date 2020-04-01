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
        // Suppression des variables de session et de la session
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

function check_connexion() // Contrôler id et mdp et connecter
{
    $memberManager = new \memberSpace\Model\MemberManager();

    // récupérer les valeurs saisies dans le formulaire
    $mail = htmlspecialchars($_POST['identifiant']);
    $mdp = htmlspecialchars($_POST['mdpconnect']);
    // créer une instance d'object class member
    $user = new Member; // création d'un objet user
    $user->setMail($mail); // modification des valeurs de l'objet
    $user->setMdp($mdp);
    $controlUser = $user->checkMailExist($user->mail()); // l'objet étant une extension du member manager, il est possible d'appeler directement les fonctions

    // contrôler que le mail existe dans la BDD
    if (!$controlUser) {
        $error = "le mail n'existe pas ";
        require('view/frontend/connect/loginview.php');
    } else {

        // le mail a été trouvé une seule fois
        $passwordCorrect = password_verify($user->mdp(), $controlUser['mdp']);
        if ($passwordCorrect) {
            $error = "Connexion réussie ! ";

            // créer les variable de session
            session_start();
            $_SESSION['mail'] = $user->mail();
            $_SESSION['law_id'] = $controlUser['law_id'];
            $_SESSION['users_id'] = $user->users_id();
            home();
        } else {
            $error  = "Mot de passe incorrect !";
            require('view/frontend/connect/loginview.php');
        }
    }
}
// début création compte
function register() // afficher la vue d'inscription
{
    require('view/frontend//connect/registerview.php');
}

function check_register() // la fonction pour contrôler si l'utilisateur peut être créé et le créer
{
    $getRegister = new \memberSpace\Model\MemberManager(); // on créé un nouvelle objet
    if (isset($_POST['identifiant']) and isset($_POST['mdpconnect']) and isset($_POST['mdp_register_verif'])) // on contrôle si l'id et les 2 mots de passe sont renseignés
    {
        $mailconnect = htmlspecialchars($_POST['identifiant']);  //on déclare les variables
        $pseudo = htmlspecialchars($_POST['pseudo']);  //on déclare les variables
        $mdpconnect = password_hash($_POST['mdpconnect'], PASSWORD_DEFAULT); // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
        $check_connect = $getRegister->checkMailExist($mailconnect); // on vérifie si le compte n'existe pas déjà
        //$mailExist = $check_connect->rowCount(); // compter le nombre de ligne 
        $check_pseudo = $getRegister->checkPseudoExist($pseudo); // on vérifie si le compte n'existe pas déjà
        $pseudoExist = $check_pseudo->rowCount(); // compter le nombre de ligne
        if ($check_connect) {
            $error = "Le mail est déjà utilisé, veuillez choisir un autre mail ou vous connecter.";
        } elseif (!$check_connect) {

            if ($pseudoExist) {
                $error = "Le pseudo est déjà utilisé, veuillez choisir un autre pseudo ou vous connecter.";
            } elseif (!$pseudoExist) {
                if ($_POST['mdpconnect'] == $_POST['mdp_register_verif']) //si les 2 mots de passes sont identiques
                {
                    $register = $getRegister->addRegister($mailconnect, $pseudo, $mdpconnect); // création de compte
                    $error = " Nous avons créé votre compte " . $pseudo . " ! L'administrateur va débloquer votre compte pour que vous puissiez ajouter des commentaires sur le site internet" . '</br';
                    header('refresh:3; url= index.php?action=connexion');
                }else{
                    $error = "Vos 2 mots de passe ne sont pas identiques";
                }
            }
        }
    }
    require('view/frontend/connect/registerview.php');
}
// fin création compte

// début page mot de passe oublié
function passforget() // afficher la vue de mot de passe oublié
{
    $colorcontent = 'bg-gradient-warning';
    require('view/frontend/connect/forgot-password.php');
}
function get_passforget() // Contrôle et envoi du mail avec le Token
{
    $sendTokenMail = new \memberSpace\Model\MemberManager(); // créer un Objet
        $mailconnect = htmlspecialchars($_POST['identifiant']); // déclaration de la variable mail
        $controlUser = $sendTokenMail->checkMailExist($mailconnect); // l'objet étant une extension du member manager, il est possible d'appeler directement les fonctions
        $userId = $controlUser['users_id'];
        /*$user->setUsersId($usersId);*/
        if ($controlUser) // si l'user est trouvé c'est qu'il existe
        {
            $error = $mailconnect;
            header('Location: index.php?action=send_Mail_Password');
            $receivetoken = $sendTokenMail->getTokenpassforget($mailconnect); // appel du model qui prépare l'injection du Token
            $Token = $controlUser['mail'] . $userId . $controlUser['law_id']; // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
            $hash_Token = password_hash($Token, PASSWORD_DEFAULT); // On hash le token
            $addtoken = $receivetoken->execute(array($hash_Token, $mailconnect)); // On insere dans la BDD
            // Envoyer un mail avec le Token à l'utilisateur concerné
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"Jpochet"<jpochet@lhermitte.fr>' . "\n";
            $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
            $header .= 'Content-Transfer-Encoding: 8bit';

            $message = 'Bonjour, ' . '</br>' . '</br>' .
                'Veuillez sur le lien ci dessous pour changer votre mot de passe : ' . '</br>' . '</br>'
                . "<a href='http://localhost/my_blog/index.php?action=passchange&id=" . $userId . "&token=" . $hash_Token . "'>Changer de mot de passe</a>"

                . '</br>' . '</br>' . 'Cdt,';

            mail("$mailconnect", "Réinitialité votre mot de passe", $message, $header);
            header('refresh:1; url= index.php?action=index.php');
        } elseif (!$controlUser) {
            $error = "Adresse mail inconnu";
        }
    require('view/frontend/connect/change-forgot-password.php');
}

function send_Mail_Password() // page pour signaler l'envoi du mail de réinitialisation
{
    $error = " Nous vous avons envoyé un mail pour réinitialiser votre mot de passe, vous pouvez fermer cette fenêtre" . '</br>' . '</br>';
    header('refresh:3; url= index.php');
    require('view/frontend/pageNoFound.php');
}

function passchange($idconnect, $controltoken) // Fonction pour demander la saisie du nouveau mot de passe
{
    $error = 'Veuillez saisir votre nouveau mot de passe';
    session_start();
    $_SESSION['users_id'] = $idconnect;
    $_SESSION['token'] = $controltoken;
    require('view/frontend/connect/change-forgot-password.php');
}

// fonction quand l'utilisateur a changé son mot de passe
function get_passchange() // Changement du mot de passe utilisateur
{
    $idconnect = $_SESSION['users_id'];
    $controltoken = $_SESSION['token'];
    $connexionmodel = new \memberSpace\Model\MemberManager(); // créer un Objet
    if (isset($idconnect) and isset($controltoken)) {
        $check_id = $connexionmodel->check_id($idconnect,$controltoken); // appel de la fonction qui vérifie l'existance du mail dans la BDD
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
// fin page mot de passe oublié
//  end connexion function

//  administration function
function getAdmin()
{
    require('view/backend/backendHome.php');
}

function newPost()
{
    if (!empty($_POST['subject']) and !empty($_POST['message'])) {
        $getNewPost = new \memberSpace\Model\BlogManager(); // créer un Objet
        $title = $_POST['subject'];
        $content = $_POST['message'];
        $usersId = $_SESSION['users_id'];
        $newPost = $getNewPost->newPost($title, $content, $usersId);
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
    require('view/backend/usersList.php');
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

//  end administration function

// site page function

function contact_me() // Formulaire de contact
{
    $name = $_POST['name'];
    $mail = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Envoyer un mail
    $header = "MIME-Version: 1.0\r\n";
    $header .= 'From:"Jpochet"<jpochet@lhermitte.fr>' . "\n";
    $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
    $header .= 'Content-Transfer-Encoding: 8bit';

    mail("jpochet@lhermitte.fr", "Vous avez reçu un nouveau message en provenance du Blog", "Objet:" . $subject . "</br>" . "</br>" . "Envoyé par: " . $name . "</br>" . "</br>" . "Adresse mail: " . $mail . "</br>" . "</br>" . "Message: " . "</br>" . nl2br($message), $header);
    header('refresh:3; url= index.php');
    require('view/frontend/mail.php');
}
function allPost() // Chapo post list
{
    $connexionmodel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $Commentmodel = new \memberSpace\Model\CommentManager(); // créer un Objet
    $allPostChapo = $connexionmodel->allPost();
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
    $chapoHomePage = new \memberSpace\Model\BlogManager(); // créer un Objet
    $homePageChapo = $chapoHomePage->lastPost();

    require('view/frontend/templateFrontend.php');
}
function longPost() // Long Post view
{
    $blogModel = new \memberSpace\Model\BlogManager(); // créer un Objet
    $postnumber = $_GET['id'];
    $GetLongPost = $blogModel->getLongPost($postnumber);
    $postnumber = $GetLongPost->post_id();

    $allComment = $blogModel->postComment($postnumber); // affichage pour l'utilisateur des commentaires validés
    $getComment = $allComment->fetchAll(\PDO::FETCH_CLASS, 'Comment');
    $usersId = $_SESSION['users_id'];
    require('view/frontend/postView.php');
}
// end site page function
