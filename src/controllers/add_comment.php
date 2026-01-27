<?php
require_once('src/model.php');

function addComment(string $post, array $input)
{
    $author = null;
    $comment = null;
    $users = getUsers();

    if (!empty($input['author']) && !empty($input['comment']) && in_array($input['author'], array_column($users, 'login'))) {
        foreach ($users as $user) {
            if ($user['login'] === $input['author']) {
                $author = $user['id'];
                break;
            }
        }
        $comment = $input['comment'];
    } else {
        die('Les données du formulaire sont invalides.');
    }

    $success = createComment($post, $author, $comment);
    if (!$success) {
        die('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $post);
    }
}
