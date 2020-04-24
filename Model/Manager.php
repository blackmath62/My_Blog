<?php
// La classe sera dans ce namespace, cela permet d'utiliser plusieurs fois le même nom de classe
namespace memberSpace\Model;

// manager, il sert a faire la connexion à la BDD

class Manager // Déclaration de la classe Manager
{
    protected function bddConnect()
    {
        try{ // php execute le code dans try
        
        $bdd = new \PDO('mysql:host=localhost;dbname=my_blog;charset=utf8', 'root', ''); // on appel à la BDD
        return $bdd;
        }
            // en cas d'erreur il execute le code contenu dans catch voir cours orienté objet
            catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
            }
    }
}
?>