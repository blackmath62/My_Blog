<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;
require_once("Model/Manager.php");
class MemberManager extends Manager // la classe CommentManager hérite de Manager
{
 
    public function check_exist($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_profil = $db->prepare("SELECT * FROM profil INNER JOIN users ON users.id_group = profil.id WHERE users.mail = ? "); 
        $check_profil->execute(array($mailconnect));

        return $check_profil;
        
    }
    public function check_id($idconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT * FROM users WHERE users.id = ? "); 
        $check_id->execute(array($idconnect));

        return $check_id;
        
    }

    public function getconnect($mailconnect) // la partie connexion est bonne ne plus toucher
    {      
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $userconnect = $db->prepare("SELECT mail,mdp,type_profil FROM profil INNER JOIN users ON users.id_group = profil.id WHERE users.mail = ? "); 
        $userconnect->execute(array($mailconnect));
        
        return $userconnect;
    }

    public function addRegister($mailconnect,$mdpconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $req = $db->prepare('INSERT INTO users(mail, mdp) VALUES(:mail, :mdp)');
        $addregister = $req->execute(array(
            'mail' => $mailconnect,
            'mdp' => $mdpconnect,
            ));
        //$adduser->bindParam(1, $mailconnect); 
        //$adduser->bindParam(2, $mdpconnect);
        //$adduser->bindParam(3, 3);
        //var_dump($adduser); // affiche la valeur d'une variable, comme le console log
        //die(); // arrête le procecuss
        return $addregister;
    }

    public function getTokenpassforget($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $addtoken = $db->prepare('UPDATE users SET Token = ? WHERE mail = ?'); // on prépare l'insertion dans la BDD

        return $addtoken;
    }
    public function changepass($idconnect,$hashnewpass, $cleartoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changepasstoken = $db->prepare('UPDATE users SET mdp = :newpass , Token = :cleartoken WHERE id = :checkid'); // on prépare l'insertion dans la BDD
        $addtoken = $changepasstoken->execute(array('checkid' => $idconnect,'newpass' => $hashnewpass, 'cleartoken' => $cleartoken)); // On insere dans la BDD 
        return $addtoken;
    }
    public function checkid($idconnect,$controltoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_id = $db->prepare("SELECT * FROM users WHERE id = ? AND Token = ? "); 
        $check_id->execute(array($idconnect,$controltoken));

        return $check_id;
    }
    public function listConnect($ip , $mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $list_Connect = $db->prepare('UPDATE users SET ip = :ip WHERE mail = :mail'); // on prépare l'insertion dans la BDD
        $majIp = $list_Connect->execute(array('ip' => $ip,'mail' => $mailconnect)); // On insere dans la BDD 
        return $majIp;
    }
}


