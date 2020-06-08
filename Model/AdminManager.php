<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace App\Model;
use App\Model\Manager;


class AdminManager extends Manager // la classe CommentManager hérite de Manager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = $this->bddConnect();
    }
    public function getUsersList()
    {
        $checkUsersList = $this->bdd->query("SELECT users.users_id, users.mail, users.Pseudo, users.law_id, users.create_date_users FROM law INNER JOIN users ON users.law_id = law.law_id");
        $getUsersList = $checkUsersList->fetchAll(\PDO::FETCH_OBJ);
        return $getUsersList;
    }
    public function getLawList()
    {
        $lawList = $this->bdd->query("SELECT * FROM law");
        return $lawList;
    }
    public function getChangeLawUser($idLaw, $idUser)
    {    
        $changeLawUser = $this->bdd->prepare('UPDATE users SET law_id = :law WHERE users_id = :user'); // on prépare l'insertion dans la BDD
        $getChangeLawUser = $changeLawUser->execute(array('law' => $idLaw, 'user' => $idUser)); // On insere dans la BDD 
        return $getChangeLawUser;
    }
    public function deleteUser($idUser)
    {  
        $req = $this->bdd->prepare('DELETE FROM users WHERE users_id = ?');
        $deleteUser = $req->execute(array($idUser));
        return $deleteUser;
    }
    public function newPost($title, $content, $usersId)
    { 
        $req = $this->bdd->prepare('INSERT INTO post_list(post_title, post_content, post_chapo, users_id ) VALUES(:title, :content, :chapo, :users)');
        $newPost = $req->execute(array(
            'title' => $title,
            'content' => $content,
            'chapo' => substr($content,0,200),
            'users' => $usersId
        ));
        return $newPost;
    }
    public function getChangePost($postnumber)
    {
        $ChangePost = $this->bdd->prepare("SELECT post_id, post_title, post_content FROM post_list where post_id = ?");
        $ChangePost->execute(array($postnumber));
        $getChangePost = $ChangePost->fetch();
        return $getChangePost;
    }
    public function updatePostNow($postnumber, $subject, $message)
    {
        $chapo = substr($message,0,200);
        $req = $this->bdd->prepare('UPDATE post_list SET post_title = :title ,post_content = :post, post_chapo = :chapo , modification_date = :changeDate WHERE post_id= :id');
        $updatePost = $req->execute(array('title' => $subject,'chapo' => $chapo, 'post' => $message, 'id' => $postnumber, 'changeDate' => date("Y-m-d H:i:s")));
        return $updatePost;
    } 
    public function deletePostNow($postnumber)
    {
        $req = $this->bdd->prepare('DELETE FROM post_list WHERE post_id = ?');
        $deletePost = $req->execute(array($postnumber));
        return $deletePost;
    }   
    public function commentReport($commentId,$validateId)
    {
        $treatmentDate = date("Y-m-d H:i:s");
        $changeStatusComment = $this->bdd->prepare('UPDATE comment SET validate_id = :validateId, treatment_date = :treatment_date WHERE comment_id = :commentId'); // on prépare l'insertion dans la BDD
        $changeStatus = $changeStatusComment->execute(array('validateId' => $validateId,'treatment_date'=> $treatmentDate, 'commentId' => $commentId)); // On insere dans la BDD 
        return $changeStatus;
    }
}
