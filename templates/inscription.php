<?php ob_start(); ?>

<div class="form-container">
    <form action="index.php?action=testInscription" method="post">
        <h2>Inscription</h2>
        <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required/>
        </div>
        <br />
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" required/>
        </div>
        <br />
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required/>
        </div>
        <br />

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required/>
        </div>
        <br />
        <br>
        <div>
            <label for="confirm_password">Confirmer le mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password" required/>
        </div>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'eu') {
            echo '<p class="form-error">Un utilisateur avec cet email existe déjà.</p>';
        }
        elseif (isset($_GET['error']) && $_GET['error'] == 'wp') {
            echo '<p class="form-error">Les mots de passe ne correspondent pas.</p>';
        }
        else{
            ?> <br /> <?php
        }
        ?>
        <div>
            <input type="submit" value="S'inscrire" />
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php $title = "Inscription au blog de l'AVBN" ?>
<?php require('layout.php') ?>