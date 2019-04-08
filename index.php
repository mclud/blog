<?php
include_once('src/Controller/CommentController.php');
include_once('src/Controller/PostController.php');
include_once('src/Controller/UserController.php');
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['role'] = 'anonymous';
    $_SESSION['username'] = 'Anonymous';
}
$postController = new PostController();
$userController = new UserController();
$commentController = new CommentController();
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'home') {
        $postController->listPostsView();
    }
    elseif ($_GET['action'] == 'login') {
        $manager = new Manager();
        $categories = $manager->getTypePostRepository()->getTypes();
        require ('views/loginView.php');
    }
    elseif ($_GET['action'] == 'log') {
        $username = htmlspecialchars($_POST['user']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $userController->checkLogin($username, $pwd);
    }
    elseif ($_GET['action'] == 'logout') {
        $userController->logOut();
    }
    elseif ($_GET['action'] == 'createAccount') {
        $manager = new Manager();
        $categories = $manager->getTypePostRepository()->getTypes();
        require ('views/createAccountView.php');
    }
    elseif ($_GET['action'] == 'register') {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $userController->register($username, $email, $password, $password2);
    }
    elseif ($_GET['action'] == 'myAccount') {
        $id = (int) $_SESSION['id'];
        $userController->myAccount($id);
    }
    elseif ($_GET['action'] == 'changeSettings') {
        $userId = (int) $_SESSION['id'];
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        if (isset($password) && isset($email)) {
            $userController->changeSettings($userId, $email, $password);
        }
    }
    elseif ($_GET['action'] == 'addPost') {
        $title = htmlspecialchars($_POST['title']);
        $content = nl2br(htmlspecialchars($_POST['content'])) ;
        $typeId = (int) $_POST['type'];
        $imgsrc = htmlspecialchars($_POST['imgsrc']);
        $postController->addPost($title,$content, $typeId, $imgsrc);
    }
    elseif ($_GET['action'] == 'addPostView') {
        $postController->addPostView();
    }
    elseif ($_GET['action'] == 'editPost') {
        $id = (int) $_GET['id'];
        $postController->editPostView($id);
    }
    elseif ($_GET['action'] == 'updatePost') {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $type = $_POST['type'];
        $id = (int) $_GET['id'];
        if (isset($_POST['imgsrc'])) {
            $imgsrc = htmlspecialchars($_POST['imgsrc']);
        } else {
            $imgsrc = NULL;
        }
        $postController->editPost($id, $title, $content, $type, $imgsrc);
    }
    elseif ($_GET['action'] == 'viewPost') {
        $postId = (int) $_GET['id'];
        $postController->postView($postId);
    }
    elseif ($_GET['action'] == 'viewByCat') {
        $catId = (int) $_GET['id'];
        $postController->listPostsByCatView($catId);
    }
    elseif ($_GET['action'] == 'delPost') {
        $id = (int) $_GET['id'];
        $postController->delPost($id);
    }
    elseif ($_GET['action'] == 'deleteUser') {
        $id = (int) $_GET['id'];
        $userController->deleteUser($id);
    }
    elseif ($_GET['action'] == 'adminView') {
        $userController->adminView();
    }
    elseif ($_GET['action'] == 'register') {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        var_dump($username);
        $userController->register($username, $email, $password, $password2);
    }
    elseif ($_GET['action'] == 'addCom') {
        $idPost = htmlspecialchars($_GET['id']);
        if (isset($_SESSION['id'])) {
            $author = $_SESSION['id'];
        } else {
            $author = htmlspecialchars($_POST['username']);
        }
        $content = htmlspecialchars($_POST['comment']);
        $commentController->addCom($content, $author, $idPost);
    }
    elseif ($_GET['action'] == 'delCom') {
        $idCom = (int) $_GET['id'];
        $postId = (int) $_GET['postId'];
        $commentController->delCom($idCom, $postId);
    }

    else {
        $postController->listPostsView();
    }
}
else {
    $postController->listPostsView();
}

