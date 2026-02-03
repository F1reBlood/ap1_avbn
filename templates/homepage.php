<?php ob_start(); ?>
<h1>Le super blog de l'AVBN !</h1>
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
