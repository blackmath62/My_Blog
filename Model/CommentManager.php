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
    public function numberCommentReport(){
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $numberReport = $db->prepare("SELECT post_id from report_comment");
        $numberReport->execute(array());
        return $numberReport;
    }
    public function numberCommentWait(){
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $numberWait = $db->prepare("SELECT post_id from comment WHERE validate_id = 1");
        $numberWait->execute(array());
        return $numberWait;
    }
    public function checkUserReport($usersId, $postnumber){ // Vu utilisateur, pour les commentaires qu'il a signalé
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $checkUserReport = $db->prepare("SELECT comment_id from report_comment WHERE users_id = ? AND post_id = ? ORDER BY comment_id");
        $checkUserReport->execute(array($usersId, $postnumber));
        return $checkUserReport;
    }
    public function checkAllReport($postnumber){ // Liste de tous les signalements de commentaires
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $checkAllReport = $db->prepare("SELECT comment_id from report_comment WHERE post_id = ? ORDER BY comment_id");
        $checkAllReport->execute(array($postnumber));
        return $checkAllReport;
    }
    public function removeReport($usersId, $postnumber, $commentId){
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $deleteReport = $db->prepare("DELETE from report_comment WHERE users_id = ? AND post_id = ? AND comment_id = ?");
        $deleteReport->execute(array($usersId, $postnumber, $commentId));
        return $deleteReport;
    }
    
    // todo voir si cette fonction est utile
    public function commentInfo($postnumber){
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $allComment = $db->prepare("SELECT comment.comment_id, comment.comment_title, comment.comment_date, comment.comment_content,
        comment.post_id, comment.users_id, comment.validate_id, comment.treatment_date,
        CASE 
        WHEN comment.comment_id = report_comment.comment_id THEN COUNT(report_comment.comment_id)
        END AS numberReport
        FROM comment
        INNER JOIN report_comment ON report_comment.post_id = comment.post_id
        WHERE comment.post_id = ?
        GROUP BY comment.comment_id, comment.comment_title, comment.comment_date, comment.comment_content,
        comment.post_id, comment.users_id, comment.validate_id, comment.treatment_date
        ORDER BY comment_date");
        $allComment->execute(array($postnumber));
        $getAllComment = $allComment->fetchAll(\PDO::FETCH_CLASS,'Comment');
        return $getAllComment;
    }
    

}