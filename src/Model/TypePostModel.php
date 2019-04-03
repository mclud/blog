<?php
/**
 * Created by PhpStorm.
 * User: LD
 * Date: 30/03/2019
 * Time: 02:17
 */

class TypePostModel
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getTypes() {
        $query = $this->_db->query('SELECT * FROM type_post');
        $rep = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getTypeById($id) {
        $query = $this->_db->query('SELECT * FROM type_post where id='.$id);
        $rep = $query->fetch(PDO::FETCH_ASSOC);
        return $rep;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

}