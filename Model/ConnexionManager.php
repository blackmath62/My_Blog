<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace App\Model;
use App\Model\Manager;


class ConnexionManager extends Manager // la classe CommentManager hérite de Manager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = $this->bddConnect();
    }

    public function checkMailExist($mailconnect)
    {
        $checkMail = $this->bdd->prepare("SELECT users.mail,users.users_id, law.law_id, users.mdp 
        FROM law 
        INNER JOIN users ON users.law_id = law.law_id 
        WHERE (users.mail = ?) ");
        $checkMail->execute(array($mailconnect));
        $exec = $checkMail->fetch();
        return $exec;
    }
    public function checkPseudoExist($pseudo)
    {
        $checkPseudo = $this->bdd->prepare("SELECT Pseudo FROM users WHERE Pseudo = ?");
        $checkPseudo->execute(array($pseudo));
        return $checkPseudo;
    }

    public function check_id($idconnect, $controltoken)
    {
        $check_id = $this->bdd->prepare("SELECT mail, users_id, token FROM users WHERE users_id = ? AND token = ? ");
        $check_id->execute(array($idconnect, $controltoken));

        return $check_id;
    }

    public function getconnect($mailconnect)
    {
        $userconnect = $this->bdd->prepare("SELECT users_id, mail,mdp,users.law_id FROM law INNER JOIN users ON users.law_id = law.law_id WHERE users.mail = ? ");
        $userconnect->execute(array($mailconnect));

        return $userconnect;
    }

    public function addRegister($mailconnect, $pseudo, $mdpconnect)
    {     
        $req = $this->bdd->prepare('INSERT INTO users(mail, pseudo, mdp ) VALUES(:mail, :pseudo, :mdp)');
        $addregister = $req->execute(array(
            'mail' => $mailconnect,
            'mdp' => $mdpconnect,
            'pseudo' => $pseudo,

        ));
        return $addregister;
    }

    public function getTokenpassforget($mailconnect)
    {    
        $addtoken = $this->bdd->prepare('UPDATE users SET token = ? WHERE mail = ?'); // on prépare l'insertion dans la BDD

        return $addtoken;
    }
    public function changepass($idconnect, $hashnewpass, $cleartoken)
    {
        $changepasstoken = $this->bdd->prepare('UPDATE users SET mdp = :newpass , token = :cleartoken WHERE users_id = :checkid'); // on prépare l'insertion dans la BDD
        $addtoken = $changepasstoken->execute(array('checkid' => $idconnect, 'newpass' => $hashnewpass, 'cleartoken' => $cleartoken)); // On insere dans la BDD 
        return $addtoken;
    }

}
