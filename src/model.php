<?php

function dbConnect()
{
    // Connexion à la base de données
    try {
        $database = new PDO('mysql:host=localhost;dbname=annee2_ap1_avbn;charset=utf8', 'root', '');

        return $database;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    return $database;
}



function getPosts()
{
    $database = dbConnect();

    $statement = $database->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY creation_date DESC');

    $posts = [];
    while ($row = $statement->fetch()) {
        $post = [
            'id' => $row['id'],
            'title' => $row['title'],
            'french_creation_date' => $row['date_creation_fr'],
            'content' => $row['content']
        ];

        $posts[] = $post;
    } // Fin de la boucle des billets

    $statement->closeCursor();

    return $posts;
}

function getPost($id)
{
    $database = dbConnect();

    // On récupère les 5 derniers billets
    $statement = $database->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts where id=?');
    $statement->execute([$id]);

    $row = $statement->fetch();
    $post = [
        'identifier' => $row['id'],
        'title' => $row['title'],
        'french_creation_date' => $row['date_creation_fr'],
        'content' => $row['content']
    ];


    $statement->closeCursor();

    return $post;
}

function getComments($id)
{
    $database = dbConnect();

    $statement = $database->prepare('SELECT comments.id, user.firstname, user.name, comments.comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS french_creation_date 
    FROM comments join user on comments.author=user.id WHERE post_id=? ORDER BY comment_date DESC');
    $statement->execute([$id]);

    $comments = [];
    while ($row = $statement->fetch()) {

        $comment = [
            'author' => $row['firstname'] . " " . $row['name'],
            'french_creation_date' => $row['french_creation_date'],
            'comment' => $row['comment'],
        ];

        $comments[] = $comment;
    }

    $statement->closeCursor();

    return $comments;
}

function createComment(string $post, string $author, string $comment)
{
    $database = dbConnect();
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
}

function getUsers()
{
    $database = dbConnect();

    $statement = $database->query('SELECT id, email FROM user');

    $users = [];
    while ($row = $statement->fetch()) {
        $user = [
            'id' => $row['id'],
            'email' => $row['email'],
        ];

        $users[] = $user;
    }

    $statement->closeCursor();

    return $users;
}

function test_login(string $email, string $password)
{
    $database = dbConnect();

    $statement = $database->prepare('SELECT id, name, firstname, email, pwd, type FROM user WHERE email = ? AND pwd = ?');
    $statement->execute([$email, $password]);

    $user = $statement->fetch();

    $statement->closeCursor();

    return $user;
}

function get_comments_per_user(){
    $database = dbConnect();

    $statement = $database->query('SELECT user.firstname, user.name, COUNT(*) AS comments_count FROM comments JOIN user ON user.id = comments.author GROUP BY user.email ORDER BY comments_count DESC');

    $results = [];
    while ($row = $statement->fetch()) {
        $result = [
            'author' => $row['firstname'] . " " . $row['name'],
            'comments_count' => $row['comments_count'],
        ];

        $results[] = $result;
    }

    $statement->closeCursor();

    return $results;
}

function get_comments_count(){
    $database = dbConnect();

    $statement = $database->query('SELECT COUNT(*) AS total_comments FROM comments');

    $row = $statement->fetch();
    $total_comments = $row['total_comments'];

    $statement->closeCursor();

    return $total_comments;
}

function testInscription(){
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $database = dbConnect();
    $statement = $database->prepare('SELECT email, pwd from user where email=?');
    $statement->execute([$email]);
    $existing_user = $statement->fetch();

    if ($existing_user) {
        echo 'Un utilisateur avec cet email existe déjà.';
        return;
    }

    if ($password !== $confirm_password) {
        echo 'Les mots de passe ne correspondent pas.';
        return;
    }

    addUserToBDD($name, $firstname, $email, $password);
    header('Location: index.php?action=login');
}

function addUserToBDD(string $name, string $firstname, string $email, string $password){
    $database = dbConnect();
    $statement = $database->prepare(
        'INSERT INTO user(name, firstname, email, pwd, type) VALUES(?, ?, ?, ?, 0)'
    );
    
    $statement->execute([$name, $firstname, $email, hash('sha256', $password)]);
}
?>