<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace App\Model;
use App\Model\Manager;

class CommentManager extends Manager // la classe CommentManager hérite de Manager
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = $this->bddConnect();
    }

    public function commentReport($commentId,$validateId)
    {
        $treatmentDate = date("Y-m-d H:i:s");
        $changeStatusComment = $this->bdd->prepare('UPDATE comment SET validate_id = :validateId, treatment_date = :treatment_date WHERE comment_id = :commentId'); // on prépare l'insertion dans la BDD
        $changeStatus = $changeStatusComment->execute(array('validateId' => $validateId,'treatment_date'=> $treatmentDate, 'commentId' => $commentId)); // On insere dans la BDD 
        return $changeStatus;
    }
}