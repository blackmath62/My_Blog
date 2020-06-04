<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Model\BlogManager;
use App\Entity\Member;
use App\config\Request;
use App\Entity\View;

class ControllerFrontend
{
    private $view;
    function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->getRegister = new MemberManager();
        $this->user = new Member;
    }

    function pageNoFound()
    {
        $this->view->render('frontend/connect', 'pageNoFound', []);
    }
    // connexion function
    function connexion() // affichage page connexion avec suppression variable de 
    
    {
        $this->view->render('frontend/connect', 'loginview', []);
    }

    function check_connexion($mail, $mdp) // Contrôler id et mdp et se connecter
    {
        // récupérer les valeurs saisies dans le formulaire
        // créer une instance d'object class member
         // création d'un objet user
        $this->user->setMail($mail); // modification des valeurs de l'objet
        $this->user->setMdp($mdp);
        $controlUser = $this->user->checkMailExist($this->user->mail()); // l'objet étant une extension du member manager, il est possible d'appeler directement les fonctions
        $this->user->setUsersId($controlUser['users_id']);
        // contrôler que le mail existe dans la BDD
        if (!$controlUser) {
            $error = "le mail n'existe pas ";
            $this->view->render('frontend/connect', 'loginview', []);
        } else {

            // le mail a été trouvé une seule fois
            $passwordCorrect = password_verify($this->user->mdp(), $controlUser['mdp']);
            if ($passwordCorrect) {
                $error = "Connexion réussie ! ";
                $this->request->getSession()->setter('users_id', $this->user->users_id());
                $this->request->getSession()->setter('mail', $this->user->mail());
                $this->request->getSession()->setter('law_id', $controlUser['law_id']);
                $this->home();
            } else {
                $error  = "Mot de passe incorrect !";
                $this->view->render('frontend/connect', 'loginview', []);
            }
        }
    }
    // début création compte
    function registerPage() // afficher la vue d'inscription
    {
        $this->view->render('frontend/connect', 'registerview', []);
    }

    function check_register($identity, $mdp, $mdpcontrol, $pseudo) // la fonction pour contrôler si l'utilisateur peut être créé et le créer
    {
        if (isset($identity) and isset($mdp) and isset($mdpcontrol)) // on contrôle si l'id et les 2 mots de passe sont renseignés
        {
            $mailconnect = htmlspecialchars($identity);  //on déclare les variables
            $mdpconnect = password_hash($mdp, PASSWORD_DEFAULT); // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
            $check_connect = $this->getRegister->checkMailExist($mailconnect); // on vérifie si le compte n'existe pas déjà
            //$mailExist = $check_connect->rowCount(); // compter le nombre de ligne 
            $check_pseudo = $this->getRegister->checkPseudoExist($pseudo); // on vérifie si le compte n'existe pas déjà
            $pseudoExist = $check_pseudo->rowCount(); // compter le nombre de ligne
            if ($check_connect) {
                $error = "Le mail est déjà utilisé, veuillez choisir un autre mail ou vous connecter.";
            } elseif (!$check_connect) {

                if ($pseudoExist) {
                    $error = "Le pseudo est déjà utilisé, veuillez choisir un autre pseudo ou vous connecter.";
                } elseif (!$pseudoExist) {
                    if ($mdp == $mdpcontrol) //si les 2 mots de passes sont identiques
                    {
                        $registerAdd = $this->getRegister->addRegister($mailconnect, $pseudo, $mdpconnect); // création de compte
                        $error = " Nous avons créé votre compte " . $pseudo . " ! L'administrateur va débloquer votre compte pour que vous puissiez ajouter des commentaires sur le site internet" . '</br';
                        header('refresh:3; url= index.php?action=connexion');
                    } else {
                        $error = "Vos 2 mots de passe ne sont pas identiques";
                    }
                }
            }
        }
        $this->view->render('frontend/connect', 'registerview', []);
    }
    // fin création compte

    // début page mot de passe oublié
    function passforget() // afficher la vue de mot de passe oublié
    {
        $this->view->render('frontend/connect', 'forgot-password', []);
    }
    function get_passforget($mailconnect) // Contrôle et envoi du mail avec le Token
    {
        $controlUser = $this->getRegister->checkMailExist($mailconnect); // l'objet étant une extension du member manager, il est possible d'appeler directement les fonctions
        $userId = $controlUser['users_id'];
        if ($controlUser) // si l'user est trouvé c'est qu'il existe
        {
            $error = $mailconnect;
            header('Location: index.php?action=send_Mail_Password');
            $receivetoken = $this->getRegister->getTokenpassforget($mailconnect); // appel du model qui prépare l'injection du Token
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
        $this->view->render('frontend/connect', 'change-forgot-password', []);
    }

    function send_Mail_Password() // page pour signaler l'envoi du mail de réinitialisation
    {
        $error = " Nous vous avons envoyé un mail pour réinitialiser votre mot de passe, vous pouvez fermer cette fenêtre" . '</br>' . '</br>';
        header('refresh:3; url= index.php');
        $this->view->render('frontend', 'pageNoFound', []);
    }

    function passchange() // Fonction pour demander la saisie du nouveau mot de passe
    {
        $error = 'Veuillez saisir votre nouveau mot de passe';
        $this->view->render('frontend/connect', 'change-forgot-password', []);
    }

    // fonction quand l'utilisateur a changé son mot de passe
    function get_passchange($idconnect, $controltoken) // Changement du mot de passe utilisateur
    {
        if (isset($idconnect) and isset($controltoken)) {
            $check_id = $this->getRegister->check_id($idconnect, $controltoken); // appel de la fonction qui vérifie l'existance du mail dans la BDD
            while ($profil = $check_id->fetch()) // on boucle pour récupérer les infos sur l'user
            {
                if ($profil['token'] == $controltoken) {
                    $newpassword = $this->request->post('newmdp');
                    $controlnewpassword = $this->request->post('controlnewmdp');
                    if ($newpassword == $controlnewpassword) {
                        $hashnewpass =  password_hash($newpassword, PASSWORD_DEFAULT); // On hash le token
                        $cleartoken = '';
                        $error = 'vous avez bien changé de mot de passe';
                        $link = $this->getRegister->changepass($idconnect, $hashnewpass, $cleartoken); // appel du model qui prépare l'injection du Token
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
        $this->view->render('frontend/connect', 'change-forgot-password', []);
    }
    // fin page mot de passe oublié
    //  end connexion function

    //  end administration function

    // site page function

    function contact_me($name, $mail, $subject, $message) // Formulaire de contact
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
        $this->view->render('frontend', 'allPostView', ['allPostChapo' => $allPostChapo]);
    }
    function getComment($title, $content, $postId, $usersId)
    {
        $GetAddComment = new BlogManager(); // créer un Objet
        $blogmodel = $GetAddComment->addComment($title, $content, $postId, $usersId);
        $this->view->render('frontend', 'postComment', ['blogmodel' => $blogmodel]);
    }

    function home() // home page 3 last chapo post
    {
        $chapoHomePage = new BlogManager(); // créer un Objet
        $homePageChapo = $chapoHomePage->lastPost();
        $this->view->render('frontend', 'templateFrontend', ['homePageChapo' => $homePageChapo]);
    }
    function longPost($postnumber) // Long Post view
    {
        $getPostAndComment = new BlogManager(); // créer un Objet
        $GetLongPost = $getPostAndComment->getLongPost($postnumber); // affichage du post entier
        $listCommentToPost = $getPostAndComment->postComment($postnumber); // affichage des commentaires validés
        $this->view->render('frontend', 'postView', ['getLongPost' => $GetLongPost, 'listCommentToPost' =>$listCommentToPost ]);
    }
    // end site page function
}
