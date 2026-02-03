<?php
session_start();

require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/login.php');
require_once('src/controllers/logout.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    if ($_GET['action'] === 'login') {
        login();
    }
    elseif ($_GET['action'] === 'testlogin') {
        testlogin();
    }
    elseif ($_GET['action'] === 'logout') {
        logout();
    }
    elseif ($_GET['action'] === 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];

            post($identifier);
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';

            die;
        }
    } elseif ($_GET['action'] === 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];
            $comment = $_POST['comment'];

            addComment($identifier, $comment);
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';

            die;
        }
    } else {
        echo "Erreur 404 : la page que vous recherchez n'existe pas.";
    }
} else {
    homepage();
}
