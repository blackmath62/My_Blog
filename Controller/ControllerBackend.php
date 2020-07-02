<?php

namespace App\Controller;

use App\Model\BlogManager;
use App\Entity\View;
use App\Model\AdminManager;
use App\Entity\Session;

class ControllerBackend
{
    private $view;
    private $blogManager;
    private $adminManager;
    private $session;
    function __construct()
    {
        
        $this->view = new View();
        $this->blogManager = new BlogManager();
        $this->adminManager = new AdminManager();
        $this->session = new Session();
        
    }
    function checkLaw(){
        if (isset($_SESSION['law_id']) && $_SESSION['law_id'] == 1){
            return;
        }else{
            $this->view->render('frontend', 'home', []);
        }
    }
    function getAdmin()
    {
        $this->checkLaw();
        $this->view->render('backend', 'backendHome', []);
    }

    function newPost($title, $content, $usersId)
    {
        $this->checkLaw();
        $newPost = $this->adminManager->newPost($title, $content, $usersId);
        $this->view->render('backend', 'newPost', ['newPost' => $newPost]);
        $this->session->setFlash("Votre post a bien été publié","success");
        $this->session->flash();
    }
    function viewNewPost()
    {
        $this->checkLaw();
        $this->view->render('backend', 'newPost', []);
    }

    function listingPost()
    {
        $this->checkLaw();
        $ListPosts = $this->blogManager->allPost();
        $this->view->render('backend', 'listingPost', ['ListPosts' => $ListPosts]);
    }
    function listingComment()
    {
        $this->checkLaw();
        $allComment = $this->blogManager->allComment();
        $this->view->render('backend', 'listingComment', ['allComment' => $allComment]);
    }

    function changePost($postnumber)
    {
        $this->checkLaw();
        $changePost = $this->adminManager->getChangePost($postnumber);
        $this->view->render('backend', 'changePost', ['changePost' => $changePost]);
    }
    function updatePost($postnumber, $subject, $message)
    {
        $this->checkLaw();
        $this->adminManager->updatePostNow($postnumber, $subject, $message);
        $this->listingPost();
        $this->session->setFlash("Votre post a bien été modifié","success");
        $this->session->flash();
    }
    function deletePost($postnumber)
    {
        $this->checkLaw();
        $this->adminManager->deletePostNow($postnumber);
        $this->listingPost();
        $this->session->setFlash("Votre post a bien été supprimé","success");
        $this->session->flash();
    }
    function usersList()
    {
        $this->checkLaw();
        $allLaw = $this->adminManager->getLawList();
        $allUsers = $this->adminManager->getUsersList();
        $this->view->render('backend', 'usersList', ['allLaw' => $allLaw, 'allUsers' => $allUsers]);
    }

    function ChangeLawUser($idLaw, $idUser)
    {
        $this->checkLaw();
        $this->adminManager->getChangeLawUser($idLaw, $idUser);
        $this->adminManager->getLawList();
        $this->usersList();
        $this->session->setFlash("L&rsquo;utilisateur a bien changé de droit","success");
        $this->session->flash();
    }

    function deleteUser($idUser)
    {
        $this->checkLaw();
        $this->adminManager->deleteUser($idUser);
        $this->adminManager->getLawList();
        $this->usersList();
        $this->session->setFlash("L&rsquo;utilisateur a bien été supprimé","success");
        $this->session->flash();
    }

    function changeStatusComment($commentId, $validateId) // Long Post view
    {
        $this->checkLaw();
        $this->adminManager->commentReport($commentId, $validateId); // affichage du post entier
        $this->listingComment();
        $this->session->setFlash("Le statut du commentaire a bien été modifié","success");
        $this->session->flash();
    }
    
}
