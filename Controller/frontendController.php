<?php
namespace App;
use App\Model\MemberManager;
use App\Model\BlogManager;
use App\Model\CommentManager;
use App\Entity\Member;
use App\config\Request;

function pageNoFound()
{
    require 'view/frontend/pageNoFound.php';
}
// connexion function
function connexion() // affichage page connexion avec suppression variable de session
{
    require 'view/frontend/connect/loginview.php';
}

function check_connexion($mail,$mdp) // Contrôler id et mdp et se connecter
{
    // récupérer les valeurs saisies dans le formulaire
    // créer une instance d'object class member
    $user = new Member; // création d'un objet user
    $user->setMail($mail); // modification des valeurs de l'objet
    $user->setMdp($mdp);
    $controlUser = $user->checkMailExist($user->mail()); // l'objet étant une extension du member manager, il est possible d'appeler directement les fonctions
    $user->setUsersId($controlUser['users_id']);
    // contrôler que le mail existe dans la BDD
    if (!$controlUser) {
        $error = "le mail n'existe pas ";
        require 'view/frontend/connect/loginview.php';
    } else {

        // le mail a été trouvé une seule fois
        $passwordCorrect = password_verify($user->mdp(), $controlUser['mdp']);
        if ($passwordCorrect) {
            $error = "Connexion réussie ! ";
            $request = new Request();
            $request->getSession()->setter('users_id', $user->users_id());
            $request->getSession()->setter('mail', $user->mail());
            $request->getSession()->setter('law_id', $controlUser['law_id']);
            home();
        } else {
            $error  = "Mot de passe incorrect !";
            require 'view/frontend/connect/loginview.php';
        }
    }
}
// début création compte
function registerPage() // afficher la vue d'inscription
{
    require 'view/frontend//connect/registerview.php';
}

function check_register($identity,$mdp,$mdpcontrol,$pseudo) // la fonction pour contrôler si l'utilisateur peut être créé et le créer
{
    $getRegister = new MemberManager(); // on créé un nouvelle objet
    if (isset($identity) and isset($mdp) and isset($mdpcontrol)) // on contrôle si l'id et les 2 mots de passe sont renseignés
    {
        $mailconnect = htmlspecialchars($identity);  //on déclare les variables
        $mdpconnect = password_hash($mdp, PASSWORD_DEFAULT); // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
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
                if ($mdp == $mdpcontrol) //si les 2 mots de passes sont identiques
                {
                    $registerAdd = $getRegister->addRegister($mailconnect, $pseudo, $mdpconnect); // création de compte
                    $error = " Nous avons créé votre compte " . $pseudo . " ! L'administrateur va débloquer votre compte pour que vous puissiez ajouter des commentaires sur le site internet" . '</br';
                    header('refresh:3; url= index.php?action=connexion');
                }else{
                    $error = "Vos 2 mots de passe ne sont pas identiques";
                }
            }
        }
    }
    require 'view/frontend/connect/registerview.php';
}
// fin création compte

// début page mot de passe oublié
function passforget() // afficher la vue de mot de passe oublié
{
    require 'view/frontend/connect/forgot-password.php';
}
function get_passforget($mailconnect) // Contrôle et envoi du mail avec le Token
{
    $sendTokenMail = new MemberManager(); // créer un Objet
        $controlUser = $sendTokenMail->checkMailExist($mailconnect); // l'objet étant une extension du member manager, il est possible d'appeler directement les fonctions
        $userId = $controlUser['users_id'];
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
    require 'view/frontend/connect/change-forgot-password.php';
}

function send_Mail_Password() // page pour signaler l'envoi du mail de réinitialisation
{
    $error = " Nous vous avons envoyé un mail pour réinitialiser votre mot de passe, vous pouvez fermer cette fenêtre" . '</br>' . '</br>';
    header('refresh:3; url= index.php');
    require 'view/frontend/pageNoFound.php';
}

function passchange() // Fonction pour demander la saisie du nouveau mot de passe
{
    $error = 'Veuillez saisir votre nouveau mot de passe';
    
    require 'view/frontend/connect/change-forgot-password.php';
}

// fonction quand l'utilisateur a changé son mot de passe
function get_passchange($idconnect, $controltoken) // Changement du mot de passe utilisateur
{
    $changepassword = new MemberManager(); // créer un Objet
    if (isset($idconnect) and isset($controltoken)) {
        $check_id = $changepassword->check_id($idconnect,$controltoken); // appel de la fonction qui vérifie l'existance du mail dans la BDD
        while ($profil = $check_id->fetch()) // on boucle pour récupérer les infos sur l'user
        {
            if ($profil['token'] == $controltoken) {
                $request = new Request();
                $newpassword = $request->post('newmdp');
                $controlnewpassword = $request->post('controlnewmdp');
                if ($newpassword == $controlnewpassword) {
                    $hashnewpass =  password_hash($newpassword, PASSWORD_DEFAULT); // On hash le token
                    $cleartoken = '';
                    $error = 'vous avez bien changé de mot de passe';
                    $link = $changepassword->changepass($idconnect, $hashnewpass, $cleartoken); // appel du model qui prépare l'injection du Token
                    header('refresh:1; url= index.php?action=connexion');
                    return;
                }
                    $error = 'Les mots de passes ne sont pas identiques';
                    return;
            }
                $error = 'Vous avez déjà changé votre mot de passe, rendez vous à la page de connexion';
                header('refresh:3; url= index.php');
                return;
        }
    }
    require 'view/frontend/connect/change-forgot-password.php';
}
// fin page mot de passe oublié
//  end connexion function

