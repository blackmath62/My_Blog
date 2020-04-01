<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

require_once("Model/Manager.php");
class MemberManager extends Manager // la classe CommentManager hérite de Manager
{
    public function checkMailExist($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $checkMail = $db->prepare("SELECT users.mail,users.users_id, law.law_id, users.mdp 
        FROM law 
        INNER JOIN users ON users.law_id = law.law_id 
        WHERE (users.mail = ?) ");
        $checkMail->execute(array($mailconnect));
        $exec = $checkMail->fetch();
        return $exec;
    }
    public function checkPseudoExist($pseudo)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $checkPseudo = $db->prepare("SELECT Pseudo FROM users WHERE Pseudo = ?");
        $checkPseudo->execute(array($pseudo));
        return $checkPseudo;
    }
    public function check_id($idconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT users_id FROM users WHERE users_id = ? ");
        $check_id->execute(array($idconnect));

        return $check_id;
    }
    // todo contrôler checkid doublon
    public function checkid($idconnect, $controltoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT mail, users_id, token FROM users WHERE users_id = ? AND token = ? ");
        $check_id->execute(array($idconnect, $controltoken));

        return $check_id;
    }

    public function getconnect($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $userconnect = $db->prepare("SELECT users_id, mail,mdp,users.law_id FROM law INNER JOIN users ON users.law_id = law.law_id WHERE users.mail = ? ");
        $userconnect->execute(array($mailconnect));

        return $userconnect;
    }

    public function addRegister($mailconnect, $pseudo, $mdpconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $req = $db->prepare('INSERT INTO users(mail, pseudo, mdp ) VALUES(:mail, :pseudo, :mdp)');
        $addregister = $req->execute(array(
            'mail' => $mailconnect,
            'mdp' => $mdpconnect,
            'pseudo' => $pseudo,

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

    public function getUsersList()
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $checkUsersList = $db->query("SELECT users.users_id, users.mail, users.law_id, users.create_date_users FROM law INNER JOIN users ON users.law_id = law.law_id");
        $getUsersList = $checkUsersList->fetchAll(\PDO::FETCH_CLASS,'Member');
        return $getUsersList;
    }
    public function getLawList()
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $lawList = $db->query("SELECT * FROM law");
        return $lawList;
    }
    public function getChangeLawUser($idLaw, $idUser)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changeLawUser = $db->prepare('UPDATE users SET law_id = :law WHERE users_id = :user'); // on prépare l'insertion dans la BDD
        $getChangeLawUser = $changeLawUser->execute(array('law' => $idLaw, 'user' => $idUser)); // On insere dans la BDD 
        return $getChangeLawUser;
    }
    public function deleteUser($idUser)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant     
        $req = $db->prepare('DELETE FROM users WHERE users_id = ?');
        $deleteUser = $req->execute(array($idUser));
        return $deleteUser;
    }
}
