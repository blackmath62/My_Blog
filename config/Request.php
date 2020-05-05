<?php


class Request
{
    private $get;
    private $post;
    private $session;

    public function __construct()
    {
        $this->get = htmlspecialchars($_GET);
        $this->post = htmlspecialchars($_POST);
        $this->session = htmlspecialchars($_SESSION);
    }

    /**
     * @return mixed
     */
    public function getGet()
    {
        return $this->get;
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