<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace App\Model;
use App\Model\Manager;

class BlogManager extends Manager // la classe CommentManager hérite de Manager
{   
    private $bdd;

    public function __construct()
    {
        $this->bdd =  $this->bddConnect();
    }


    public function lastPost() // affichage des 3 derniers chapos pour la page d'accueil
    {
        $lastPostResult = $this->bdd->query("SELECT post_id, post_title, post_date,post_chapo, post_content, users_id,users.Pseudo, users.mail, users.Pseudo FROM users INNER JOIN post_list USING(users_id)ORDER BY post_date DESC LIMIT 3");
        $getlastPostResult = $lastPostResult->fetchAll(\PDO::FETCH_OBJ);
        return $getlastPostResult;
    }

    public function allPost() // affichage de tous les chapos des posts
    {
        $allPostResult = $this->bdd->query("SELECT post_id, post_title, post_date,post_chapo, post_content, users_id, users.mail, users.Pseudo, modification_date FROM users INNER JOIN post_list USING(users_id)ORDER BY post_date DESC");
        $getAllPostResult = $allPostResult->fetchAll(\PDO::FETCH_OBJ);
        return $getAllPostResult;
    }
    public function allComment() // affichage de tous les chapos des posts
    {
        $allCommentResult = $this->bdd->query("SELECT comment_id, comment_title, comment_date, comment_content, users_id, users.Pseudo, treatment_date,validate_id, validation_label 
        FROM users 
        INNER JOIN comment USING(users_id)
        INNER JOIN comment_validation USING(validate_id)
        ORDER BY comment_date DESC");
        $getAllCommentResult = $allCommentResult->fetchAll(\PDO::FETCH_OBJ);
        return $getAllCommentResult;
    }

    public function postComment($postnumber) // affichage pour l'utilisateur des commentaires validés
    {
        $lastComment = $this->bdd->prepare("SELECT comment_id, comment_title, comment_date, comment_content, users_id, users.Pseudo, users.mail, validate_id FROM users INNER JOIN COMMENT USING(users_id) where post_id = ? AND validate_id = 2  ORDER BY comment_date LIMIT 6");
        $lastComment->execute(array($postnumber));
        $listComment = $lastComment->fetchAll(\PDO::FETCH_OBJ);
        return $listComment;
    }
    public function getLongPost($postnumber)
    {
        $longPostResult = $this->bdd->prepare("SELECT post_id, post_title, post_date,post_chapo,users.Pseudo, post_content, users_id, users.mail, modification_date FROM users INNER JOIN post_list USING(users_id) WHERE post_id = ?");
        $longPostResult->execute(array($postnumber));
        $postResult = $longPostResult->fetch(\PDO::FETCH_OBJ);
        return $postResult;
    }

    public function addComment($title,$content, $postId, $usersId)
    {   
        $req = $this->bdd->prepare('INSERT INTO comment(comment_title, comment_content, post_id, users_id ) VALUES(:title, :content, :id, :users)');
        $addcomment = $req->execute(array(
            'title' => $title,
            'content' => $content,
            'id' => $postId,
            'users' => $usersId    // C'EST L'ID UTILISATEUR QUI BLOQUE L'INTEGRATION
        ));
        return $addcomment;
    }
}