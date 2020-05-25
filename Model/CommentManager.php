<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace App\Model;

require_once("Model/Manager.php");
class CommentManager extends Manager // la classe CommentManager hérite de Manager
{
    public function commentReport($commentId,$validateId)
    {
        $bdd = $this->bddConnect(); // la base de donnée de l'objet courant
        $treatmentDate = date("Y-m-d H:i:s");
        $changeStatusComment = $bdd->prepare('UPDATE comment SET validate_id = :validateId, treatment_date = :treatment_date WHERE comment_id = :commentId'); // on prépare l'insertion dans la BDD
        $changeStatus = $changeStatusComment->execute(array('validateId' => $validateId,'treatment_date'=> $treatmentDate, 'commentId' => $commentId)); // On insere dans la BDD 
        return $changeStatus;
    }
}