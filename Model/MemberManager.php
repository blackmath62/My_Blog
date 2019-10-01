<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;
require_once("Model/Manager.php");
class MemberManager extends Manager // la classe CommentManager hérite de Manager
{
 
    public function check_exist($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_profil = $db->prepare("SELECT * FROM law_table INNER JOIN users_table ON users_table.law_id = law_table.law_id WHERE users_table.mail = ? "); 
        $check_profil->execute(array($mailconnect));

        return $check_profil;
        
    }
    public function check_id($idconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT * FROM users_table WHERE users_table.users_id = ? "); 
        $check_id->execute(array($idconnect));

        return $check_id;
        
    }

    public function getconnect($mailconnect) // la partie connexion est bonne ne plus toucher
    {      
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $userconnect = $db->prepare("SELECT mail,mdp,law_id FROM law_table INNER JOIN users_table ON users_table.law_id = law_table.law_id WHERE users_table.mail = ? "); 
        $userconnect->execute(array($mailconnect));
        
        return $userconnect;
    }

    public function addRegister($mailconnect,$mdpconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $req = $db->prepare('INSERT INTO users_table(mail, mdp) VALUES(:mail, :mdp)');
        $addregister = $req->execute(array(
            'mail' => $mailconnect,
            'mdp' => $mdpconnect,
            ));
        return $addregister;
    }

    public function getTokenpassforget($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $addtoken = $db->prepare('UPDATE users_table SET token = ? WHERE mail = ?'); // on prépare l'insertion dans la BDD

        return $addtoken;
    }
    public function changepass($idconnect,$hashnewpass, $cleartoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changepasstoken = $db->prepare('UPDATE users_table SET mdp = :newpass , token = :cleartoken WHERE users_id = :checkid'); // on prépare l'insertion dans la BDD
        $addtoken = $changepasstoken->execute(array('checkid' => $idconnect,'newpass' => $hashnewpass, 'cleartoken' => $cleartoken)); // On insere dans la BDD 
        return $addtoken;
    }
    public function checkid($idconnect,$controltoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT * FROM users_table WHERE users_id = ? AND token = ? "); 
        $check_id->execute(array($idconnect,$controltoken));

        return $check_id;
    }
  


