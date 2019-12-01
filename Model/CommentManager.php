<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

require_once("Model/Manager.php");
class CommentManager extends Manager // la classe CommentManager hérite de Manager
{
    public function commentReport($usersId, $postnumber, $commentId)
    {
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $addReport = $db->prepare("INSERT INTO report_comment (users_id, comment_id, post_id) VALUES (?,?,?)");
        $addReport->execute(array($usersId, $commentId, $postnumber));
        return $addReport;
    }
    

}