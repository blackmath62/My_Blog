<?php
namespace App\Entity;
class Autoloader{

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    static function autoload($class){
        
        $class = str_replace('App\\' ,'',$class);
        require $class . '.php';
    }

}