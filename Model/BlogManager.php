<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

require_once("Model/Manager.php");
class BlogManager extends Manager // la classe CommentManager hérite de Manager
{   
    public function lastPost() // affichage des 3 derniers chapos pour la page d'accueil
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $lastPostResult = $db->query("SELECT post_id, post_title, post_date,post_chapo, post_content, users_id, users.mail, users.Pseudo FROM users INNER JOIN post_list USING(users_id)ORDER BY post_date DESC LIMIT 3");
        $getlastPostResult = $lastPostResult->fetchAll(\PDO::FETCH_CLASS,'Blog');
        return $getlastPostResult;
    }

    public function allPost() // affichage de tous les chapos des posts
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $allPostResult = $db->query("SELECT post_id, post_title, post_date,post_chapo, post_content, users_id, users.mail, users.Pseudo, modification_date FROM users INNER JOIN post_list USING(users_id)ORDER BY post_date DESC");
        $getAllPostResult = $allPostResult->fetchAll(\PDO::FETCH_CLASS,'Blog');
        return $getAllPostResult;
    }

    public function postComment($postnumber) // affichage pour l'utilisateur des commentaires validés
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $lastComment = $db->prepare("SELECT comment_id, comment_title, comment_date, comment_content, users_id, users.mail, validate_id FROM users INNER JOIN COMMENT USING(users_id) where post_id = ? AND validate_id = 2  ORDER BY comment_date LIMIT 6");
        $lastComment->execute(array($postnumber));
        return $lastComment;
    }
    public function getChangePost($postnumber)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $ChangePost = $db->prepare("SELECT post_title, post_content FROM post_list where post_id = ?");
        $ChangePost->execute(array($postnumber));
        $getChangePost = $ChangePost->fetch();
        return $getChangePost;
    }
    public function getLongPost($postnumber)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $longPostResult = $db->prepare("SELECT post_id, post_title, post_date,post_chapo, post_content, users_id, users.mail, modification_date FROM users INNER JOIN post_list USING(users_id) WHERE post_id = ?");
        $longPostResult->execute(array($postnumber));
        $postResult = $longPostResult->fetchObject('Blog');
        return $postResult;
    }

    public function addComment($title, $content, $postId, $usersId)
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
    public function newPost($title, $content, $usersId)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $req = $db->prepare('INSERT INTO post_list(post_title, post_content, post_chapo, users_id ) VALUES(:title, :content, :chapo, :users)');
        $newPost = $req->execute(array(
            'title' => $title,
            'content' => $content,
            'chapo' => substr($content,0,200),
            'users' => $usersId    // C'EST L'ID UTILISATEUR QUI BLOQUE L'INTEGRATION
        ));
        return $newPost;
    }
    public function deletePostNow($postnumber)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant     
        $req = $db->prepare('DELETE FROM post_list WHERE post_id = ?');
        $deletePost = $req->execute(array($postnumber));
        return $deletePost;
    }
    public function updatePostNow($subject, $message, $postnumber)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant   
        $chapo = substr($message,0,200);
        $req = $db->prepare('UPDATE post_list SET post_title = :title ,post_content = :post, post_chapo = :chapo , modification_date = :changeDate WHERE post_id= :id');
        $updatePost = $req->execute(array('title' => $subject,'chapo' => $chapo, 'post' => $message, 'id' => $postnumber, 'changeDate' => date("Y-m-d H:i:s")));
        return $updatePost;
    }

    public function changepass($idconnect, $hashnewpass, $cleartoken)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant        
        $changepasstoken = $db->prepare('UPDATE users SET mdp = :newpass , token = :cleartoken WHERE users_id = :checkid'); // on prépare l'insertion dans la BDD
        $addtoken = $changepasstoken->execute(array('checkid' => $idconnect, 'newpass' => $hashnewpass, 'cleartoken' => $cleartoken)); // On insere dans la BDD 
        return $addtoken;
    }
    
}