<?php
include_once ('src/Model/Manager.php');
include_once ('src/Entity/User.php');

class UserController extends Manager
{
    public function checkLogin($username, $password) {
        $categories = $this->getTypePostRepository()->getTypes();
        $postController = new PostController();
        $em = new Manager();
        $userRepo = $em->getUserRepository();
        if (!empty($username) && !empty($password)) {
            $userSelected = $userRepo->getByUserName($username);
            if (!$userSelected) {
                $addflash = 'Utilisateur inconnu ou mot de passe incorrect';
                require ('views/loginView.php');

            } else {
                $user = new User();
                $user->hydrate($userSelected);
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['role'] = $user->getRole();
                    $postController->listPostsView();
                } else {
                    $addflash = 'Utilisateur inconnu ou mot de passe incorrect';
                    require ('views/loginView.php');
                }
            }
        } else {
            $addflash = 'Champ manquant';
            require ('views/loginView.php');
        }
    }

    public function logOut() {
        session_unset();
        $_SESSION['role'] = 'anonymous';
        $_SESSION['username'] = 'Anonymous';
        $postController = new PostController();
        $postController->listPostsView();
    }


    public function register($username, $email, $pwd, $pwd2 ) {
        if (isset($username) && isset($pwd) && isset($pwd2)) {
            $categories = $this->getTypePostRepository()->getTypes();
            $em = new Manager();
            $userSelected = $em->getUserRepository()->getByNameOrMail($username, $email);
            var_dump(empty($userSelected));
            if (empty($userSelected)) {
                if ($pwd === $pwd2) {
                    var_dump($username); var_dump('here');
                    $user = new User();
                    $user->hydrate(array(
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash($pwd,PASSWORD_BCRYPT),
                        'role' => 'User'
                    ));
                    //Reselectionne
                    $em->getUserRepository()->addUser($user);
                    $postController = new PostController();
                    $postController->listPostsView();
                }  else {
                    $addflash = 'Mot de passe incorrect';
                    require('views/createAccountView.php');
                }
            } else {
                $addflash = 'Utilisateur ou mail déjà existant';
                require('views/createAccountView.php');
            }
        }
    }

    public function adminView() {
        if ($_SESSION['role'] === 'Admin') {
            $em = new Manager();
            $posts = $em->getPostRepository()->getPosts();
            $users = $em->getUserRepository()->getUsers();
            require('views/adminView.php');
        } else {
            echo 'acces refusé';
        }
    }

    public function deleteUser($id) {
        if ($_SESSION['role'] === 'Admin') {
            $em = new Manager();
            $em->getUserRepository()->deleteUser($id);
            $posts = $em->getPostRepository()->getPosts();
            $users = $em->getUserRepository()->getUsers();
            require('views/adminView.php');
        } else {
            echo 'acces refusé';
        }
    }

    public function myAccount($id) {
        $em = new Manager();
        $rep = $em->getUserRepository()->getUserById($id);
        $coms = $em->getCommentRepository()->getComsByUser($id);
        $totalComs = $em->getCommentRepository()->getNbComsByUser($id);
        $categories = $this->getTypePostRepository()->getTypes();
        require('views/myAccountView.php');
    }

    public function changeSettings($userId, $email, $password) {
        $em = new Manager();
        $user = new User();
        $dataUser = $em->getUserRepository()->getUserById($userId);
        $user->hydrate($dataUser);
        if (password_verify($password, $user->getPassword())) {
            $user->setEmail($email);
            $em->getUserRepository()->update($user);
            $addflash = true;
        } else {
            $addflash = false;
        }
        $rep = $em->getUserRepository()->getUserById($userId);
        $coms = $em->getCommentRepository()->getComsByUser($userId);
        $totalComs = $em->getCommentRepository()->getNbComsByUser($userId);
        require('views/myAccountView.php');
    }
}