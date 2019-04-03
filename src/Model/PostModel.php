<?php

class PostModel
{
    private $_db;
    public function __construct($db)
    {
        $this->setDb($db);
    }

    function getPosts() {
        $req = $this->_db->query('SELECT * FROM post ORDER BY id DESC ');
        $rep = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $rep;
    }
    public function getPostsByCat($catId) {
        $req = $this->_db->query('SELECT * FROM post WHERE type='.$catId);
        $rep = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $rep;
    }
    function getPost($id) {
        $req = $this->_db->query('SELECT * FROM post WHERE id='.$id);
        $rep = $req->fetch(\PDO::FETCH_ASSOC);
        return $rep;
    }
    function getComByPost($id) {
        $req = $this->_db->query('SELECT * FROM comment');
        $rep = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $rep;
    }
    function addPost(Post $post) {
        $req = $this->_db->prepare('INSERT INTO post(title, content, type, imgsrc) VALUES(:title, :content, :type, :imgsrc)');
        $req->execute(array(
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'type' => $post->getType(),
            'imgsrc' => $post->getImgsrc()
        ));
    }
    function deletePost($id) {
        $req = $this->_db->prepare('DELETE FROM post WHERE id=:id');
        $req->execute(array(
            'id' => $id,
        ));
    }
    function updatePost(Post $post) {
        $req = $this->_db->prepare("UPDATE post SET title=:title, content=:content, archive=:archive, type=:type, imgsrc=:imgsrc WHERE id=:id");
        $req->execute(array(
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'archive' => $post->getArchive(),
            'type' => $post->getType(),
            'imgsrc' => $post->getImgsrc()
        ));
    }
    function getComments() {
        $bd = dbConnect();
        $req = $bd->query('SELECT * FROM comments(comment) LEFT JOIN ');
    }

    function getLast5Posts() {
        $req = $this->_db->query('SELECT * FROM post ORDER BY id DESC LIMIT 5');
        $rep = $req->fetchAll(PDO::FETCH_ASSOC);
        return $rep;
    }

    function dbConnect() {
        $bd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        return $bd;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }
}