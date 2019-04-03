<?php

class Manager
{
    private $_db;

    public function __construct()
    {
        $this->dbConnect();
    }

    public function getPostRepository() {
        include_once ('src/Model/PostModel.php');
        $repo = new PostModel($this->_db);
        return $repo;
    }

    public function getUserRepository() {
        include_once ('src/Model/UserModel.php');
        $repo = new UserModel($this->_db);
        return $repo;
    }

    public function getCommentRepository() {
        include_once ('src/Model/CommentModel.php');
        $repo = new CommentModel($this->_db);
        return $repo;
    }

    public function getTypePostRepository() {
        include_once ('src/Model/TypePostModel.php');
        $repo = new TypePostModel($this->_db);
        return $repo;
    }
//    public function getUserRepository() {
//        include ('src/Model/UserModel.php');
//        $repo = new \LMC\Blog\Model\PostModel($this->_db);
//        return $repo;
//    }

    function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        $this->setDb($db);
        return $db;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

}