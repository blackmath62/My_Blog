<?php

namespace App\Entity;
use App\Model\CommentManager;
class Comment extends CommentManager
{
  /*Propriétés de ma classe member */
  private $comment_id;
  private $comment_title;
  private $comment_date;
  private $comment_content;
  private $post_id;
  private $users_id;
  private $validate_id;
  private $treatment_date;
  
  /*getters
    Method de récupération des valeurs de la classe 
    */
  public function comment_id(){return $this->comment_id;}
  public function comment_title(){return $this->comment_title;}
  public function comment_date(){return $this->comment_date;}
  public function comment_content(){return $this->comment_content;}
  public function post_id(){return $this->post_id;}
  public function users_id(){return $this->users_id;}
  public function validate_id(){return $this->validate_id;}
  public function treatment_date(){return $this->treatment_date;}
  
  // setters
  // Method de modification des valeurs de la classe
  public function setCommentId($commentId)// On vérifie qu'il s'agit bien d'un entier.
  {$commentId = (int) $commentId;if($commentId > 0){$this->comment_id = $commentId;}}

  public function setCommentTitle($comment_title) // On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($comment_title)) {$this->comment_title = $comment_title;}}

  public function setCommentDate($commentDate)
  {$this->comment_date = $commentDate;}

  public function setcommentContent($comment_content) // On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($comment_content)) {$this->comment_content = $comment_content;}}

  public function setPostId($postId)// On vérifie qu'il s'agit bien d'un entier.
  {$postId = (int) $postId;if($postId > 0){$this->post_id = $postId;}}

  public function setUsersId($usersId)// On vérifie qu'il s'agit bien d'un entier.
  {$usersId = (int) $usersId;if($usersId > 0){$this->users_id = $usersId;}}

  public function setValidateId($validateId)// On vérifie qu'il s'agit bien d'un entier.
  {$validateId = (int) $validateId;if($validateId > 0){$this->validate_id = $validateId;}}

  public function setTreatmentDate($treatmentDate)
  {$this->treatment_date = $treatmentDate;}

}
