<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

require_once("Model/Manager.php");
class MemberManager extends Manager // la classe CommentManager hérite de Manager
{
        
    public function check_exist($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_profil = $db->prepare("SELECT * FROM law INNER JOIN users ON users.law_id = law.law_id WHERE users.mail = ? ");
        $check_profil->execute(array($mailconnect));
       
        return $check_profil;
    }
    public function check_id($idconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT * FROM users WHERE users.users_id = ? ");
        $check_id->execute(array($idconnect));

        return $check_id;
    }

    public function getconnect($mailconnect) 
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $userconnect = $db->prepare("SELECT users_id, mail,mdp,users.law_id FROM law INNER JOIN users ON users.law_id = law.law_id WHERE users.mail = ? ");
        $userconnect->execute(array($mailconnect));

        return $userconnect;
    }

    public function addRegister($mailconnect, $mdpconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $req = $db->prepare('INSERT INTO users(mail, mdp ) VALUES(:mail, :mdp)');
        $addregister = $req->execute(array(
            'mail' => $mailconnect,
            'mdp' => $mdpconnect,
            
        ));
        return $addregister;
    }

    public function getTokenpassforget($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $addtoken = $db->prepare('UPDATE users SET token = ? WHERE mail = ?'); // on prépare l'insertion dans la BDD

        return $addtoken;
    }
    public function changepass($idconnect, $hashnewpass, $cleartoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changepasstoken = $db->prepare('UPDATE users SET mdp = :newpass , token = :cleartoken WHERE users_id = :checkid'); // on prépare l'insertion dans la BDD
        $addtoken = $changepasstoken->execute(array('checkid' => $idconnect, 'newpass' => $hashnewpass, 'cleartoken' => $cleartoken)); // On insere dans la BDD 
        return $addtoken;
    }
    public function checkid($idconnect, $controltoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT * FROM users WHERE users_id = ? AND token = ? ");
        $check_id->execute(array($idconnect, $controltoken));

        return $check_id;
    }
    public function getUsersList()
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $checkUsersList = $db->query("SELECT * FROM law INNER JOIN users ON users.law_id = law.law_id");
        return $checkUsersList;
    }
    public function getLawList()
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $lawList = $db->query("SELECT * FROM law");
        return $lawList;
    }
    public function getChangeLawUser($idLaw,$idUser)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changeLawUser = $db->prepare('UPDATE users SET law_id = :law WHERE users_id = :user'); // on prépare l'insertion dans la BDD
        $getChangeLawUser = $changeLawUser->execute(array('law' => $idLaw, 'user' => $idUser)); // On insere dans la BDD 
        return $getChangeLawUser;
    }
}
