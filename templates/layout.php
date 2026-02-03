<!DOCTYPE html>
<html>

   <head>
      <meta charset="utf-8" />
      <title><?= $title ?></title>
      <link href="style.css" rel="stylesheet" />
   </head>

   <header>
      <h1><a href="index.php" class="site-title">Blog du Club de Volleyball</a></h1>

      <?php
      if (isset($_SESSION['id'])) {
      ?>
         <nav>
            <a href="index.php?action=profile">Mon profil</a>
            <a href="index.php?action=logout" class="logout">Déconnexion</a>
         </nav>
      <?php
      } else {
      ?>
         <nav>
            <a href="index.php?action=login">Connexion</a>
            <a href="index.php?action=inscription">Inscription</a>
         </nav>
      <?php
      }
      ?>

   </header>

   <body>
      <?= $content ?>
   </body>

</html>