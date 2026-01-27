<?php

function dbConnect()
{
    // Connexion à la base de données
    try {
        $database = new PDO('mysql:host=localhost;dbname=annee2_ap2_avbn;charset=utf8', 'root', '');

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

    $statement = $database->prepare('SELECT comments.id, user.login, comments.comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS french_creation_date FROM comments
    join user on comments.author=user.id WHERE post_id=? ORDER BY comment_date DESC');
    $statement->execute([$id]);

    $comments = [];
    while ($row = $statement->fetch()) {

        $comment = [
            'author' => $row['login'],
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

    $statement = $database->query('SELECT id, login FROM user');

    $users = [];
    while ($row = $statement->fetch()) {
        $user = [
            'id' => $row['id'],
            'login' => $row['login'],
        ];

        $users[] = $user;
    }

    $statement->closeCursor();

    return $users;
}
