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
    }

    function getAdmin()
    {
        $this->view->render('backend', 'backendHome', []);
    }

    function newPost($title, $content, $usersId)
    {
        $getNewPost = new BlogManager(); // créer un Objet
        $newPost = $getNewPost->newPost($title, $content, $usersId);
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
        $commentList = new BlogManager(); // créer un Objet
        $allComment = $commentList->allComment();
        $this->view->render('backend', 'listingComment', ['allComment' => $allComment]);
    }

    function changePost($postnumber)
    {
        $getChangePost = new BlogManager(); // créer un Objet
        $changePost = $getChangePost->getChangePost($postnumber);
        $this->view->render('backend', 'changePost', ['changePost' => $changePost]);
    }
    function updatePost($postnumber, $subject, $message)
    {
        $this->blogManager->updatePostNow($postnumber, $subject, $message);
        $this->frontendListingPost();
    }
    function deletePost($postnumber)
    {
        $GetdeletePost = $this->blogManager->deletePostNow($postnumber);
        $frontendListPost = $this->blogManager->allPost();
        $this->view->render('backend', 'listingPost', ['frontendListPost' => $frontendListPost]);
    }
    function usersList()
    {
        $allLaw = $this->getRegister->getLawList();
        $allUsers = $this->getRegister->getUsersList();
        $this->view->render('backend', 'usersList', ['allLaw' => $allLaw, 'allUsers' => $allUsers]);
    }

    function ChangeLawUser($idLaw, $idUser)
    {
        $changelaw = $this->getRegister->getChangeLawUser($idLaw, $idUser);
        $allLaw = $this->getRegister->getLawList();
        $allUsers = $this->getRegister->getUsersList();
        header('refresh:2; url=' . $this->view->render('backend', 'usersList', ['allLaw' => $allLaw, 'allUsers' => $allUsers]) . '');        
        $this->view->render('backend', 'changeLawView', ['changelaw' => $changelaw]);
    }

    function deleteUser($idUser)
    {
        $getDeleteUser = $this->getRegister->deleteUser($idUser);
        $allLaw = $this->getRegister->getLawList();
        $allUsers = $this->getRegister->getUsersList();
        header('refresh:2; url=' . $this->view->render('backend', 'usersList', ['allLaw' => $allLaw, 'allUsers' => $allUsers]) . '');     
        $this->view->render('backend', 'deleteUserView', ['getDeleteUser' => $getDeleteUser]);
    }

    function changeStatusComment($commentId, $validateId) // Long Post view
    {
        $changeStatus = new CommentManager(); // créer un Objet
        $status = $changeStatus->commentReport($commentId, $validateId); // affichage du post entier
        header('Location: index.php?action=listingComment');
        $this->view->render('backend', 'changeStatusComment', ['status' => $status]);
    }

    // end site page function
}
