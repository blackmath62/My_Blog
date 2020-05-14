<?php

namespace App\config;
require 'Parameter.php';
class Request
{
    private $get;
    private $post;
    private $session;

    public function __construct()
    {
        $this->get = new Parameter($_GET);
        $this->post = new Parameter($_POST);
        $this->session = $_SESSION;
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
    public function post($key){
        return $this->post->getter($key);
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }
}