<?php

namespace App\config;
use App\config\Parameter;
use App\config\Session;
class Request
{
    private $get;
    private $post;
    private $session;

    public function __construct()
    {
        $this->get = new Parameter($_GET);
        $this->post = new Parameter($_POST);
        $this->session = new Session($_SESSION);
    }

    /**
     * @return mixed
     */
    public function getGet()
    {
        return $this->get;
    }
    public function get($key){
        return $this->get->getter($key);
    }
   

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }
    public function post($key){
        return $this->post->getter($key);
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }
    public function session($key){
        return $this->session->getter($key);
    }
}