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
        $numberWait = $db->prepare("SELECT validate_id from comment");
        $numberWait->execute(array());
        return $numberWait;
    }
    public function checkAllreadyReport($usersId, $postnumber){
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $checkAllreadyReport = $db->prepare("SELECT comment_id from report_comment WHERE users_id = ? AND post_id = ? ORDER BY comment_id");
        $checkAllreadyReport->execute(array($usersId, $postnumber));
        return $checkAllreadyReport;
    }
    public function removeReport($usersId, $postnumber, $commentId){
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $deleteReport = $db->prepare("DELETE from report_comment WHERE users_id = ? AND post_id = ? AND comment_id = ?");
        $deleteReport->execute(array($usersId, $postnumber, $commentId));
        return $deleteReport;
    }
    public function searchCommentWaitValidation(){
        $db = $this->dbConnect(); // la base de donnée de l'objet courant
        $CommentWaitValidation = $db->prepare("SELECT * from comment WHERE validate_id <> 2 ORDER BY comment_date DESC");
        $CommentWaitValidation->execute(array());
        return $CommentWaitValidation;
    }
    

}