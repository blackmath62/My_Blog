<?php
class Blog
{
  /*Propriétés de ma classe member */
  private $post_id;
  private $post_title;
  private $users_id;
  private $post_date;
  private $post_content;
  private $modification_date;
  
  /*getters
    Method de récupération des valeurs de la classe
    */
  public function post_id(){return $this->post_id;}
  public function post_title(){return $this->post_title;}
  public function users_id(){return $this->users_id;}
  public function post_date(){return $this->post_date;}
  public function post_content(){return $this->post_content;}
  public function modification_date(){return $this->modification_date;}
  
  // setters
  // Method de modification des valeurs de la classe
  public function setPostId($post_id) // On vérifie qu'il s'agit bien d'un entier.
  {$postId = (int) $post_id;if($postId > 0){$this->post_id = $postId;}}

  public function setPostTitle($post_title) // On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($post_title)) {$this->post_title = $post_title;}}
  
  public function setUsersId($users_id) // On vérifie qu'il s'agit bien d'un entier.
  {$usersId = (int) $users_id;if($usersId > 0){$this->users_id = $usersId;}}

  public function setPostDate($postDate)
  {$this->post_date = $postDate;}

  public function setPostContent($post_content) // On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($post_content)) {$this->post_content = $post_content;}}

  public function setModificationDate($modificationDate)
  {$this->modification_date = $modificationDate;}

}
