<?php

use LMC\Blog\Model\User;

class UserManager
{
    /**
     * @var PDO
     */
    private $_db; // Instance de PDO.

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(User $user)
    {
        $q = $this->_db->prepare('INSERT INTO users(username, email, password, role) VALUES(:username,:email,:password,:role)');
        $q->execute(array(
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPwd(),
            'role' => $user->getRole()
        ));
    }

    public function delete(User $user)
    {
        // Exécute une requête de type DELETE.
    }

    public function get($id)
    {
        // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
    }

    public function getList()
    {
        // Retourne la liste de tous les personnages.
    }

    public function update(User $user)
    {
        // Prépare une requête de type UPDATE.
        // Assignation des valeurs à la requête.
        // Exécution de la requête.
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}