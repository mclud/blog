<?php

    function getPosts() {
            $bd = dbConnect();
            $req = $bd->query('SELECT * FROM post');
            return $req;
    }
    function getPost($id) {
        $bd = dbConnect();
        $req = $bd->query('SELECT * FROM post WHERE id='.$id);
        return $req;
    }
    function getComByPost($id) {
        $bd = dbConnect();
        $req = $bd->query('SELECT * FROM comment');
        return $req;
    }
    function addPost($title, $content) {
            $bd = $this->dbConnect();
            $req = $bd->prepare('INSERT INTO post(title, content) VALUES(:title, :content)');
            $req->execute(array(
                'title' => $title,
                'content' => $content,
            ));
        }
     function getComments() {
            $bd = dbConnect();
            $req = $bd->query('SELECT * FROM comments(comment) LEFT JOIN ');
        }
     function dbConnect() {
            $bd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
            return $bd;
     }
