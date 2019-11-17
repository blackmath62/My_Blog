<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

require_once("Model/Manager.php");
class BlogManager extends Manager // la classe CommentManager hérite de Manager
{
    public function lastPost() {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $lastPostResult = $db->query("SELECT post_id, post_title, post_date, post_content, users_id, users.mail FROM users INNER JOIN post_list USING(users_id)ORDER BY post_date DESC LIMIT 3");
        return $lastPostResult;
        
    }
    public function getLongPost($postnumber) {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $longPostResult = $db->prepare("SELECT post_id, post_title, post_date, post_content, users_id, users.mail FROM users INNER JOIN post_list USING(users_id) WHERE post_id = ?");
        $longPostResult->execute(array($postnumber));
        $PostResult = $longPostResult->fetch();
        return $PostResult;
        
    }
    
    public function allPost() {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $allPostResult = $db->query("SELECT post_id, post_title, post_date, post_content, users_id, users.mail FROM users INNER JOIN post_list USING(users_id)ORDER BY post_date DESC");
        return $allPostResult;
        
    }
    
    public function addComment($title, $content, $postId,$usersId)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $req = $db->prepare('INSERT INTO comment(comment_title, comment_content, post_id, users_id ) VALUES(:title, :content, :id, :users)');
        $addcomment = $req->execute(array(
            'title' => $title,
            'content' => $content,
            'id' => $postId,
            'users' => $usersId    // C'EST L'ID UTILISATEUR QUI BLOQUE L'INTEGRATION
        ));
        return $addcomment;
    }

    public function changepass($idconnect, $hashnewpass, $cleartoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changepasstoken = $db->prepare('UPDATE users SET mdp = :newpass , token = :cleartoken WHERE users_id = :checkid'); // on prépare l'insertion dans la BDD
        $addtoken = $changepasstoken->execute(array('checkid' => $idconnect, 'newpass' => $hashnewpass, 'cleartoken' => $cleartoken)); // On insere dans la BDD 
        return $addtoken;
    }
  
}
