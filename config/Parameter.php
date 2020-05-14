<?php

namespace App\config;

class Parameter
{
    private $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    public function getter($name)
    {
        if(isset($this->parameter[$name]))
        {
            return $this->parameter[$name];
        }
    }
    
    public function setter($name, $value)
    {
        $this->parameter[$name] = $value;
    }
    
}