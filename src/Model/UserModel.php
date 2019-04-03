<?php


class UserModel
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function addUser(User $user) {
        $req = $this->_db->prepare('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
        $req->execute(array(
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole()
        ));
        $em = new Manager();
        $userSelect = $em->getUserRepository()->getByUserName($user->getUsername());
        $userIn = new User();
        $userIn->hydrate($userSelect);
        $_SESSION['username'] =  $userIn->getUsername();
        $_SESSION['role'] =  $userIn->getRole();
        $_SESSION['id'] =  $userIn->getId();
    }

    function deleteUser($id) {
        $req = $this->_db->prepare('DELETE FROM users WHERE id=:id');
        $req->execute(array(
            'id' => $id,
        ));
    }
    public function update(User $user) {
        $req = $this->_db->prepare('UPDATE users SET email=:email WHERE id=:id');
        $req->execute(array(
           'email' => $user->getEmail(),
            'id' => $user->getId()
        ));
    }

    public function getUsers() {
        $req = $this->_db->query('SELECT * FROM users');
        $rep = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getLastUser() {
        $req = $this->_db->query('SELECT * FROM users ORDER BY id DESC limit 1');
        $rep = $req->fetch(\PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getUserById($id) {
        $req = $this->_db->query('SELECT * FROM users WHERE id='.$id);
        $rep = $req->fetch(\PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getByUserName($name) {
        $req = $this->_db->prepare('SELECT * FROM users WHERE username=:username');
        $req->execute(array(
            'username' => $name
        ));
        $rep = $req->fetch(\PDO::FETCH_ASSOC);
        return $rep;
    }

    public function getByNameOrMail($name, $email) {
        $req = $this->_db->prepare('SELECT * FROM users WHERE (username=:username) OR (email=:email)');
        $req->execute(array(
            'username' => $name,
            'email' => $email
        ));
        $rep = $req->fetchAll(\PDO::FETCH_ASSOC);
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