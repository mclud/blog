<?php
include_once ('Manager.php');
class LoginManager extends Manager {


    /**
     * @param $userName
     * @return mixed
     */
    private function getUserByUserName($userName) {
        $db = dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE username=:username ORDER BY id LIMIT 1');
        $req->execute(array(
            'username' => $userName,
        ));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    private function getUserByEmail($email) {
        $db = dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE email=:email ORDER BY id LIMIT 1');
        $req->execute(array(
            'email' => $email,
        ));
        $rep = fetch(PDO::FETCH_ASSOC);
        $user = $rep['email'];
        return $user;
    }
}