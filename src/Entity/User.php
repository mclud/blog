<?php

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    public function hydrate(array $data) {
        foreach ($data as $setter => $v) {
            $method = 'set'.ucfirst($setter);
            if (method_exists($this, $method)) {
                $this->$method($v);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->id = $id;
        }
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        if (strlen($username) > 2) {
            $this->username = $username;
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
//        $rgx = '/^[a-zA-Z0-9]{0,}[a-zA-Z0-9_.-]{0,}@[a-zA-Z0-9]{0,}[a-zA-Z0-9_-]\.[a-z]{2,5}/,gm';
            $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}