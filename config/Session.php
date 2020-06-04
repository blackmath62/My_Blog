<?php

namespace App\config;

class Session
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }
    // setters
    // Method de modification des valeurs de la classe
    public function setter($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /*getters
    Method de récupération des valeurs de la classe
    */
    public function getter($name)
    {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    public function show($name)
    {
        if(isset($_SESSION[$name]))
        {
            $key = $this->getter($name);
            $this->remove($name);
            return $key;
        }
    }

    public function remove()
    {
        session_unset();
    }

    public function stop()
    {
        session_destroy();
        session_start();
    }

}