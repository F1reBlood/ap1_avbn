<?php ob_start(); ?>

<div class="form-container">
    <form action="index.php?action=testlogin" method="post">
        <h2>Connexion</h2>
        <div>
            <label for="login">Login</label><br />
            <input type="text" id="login" name="login" />
        </div>
        <div>
            <label for="password">Mot de passe</label><br />
            <input type="password" id="password" name="password" />
        </div>
        <div>
            <input type="submit" value="Se connecter" />
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php $title = "Connexion au blog de l'AVBN" ?>
<?php require('layout.php') ?>