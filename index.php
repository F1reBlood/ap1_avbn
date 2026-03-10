<?php
session_start();

require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/login.php');
require_once('src/controllers/logout.php');
require_once('src/controllers/statistics.php');
require_once('src/controllers/inscription.php');
require_once('src/controllers/profile.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    if ($_GET['action'] === 'login' && !isset($_SESSION['id'])) {
        login();
    }
    elseif ($_GET['action'] === 'testlogin' && !isset($_SESSION['id'])) {
        testlogin();
    }
    elseif ($_GET['action'] === 'logout' && isset($_SESSION['id'])) {
        logout();
    }
    elseif ($_GET['action'] === 'statistics' && isset($_SESSION['type']) && $_SESSION['type'] == '1') {
        statistics();
    }
    elseif ($_GET['action'] === 'inscription' && !isset($_SESSION['id'])) {
        inscription();
    }
    elseif ($_GET['action'] === 'testInscription' && !isset($_SESSION['id'])) {
        testInscription();
    }
    elseif ($_GET['action'] === 'profile' && isset($_SESSION['id'])) {
        profile();
    }
    elseif ($_GET['action'] === 'updateProfile' && isset($_SESSION['id'])) {
        updateProfile();
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
