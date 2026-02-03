<?php
require_once('src/model.php');

function addComment(string $post, string $comment)
{
    if (!empty($comment)) {
        // Crée le commentaire avec en paramètre l'ID du post, l'ID de l'auteur et le contenu du commentaire
        $success = createComment($post, $_SESSION['id'], $comment);
        if (!$success) {
            die('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    } else {
        die('Les données du formulaire sont invalides.');
    }
}
