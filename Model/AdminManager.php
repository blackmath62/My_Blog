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
}
