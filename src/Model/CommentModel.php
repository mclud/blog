<?php
/**
 * Created by PhpStorm.
 * User: LD
 * Date: 21/03/2019
 * Time: 17:15
 */

class CommentModel
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getComs()
    {
        $req = $this->_db->query('SELECT * FROM comment');
        $rep = $req->fetchAll(PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getComsByPost($id)
    {
        $req = $this->_db->query('SELECT * FROM comment WHERE postId='.$id);
        $rep = $req->fetchAll(PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getComsByUser($id)
    {
        $req = $this->_db->query('SELECT * FROM comment WHERE author='.$id);
        $rep = $req->fetchAll(PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getNbComsByUser($id) {
        $req = $this->_db->query('SELECT * FROM comment WHERE author='.$id);
        $rep = $req->fetchAll(PDO::FETCH_ASSOC);
        return count($rep);
    }

    public function getCom($id) {
        $req = $this->_db->query('SELECT * FROM comment WHERE id='.$id);
        $rep = $req->fetch(\PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getLast5Coms() {
        $req = $this->_db->query('SELECT * FROM comment ORDER BY id DESC LIMIT 5');
        $rep = $req->fetchAll(PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getNbComs($id) {
        $req = $this->_db->query('SELECT * FROM comment WHERE postId='.$id);
        $rep = $req->fetchAll(PDO::FETCH_ASSOC);
        return count($rep);
    }

    public function addCom(Comment $comment) {
        $req = $this->_db->prepare('INSERT INTO comment (content, author, postId, anonymous) VALUES (:content, :author, :postId, :anonymous)');
        $req->execute(array(
            'content' => $comment->getContent(),
            'author' => $comment->getAuthor(),
            'postId' => $comment->getPostId(),
            'anonymous' => $comment->getAnonymous()
        ));
    }

    public function delCom($id) {
        $req = $this->_db->prepare('DELETE FROM comment WHERE id=:id');
        $req->execute(array(
            'id' => $id
        ));
    }

    public function deleteComsByPost($id) {
        $req = $this->_db->prepare('DELETE FROM comment WHERE postId=:id');
        $req->execute(array(
            'id' => $id
        ));
    }

    /**
     * @param mixed $db
     */
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}