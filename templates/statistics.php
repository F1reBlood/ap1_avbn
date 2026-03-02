<?php
ob_start();
?>

<h1>Statistiques :</h1>

<table>
    <thead>
        <tr>
            <th colspan="2">Nombre total de commentaires</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total des commentaires</td>
            <td><?= htmlspecialchars($total_comments) ?></td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Nombre de commentaires</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments_per_user as $user_stat) {
            ?>
            <tr>
                <td><?= htmlspecialchars($user_stat['login']) ?></td>
                <td><?= htmlspecialchars($user_stat['comments_count']) ?></td>
            </tr>
        <?php
        } 
        ?>
            
    </tbody>
</table>

<?php
$content = ob_get_clean();
$title = "Statistiques - Blog de l'AVBN";
require('layout.php');
?>