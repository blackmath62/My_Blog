<?php

namespace App\config;

class Session
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

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

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function stop()
    {
        session_destroy();
    }

}