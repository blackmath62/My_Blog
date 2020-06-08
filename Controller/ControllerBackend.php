<?php

namespace App\Controller;

use App\Model\ConnexionManager;
use App\Model\BlogManager;
use App\Model\CommentManager;
use App\Entity\Member;
use App\config\Request;
use App\Entity\View;
use App\Model\AdminManager;

class ControllerBackend
{
    private $view;
    function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->connexionManager = new ConnexionManager();
        $this->user = new Member;
        $this->blogManager = new BlogManager();
        $this->commentManager = new CommentManager();
        $this->adminManager = new AdminManager();
    }

    function getAdmin()
    {
        $this->view->render('backend', 'backendHome', []);
    }

    function newPost($title, $content, $usersId)
    {
        $newPost = $this->blogManager->newPost($title, $content, $usersId);
        $this->view->render('backend', 'newPost', ['newPost' => $newPost]);
    }
    function viewNewPost()
    {
        $this->view->render('backend', 'newPost', []);
    }

    function listingPost()
    {
        $ListPosts = $this->blogManager->allPost();
        $this->view->render('backend', 'listingPost', ['ListPosts' => $ListPosts]);
    }
    function listingComment()
    {
        $allComment = $this->blogManager->allComment();
        $this->view->render('backend', 'listingComment', ['allComment' => $allComment]);
    }

    function changePost($postnumber)
    {
        $changePost = $this->blogManager->getChangePost($postnumber);
        $this->view->render('backend', 'changePost', ['changePost' => $changePost]);
    }
    function updatePost($postnumber, $subject, $message)
    {
        $this->blogManager->updatePostNow($postnumber, $subject, $message);
        $this->listingPost();
    }
    function deletePost($postnumber)
    {
        $this->blogManager->deletePostNow($postnumber);
        $this->listingPost();
    }
    function usersList()
    {
        $allLaw = $this->adminManager->getLawList();
        $allUsers = $this->adminManager->getUsersList();
        $this->view->render('backend', 'usersList', ['allLaw' => $allLaw, 'allUsers' => $allUsers]);
    }

    function ChangeLawUser($idLaw, $idUser)
    {
        $this->adminManager->getChangeLawUser($idLaw, $idUser);
        $this->adminManager->getLawList();
        $this->usersList();
    }

    function deleteUser($idUser)
    {
        $this->adminManager->deleteUser($idUser);
        $this->adminManager->getLawList();
        $this->usersList();
    }

    function changeStatusComment($commentId, $validateId) // Long Post view
    {
        $this->commentManager->commentReport($commentId, $validateId); // affichage du post entier
        $this->listingComment();
    }

    // end site page function
}
