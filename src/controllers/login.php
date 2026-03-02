<?php
require_once('src/model.php');

function login(){
    require('templates/login.php');
}

function testlogin(){
    $login = $_POST['email'];
    $password = hash('sha256', $_POST['password']);

    $user = test_login($login, $password);
    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['type'] = $user['type'];
        header('Location: index.php');
        exit;
    } else {
        echo 'Login ou mot de passe incorrect.';
    }
}

?>