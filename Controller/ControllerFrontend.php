<?php

namespace App\Controller;

use App\Model\BlogManager;
use App\Entity\Member;
use App\config\Request;
use App\Entity\View;
use App\Model\ConnexionManager;
use App\Entity\Error;

class ControllerFrontend
{
    private $view;
    private $request;
    private $user;
    private $blogManager;
    private $connexionManager;
    private $error;

    function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->user = new Member;
        $this->blogManager = new BlogManager();
        $this->connexionManager = new ConnexionManager();
        $this->error = new Error();
    }
        
    function error()
    {
        $this->view->render('frontend/connect', 'error', []);
    }
    // connexion function
    function connexion() // affichage page connexion avec suppression variable de 
    
    {
        $error = 'Veuillez saisir votre identifiant et votre mot de passe';
        $this->view->render('frontend/connect', 'loginview', ['error' => $error]);
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
            $error = 'Le mail n\'hesiste pas';
            $this->view->render('frontend/connect', 'loginview', ['error' => $error]);
        } else {

            // le mail a été trouvé une seule fois
            $passwordCorrect = password_verify($this->user->mdp(), $controlUser['mdp']);
            if ($passwordCorrect) {
                $this->request->getSession()->setter('users_id', $this->user->users_id());
                $this->request->getSession()->setter('mail', $this->user->mail());
                $this->request->getSession()->setter('law_id', $controlUser['law_id']);
                $this->home();
            } else {
                $error  = "Identifiant ou Mot de passe incorrect !";
                $this->view->render('frontend/connect', 'loginview', ['error' => $error]);
            }
        }
    }
    // début création compte
    function registerPage() // afficher la vue d'inscription
    {
        $error = 'Veuillez renseigner les informations pour la création de votre compte';        
        $this->view->render('frontend/connect', 'registerview', ['error' => $error]);
    }

    function check_register($identity, $mdp, $mdpcontrol, $pseudo) // la fonction pour contrôler si l'utilisateur peut être créé et le créer
    {
        if (isset($identity) and isset($mdp) and isset($mdpcontrol)) // on contrôle si l'id et les 2 mots de passe sont renseignés
        {
            $mailconnect = htmlspecialchars($identity);  //on déclare les variables
            $mdpconnect = password_hash($mdp, PASSWORD_DEFAULT); // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
            $check_connect = $this->connexionManager->checkMailExist($mailconnect); // on vérifie si le compte n'existe pas déjà
            $check_pseudo = $this->connexionManager->checkPseudoExist($pseudo); // on vérifie si le compte n'existe pas déjà
            $pseudoExist = $check_pseudo->rowCount(); // compter le nombre de ligne
            if ($check_connect) {
                $error = "Le mail est déjà utilisé, veuillez choisir un autre mail ou vous connecter.";
            } elseif (!$check_connect) {

                if ($pseudoExist) {
                    $error = "Le pseudo est déjà utilisé, veuillez choisir un autre pseudo ou vous connecter.";
                } elseif (!$pseudoExist) {
                    if ($mdp == $mdpcontrol) //si les 2 mots de passes sont identiques
                    {
                        $this->connexionManager->addRegister($mailconnect, $pseudo, $mdpconnect); // création de compte
                        $error = " Nous avons créé votre compte " . $pseudo . " ! L'administrateur va débloquer votre compte pour que vous puissiez ajouter des commentaires sur le site internet" . '</br';
                        $this->view->render('frontend/connect', 'loginview', ['error' => $error]);
                    } else {
                        $error = "Vos 2 mots de passe ne sont pas identiques";
                    }
                }
            }
        }
        $this->view->render('frontend/connect', 'registerview', ['error' => $error]);
    }
    // fin création compte

    // début page mot de passe oublié
    function passforget() // afficher la vue de mot de passe oublié
    {
        $error = 'Un mail pour réinitialiter votre mot de passe va vous être envoyé';
        $this->view->render('frontend/connect', 'forgot-password', ['error' => $error]);
    }
    function get_passforget($mailconnect) // Contrôle et envoi du mail avec le Token
    {
        $controlUser = $this->connexionManager->checkMailExist($mailconnect); // l'objet étant une extension du member manager, il est possible d'appeler directement les fonctions
        $userId = $controlUser['users_id'];
        if ($controlUser) // si l'user est trouvé c'est qu'il existe
        {
            $error = $mailconnect;
            $receivetoken = $this->connexionManager->getTokenpassforget($mailconnect); // appel du model qui prépare l'injection du Token
            $Token = $controlUser['mail'] . $userId . $controlUser['law_id']; // le mot de passe de connexion est le mot de passe renseigné Hachage du mot de passe
            $hash_Token = password_hash($Token, PASSWORD_DEFAULT); // On hash le token
            $receivetoken->execute(array($hash_Token, $mailconnect)); // On insere dans la BDD
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
            $this->connexion();
        } elseif (!$controlUser) {
            $error = "Adresse mail inconnu";
        }
        $this->view->render('frontend/connect', 'change-forgot-password', ['error' => $error]);
    }

    function send_Mail_Password() // page pour signaler l'envoi du mail de réinitialisation
    {
        $error = " Nous vous avons envoyé un mail pour réinitialiser votre mot de passe, vous pouvez fermer cette fenêtre" . '</br>' . '</br>';
        $this->home();
        $this->view->render('frontend', 'pageNoFound', ['error' => $error]);
    }

    function passchange() // Fonction pour demander la saisie du nouveau mot de passe
    {
        $error = 'Veuillez saisir votre nouveau mot de passe';
        $this->view->render('frontend/connect', 'change-forgot-password', ['error' => $error]);
    }

    // fonction quand l'utilisateur a changé son mot de passe
    function get_passchange($idconnect, $controltoken) // Changement du mot de passe utilisateur
    {
        if (isset($idconnect) and isset($controltoken)) {
            $check_id = $this->connexionManager->check_id($idconnect, $controltoken); // appel de la fonction qui vérifie l'existance du mail dans la BDD
            while ($profil = $check_id->fetch()) // on boucle pour récupérer les infos sur l'user
            {
                if ($profil['token'] === $controltoken) {
                    $newpassword = $this->request->post('newmdp');
                    $controlnewpassword = $this->request->post('controlnewmdp');
                    if ($newpassword == $controlnewpassword) {
                        $hashnewpass =  password_hash($newpassword, PASSWORD_DEFAULT); // On hash le token
                        $cleartoken = '';
                        $error = 'vous avez bien changé de mot de passe, vous pouvez maintenant vous connecter';
                        $this->connexionManager->changepass($idconnect, $hashnewpass, $cleartoken); // appel du model qui prépare l'injection du Token
                        $this->view->render('frontend/connect', 'loginview', ['error' => $error]);
                    }
                    if($newpassword !== $controlnewpassword){
                    $error = 'Les mots de passes ne sont pas identiques';
                    $this->view->render('frontend/connect', 'change-forgot-password', ['error' => $error]);
                    }
                }
                
            }
            if(!isset($profil['token'])){
                $error = 'Vous aviez déjà changé votre mot de passe, vous pouvez vous connecter';
                $this->view->render('frontend/connect', 'loginview', ['error' => $error]);
                }
        }
        $error = 'Veuillez saisir votre identifiant et votre mot de passe';
        $this->view->render('frontend/connect', 'loginview', []);
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
        $this->home();
    }
    function allPost() // Chapo post list
    {
        $allPostChapo = $this->blogManager->allPost();
        $this->view->render('frontend', 'allPostView', ['allPostChapo' => $allPostChapo]);
    }
    function getComment($title, $content, $postId, $usersId)
    {
        $this->blogManager->addComment($title, $content, $postId, $usersId);
        $error = 'Votre commentaire est soumis à validation dn\'un modérateur, nous faisons au plus vite ...';
        $postnumber = $this->request->get('id');
        $this->longPost($postnumber);
    }

    function home() // homepage 3 last chapo post
    {
        $homePageChapo = $this->blogManager->lastPost();
        $this->view->render('frontend', 'templateFrontend', ['homePageChapo' => $homePageChapo]);
    }
    function longPost($postnumber) // Long Post view
    {
        $GetLongPost = $this->blogManager->getLongPost($postnumber); // affichage du post entier
        $listCommentToPost = $this->blogManager->postComment($postnumber); // affichage des commentaires validés
        $this->view->render('frontend', 'postView', ['getLongPost' => $GetLongPost, 'listCommentToPost' =>$listCommentToPost ]);
    }
    // end site page function
}
