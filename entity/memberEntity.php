<?php

use memberSpace\Model\MemberManager;

class Member extends MemberManager
{
  /*Propriétés de ma classe member */
  private $users_id;
  private $mail;
  private $Pseudo;
  private $users_name;
  private $users_last_name;
  private $mdp;
  private $law_id;
  private $img_users;
  private $token;
  private $create_date_users;

// todo voir avec antoine pour ramener les objets sur le memberManager via l'hydratation
// permet d'eviter de les remplir manuellement
/*
public function hydrate(array $donnees)
{
  foreach ($donnees as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}
*/
  /*getters
    Method de récupération des valeurs de la classe
    */
  public function users_id(){return $this->users_id;}
  public function mail(){return htmlspecialchars($this->mail);}
  public function pseudo(){return htmlspecialchars($this->Pseudo);}
  public function users_name(){return htmlspecialchars($this->users_name);}
  public function users_last_name(){return htmlspecialchars($this->users_last_name);}
  public function mdp(){return $this->mdp;}
  public function img_users(){return $this->img_users;}
  public function token(){return $this->token;}
  public function create_date_users(){return $this->create_date_users;}
  public function law_id(){return $this->law_id;}

  // setters
  // Method de modification des valeurs de la classe
  public function setUsersId($usersId)// On vérifie qu'il s'agit bien d'un entier.
  {$usersId = (int) $usersId;if($usersId > 0){$this->users_id = $usersId;}}

  public function setPseudo($pseudo)// On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($pseudo)) {$this->pseudo = $pseudo;}}

  public function setUsersName($usersName)// On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($usersName)) {$this->users_name = $usersName;}}

  public function setUsersLastName($usersLastName)// On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($usersLastName)) {$this->users_last_name = $usersLastName;}}

  public function setMdp($mdp) // On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($mdp)) {$this->mdp = $mdp;}}

  public function setImgUsers($imgUsers) // On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($imgUsers)) {$this->img_users = $imgUsers;}}

  public function setToken($token)// On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($token)) {$this->token = $token;}}

  public function setCreateDateUsers($createDateUsers)
  {$this->create_date_users = $createDateUsers;}

  public function setMail($mail) // On vérifie qu'il s'agit bien d'une chaîne de caractères.
  {if (is_string($mail)) {$this->mail = $mail;}}

  public function setLawId($lawId) // On vérifie qu'il s'agit bien d'un entier.
  {$lawId = (int) $lawId;if($lawId > 0 ){$this->law_id = $lawId;}}
  
  
  // todo avec Antoine pour voir si je m'y prends bien
  public function deleteUser($users_id){

  }

}
