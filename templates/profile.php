<?php ob_start(); ?>

<div class="form-container">
    <form action="index.php?action=updateProfile" method="post">
        <h2>Modifier le profil</h2>
        <?php
         if (isset($_GET['error']) && $_GET['error'] == 0) {
            echo '<p class="form-success">Profil mis à jour avec succès.</p>';
        }
        ?>
        <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="<?= $_SESSION['name'] ?>" />
        </div>
        <br />
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" value="<?= $_SESSION['firstname'] ?>" />
        </div>
        <br />
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= $_SESSION['email'] ?>" />
        </div>
        <br />
        <br>

        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p class="form-error">L\'ancien mot de passe est incorrect.</p>';
        }
        ?>
        <div>
            <label for="old_password">Ancien mot de passe</label>
            <input type="password" id="old_password" name="old_password" />
        </div>
        <div>
            <label for="new_password">Nouveau mot de passe</label>
            <input type="password" id="new_password" name="new_password" />
        </div>
        <br />
        <div>
            <input type="submit" value="Modifier" />
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php $title = "Modifier le profil" ?>
<?php require('layout.php') ?>