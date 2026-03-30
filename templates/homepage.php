<?php ob_start();

?> <h1>Le super blog de l'AVBN !</h1> <?php

    if (isset($_SESSION['type']) && $_SESSION['type'] === 1) {
    ?>
    <h2 class="page-title">Ajouter un post :</h2>

    <div class="news form-card">
        <h3>Nouveau post</h3>

        <form action="index.php?action=addPost" method="post" class="form-post">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" required/>
            </div>

            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea id="content" name="content" required></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Publier" />
            </div>

        </form>
    </div>

    <br><br>
    <?php
    }
    ?>

<h2 class="page-title">Derniers posts du blog :</h2>

<?php
foreach ($posts as $post) {
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']); ?>
            <em>le <?= $post['french_creation_date']; ?></em>
        </h3>
        <p>
            <?= nl2br(htmlspecialchars($post['content'])); ?>
            <br />
            <a href="index.php?action=post&id=<?= urlencode($post['id']) ?>" class="btn-comment">Commentaires</a>
        </p>
    </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>
<?php $title = "Le blog de l'AVBN" ?>

<?php require('layout.php') ?>