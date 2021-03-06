<?php
namespace App\Entity;
class Autoloader{

    static function registerAutoload(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    static function autoload($class){
        
        $class = str_replace('App\\' ,'',$class);
        $class = str_replace('\\', '/', $class);
        require $class . '.php';
    }

}