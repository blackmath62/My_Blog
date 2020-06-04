<?php

namespace App\Controller;

use App\Model\MemberManager;
use App\Model\BlogManager;
use App\Model\CommentManager;
use App\Entity\Member;
use App\config\Request;
use App\Entity\View;

class ControllerBackend
{
    private $view;
    function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->getRegister = new MemberManager();
        $this->user = new Member;
        $this->blogManager = new BlogManager();
        $this->commentManager = new CommentManager();
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

    function frontendListingPost()
    {
        $frontendListPost = $this->blogManager->allPost();
        $this->view->render('backend', 'listingPost', ['frontendListPost' => $frontendListPost]);
    }
    function frontendListingComment()
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
        $this->frontendListingPost();
    }
    function deletePost($postnumber)
    {
        $this->blogManager->deletePostNow($postnumber);
        $this->frontendListingPost();
    }
    function usersList()
    {
        $allLaw = $this->getRegister->getLawList();
        $allUsers = $this->getRegister->getUsersList();
        $this->view->render('backend', 'usersList', ['allLaw' => $allLaw, 'allUsers' => $allUsers]);
    }

    function ChangeLawUser($idLaw, $idUser)
    {
        $this->getRegister->getChangeLawUser($idLaw, $idUser);
        $this->getRegister->getLawList();
        $this->usersList();
    }

    function deleteUser($idUser)
    {
        $this->getRegister->deleteUser($idUser);
        $this->getRegister->getLawList();
        $this->usersList();
    }

    function changeStatusComment($commentId, $validateId) // Long Post view
    {
        $this->commentManager->commentReport($commentId, $validateId); // affichage du post entier
        $this->frontendListingComment();
    }

    // end site page function
}
