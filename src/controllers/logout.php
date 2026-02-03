<?php
require_once('src/model.php');

function logout(){
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

?>