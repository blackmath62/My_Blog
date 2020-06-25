<?php

namespace App\Controller;

use App\Model\BlogManager;
use App\Entity\View;
use App\Model\AdminManager;
use App\Entity\Session;

class ControllerBackend
{
    private $view;
    function __construct()
    {
        $this->view = new View();
        $this->blogManager = new BlogManager();
        $this->adminManager = new AdminManager();
        $this->session = new Session();
    }

    function getAdmin()
    {
        $this->view->render('backend', 'backendHome', []);
    }

    function newPost($title, $content, $usersId)
    {
        $newPost = $this->adminManager->newPost($title, $content, $usersId);
        $this->view->render('backend', 'newPost', ['newPost' => $newPost]);
        $this->session->setFlash("Votre post a bien été publié","success");
        $this->session->flash();
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
        $changePost = $this->adminManager->getChangePost($postnumber);
        $this->view->render('backend', 'changePost', ['changePost' => $changePost]);
    }
    function updatePost($postnumber, $subject, $message)
    {
        $this->adminManager->updatePostNow($postnumber, $subject, $message);
        $this->listingPost();
        $this->session->setFlash("Votre post a bien été modifié","success");
        $this->session->flash();
    }
    function deletePost($postnumber)
    {
        $this->adminManager->deletePostNow($postnumber);
        $this->listingPost();
        $this->session->setFlash("Votre post a bien été supprimé","success");
        $this->session->flash();
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
        $this->session->setFlash("L&rsquo;utilisateur a bien changé de droit","success");
        $this->session->flash();
    }

    function deleteUser($idUser)
    {
        $this->adminManager->deleteUser($idUser);
        $this->adminManager->getLawList();
        $this->usersList();
        $this->session->setFlash("L&rsquo;utilisateur a bien été supprimé","success");
        $this->session->flash();
    }

    function changeStatusComment($commentId, $validateId) // Long Post view
    {
        $this->adminManager->commentReport($commentId, $validateId); // affichage du post entier
        $this->listingComment();
        $this->session->setFlash("Le statut du commentaire a bien été modifié","success");
        $this->session->flash();
    }
    
}
