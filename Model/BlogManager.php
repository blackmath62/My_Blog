<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

require_once("Model/Manager.php");
class BlogManager extends Manager // la classe CommentManager hérite de Manager
{
    public function rqblog() {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_profil = $db->query("SELECT post_id, post_title, post_date, post_content, users_id, users.mail FROM users INNER JOIN post_list USING(users_id)ORDER BY post_date DESC LIMIT 3");
        return $check_profil;
        
    }
    
    public function check_exist($mailconnect)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $check_profil = $db->prepare("SELECT * FROM law INNER JOIN users ON users.law_id = law.law_id WHERE users.mail = ? ");
        $check_profil->execute(array($mailconnect));

        return $check_profil;
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

    public function changepass($idconnect, $hashnewpass, $cleartoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changepasstoken = $db->prepare('UPDATE users SET mdp = :newpass , token = :cleartoken WHERE users_id = :checkid'); // on prépare l'insertion dans la BDD
        $addtoken = $changepasstoken->execute(array('checkid' => $idconnect, 'newpass' => $hashnewpass, 'cleartoken' => $cleartoken)); // On insere dans la BDD 
        return $addtoken;
    }
  
}
