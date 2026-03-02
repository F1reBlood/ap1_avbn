<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <title><?= $title ?></title>
   <link href="style.css" rel="stylesheet" />
</head>

<header>
   <?php
   if (isset($_SESSION['type'])) {
      if ($_SESSION['type'] == '0') {
         ?>
         <h1><a href="index.php" class="site-title">Blog du Club de Volleyball - Utilisateur</a></h1>
         <?php
      }
      elseif($_SESSION['type'] == '1'){
         ?>
         <h1><a href="index.php" class="site-title">Blog du Club de Volleyball - Administrateur</a></h1>
         <?php
      }
   }
   else{
         ?>
         <h1><a href="index.php" class="site-title">Blog du Club de Volleyball</a></h1>
         <?php
      }
   ?>


   <?php
   if (isset($_SESSION['id'])) {
      if ($_SESSION['type'] == '1'){
         ?>
         <nav>
            <a href="index.php?action=statistics">Statistiques</a>
            <a href="index.php?action=logout" class="logout">Déconnexion</a>
         </nav>
         <?php
      }
      else{
         ?>
         <nav>
            <a href="index.php?action=profile">Mon profil</a>
            <a href="index.php?action=logout" class="logout">Déconnexion</a>
         </nav>
         <?php
      }
   } 
   else {
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