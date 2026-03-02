<?php ob_start(); ?>

<div class="form-container">
    <form action="index.php?action=testlogin" method="post">
        <h2>Connexion</h2>
        <div>
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" />
        </div>
        <br />
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" />
        </div>
        <br />
        <div>
            <input type="submit" value="Se connecter" />
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php $title = "Connexion au blog de l'AVBN" ?>
<?php require('layout.php') ?>