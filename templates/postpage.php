<?php ob_start(); ?>

<h1>Le super blog de l'AVBN !</h1>
<a href="index.php" class="btn btn-secondary btn-back">Retour à la liste des posts</a>

<div class="news post-page">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['french_creation_date'] ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Commentaires</h2>

<div class="comment-section">
<?php
foreach ($comments as $comment) {
?>
    <div class="comment">
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['french_creation_date'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    </div>
<?php
}
?>
</div>

<?php
if (isset($_SESSION['id'])) {
    ?>
    <div class="comment-form">
    <h2>Ajouter un commentaire</h2>
    <form action="index.php?action=addComment&id=<?= $post['identifier'] ?>" method="post">
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
    </div>
<?php
}
?>

<?php
$content = ob_get_clean();
$title = "Le blog de l'AVBN";

require 'layout.php';
?>