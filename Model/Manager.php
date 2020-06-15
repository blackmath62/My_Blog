<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace App\Model;
use PDO;
use Exception;
// manager, il sert a faire la connexion à la BDD

class Manager // Déclaration de la classe Manager
{
    protected function bddConnect()
    {        
        $bdd = new PDO('mysql:host=localhost;dbname=my_blog;charset=utf8', 'root', ''); // on appel à la BDD
        return $bdd;
    }
}
?>