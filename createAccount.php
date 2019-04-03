<?php
include_once ('Post.php');

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$pwd = htmlspecialchars($_POST['pwd']);
$pwd2 = htmlspecialchars($_POST['pwd2']);

if (isset($username) && isset($pwd) && isset($pwd2)) {
    //Formulaire rempli
    //Si user deja existant
    $bd = dbConnect();

    $reqName = $bd->query("SELECT * FROM users WHERE username='$username'");
    $nameExist = $reqName->fetchAll();
    $reqMail = $bd->query("SELECT * FROM users WHERE email='$email'");
    $mailExist = $reqMail->fetchAll();

    if (count($mailExist) > 0 || count($nameExist) > 0) {
        echo "Utilisateur ou mail deja existant";
    } elseif ($pwd !== $pwd2) {
        echo "Mot de passe érroné";
    } else {
        $req = $bd->prepare('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
        $req->execute(array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($pwd, PASSWORD_BCRYPT),
            'role' => 'User',
        ));
        echo 'Création ok';
    }
}