//  administration function
function getAdmin()
{
    require 'view/backend/backendHome.php';
}

function newPost($title, $content, $usersId)
{
        $getNewPost = new BlogManager(); // créer un Objet
        $newPost = $getNewPost->newPost($title, $content, $usersId);
        header('refresh:1; url= index.php?action=admin');
        require 'view/backend/newPost.php';
}
function viewNewPost()
{
        require 'view/backend/newPost.php';
}


function frontendListingPost()
{
    $postList = new BlogManager(); // créer un Objet
    $frontendListPost = $postList->allPost();
    require 'view/backend/listingPost.php';
}
function frontendListingComment()
{
    $commentList = new BlogManager(); // créer un Objet
    $allComment = $commentList->allComment();
    require 'view/backend/listingComment.php';
}

function changePost($postnumber)
{
    $connexionmodel = new BlogManager(); // créer un Objet
    $changePost = $connexionmodel->getChangePost($postnumber);
    $title = $changePost['post_title'];
    $message = $changePost['post_content'];
    require 'view/backend/changePost.php';
}
function updatePost($postnumber, $subject, $message)
{
    $connexionmodel = new BlogManager(); // créer un Objet
    $updatePost = $connexionmodel->updatePostNow($postnumber, $subject, $message);
    header('refresh:1; url= index.php?action=listingPost');
    require 'view/backend/updatePost.php';
}
function deletePost($postnumber)
{
    $deleteThisPost = new BlogManager(); // créer un Objet
    $GetdeletePost = $deleteThisPost->deletePostNow($postnumber);
    header('refresh:1; url= index.php?action=listingPost');
    require 'view/backend/deletePost.php';
}
function usersList()
{
    $UsersLawmodel = new MemberManager(); // créer un Objet
    $allLaw = $UsersLawmodel->getLawList();
    $allUsers = $UsersLawmodel->getUsersList();
    require_once 'view/backend/usersList.php';
}

function ChangeLawUser($idLaw, $idUser)
{
    $changeLawModel = new MemberManager(); // créer un Objet
    $changelaw = $changeLawModel->getChangeLawUser($idLaw, $idUser);
    header('Location: index.php?action=usersList');
    require 'view/backend/changeLawView.php';
}

function deleteUser($idUser)
{
    $deleteUserModel = new MemberManager(); // créer un Objet
    $getDeleteUser = $deleteUserModel->deleteUser($idUser);
    header('Location: index.php?action=usersList');
    require 'view/backend/deleteUserView.php';
}

//  end administration function

// site page function

function contact_me($name,$mail,$subject,$message) // Formulaire de contact
{
    
    // Envoyer un mail
    $header = "MIME-Version: 1.0\r\n";
    $header .= 'From:"Jpochet"<jpochet@lhermitte.fr>' . "\n";
    $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
    $header .= 'Content-Transfer-Encoding: 8bit';

    mail("jpochet@lhermitte.fr", "Vous avez reçu un nouveau message en provenance du Blog", "Objet:" . $subject . "</br>" . "</br>" . "Envoyé par: " . $name . "</br>" . "</br>" . "Adresse mail: " . $mail . "</br>" . "</br>" . "Message: " . "</br>" . nl2br($message), $header);
    header('refresh:3; url= index.php');
    require 'view/frontend/mail.php';
}
function allPost() // Chapo post list
{
    $chapoList = new BlogManager(); // créer un Objet
    $allPostChapo = $chapoList->allPost();
    require 'view/frontend/allPostView.php';
}
function getComment($title,$content, $postId, $usersId)
{
    $GetAddComment = new BlogManager(); // créer un Objet
    $blogmodel = $GetAddComment->addComment($title, $content, $postId, $usersId);
    require 'view/frontend/postComment.php';
}

function home() // home page 3 last chapo post
{
    $chapoHomePage = new BlogManager(); // créer un Objet
    $homePageChapo = $chapoHomePage->lastPost();

    require 'view/frontend/templateFrontend.php';
}
function longPost($postnumber) // Long Post view
{
    $getPostAndComment = new BlogManager(); // créer un Objet
    $GetLongPost = $getPostAndComment->getLongPost($postnumber); // affichage du post entier
    $listCommentToPost = $getPostAndComment->postComment($postnumber); // affichage des commentaires validés
    require 'view/frontend/postView.php';
}
function changeStatusComment($commentId,$validateId) // Long Post view
{
    $changeStatus = new CommentManager(); // créer un Objet
    $status = $changeStatus->commentReport($commentId,$validateId); // affichage du post entier
    return $status;
    header('Location: index.php?action=listingComment');
    require 'view/backend/changeStatusComment.php';
}

// end site page function
