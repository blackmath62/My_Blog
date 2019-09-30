<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); // Afficher plus d'erreur a retirer pour la mise en prod

// le fichier index, il s'agit du routeur qui va chercher les informations en fonction des données
// ce fichier renomme correctement la barre d'adresse
// a le même effet qu'include, c'est à dire pour ramener une page mais à l'avantage de ne rien renvoyer en cas d'erreur

require('controler/frontendControler.php');
if (isset($_GET['action'])) {
        switch ($_GET['action']) {
                case 'connexion':
                        connexion();
                        break;                
        }
} else {
        pageNoFound();
}
