<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

require_once("Model/Manager.php");
class CommentManager extends Manager // la classe CommentManager hérite de Manager
{
    public function commentReport()
    {
        $bdd = $this->bddConnect(); // la base de donnée de l'objet courant
        $commentId = $_GET['id'];
        $validateId = $_GET['modification'];
        $changeStatusComment = $bdd->prepare('UPDATE comment SET validate_id = :validateId WHERE comment_id = :commentId'); // on prépare l'insertion dans la BDD
        $changeStatus = $changeStatusComment->execute(array('validateId' => $validateId, 'commentId' => $commentId)); // On insere dans la BDD 
        return $changeStatus;
    }
}