<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion de la biblio</title>
  <link rel="stylesheet" href="<?= $CONFIG['URL_SITE'] ?>/public/css/gestion.css" type="text/css">
</head>
<body>
  <h1>Gestion de la bibliothèque</h1>
  <div style="display:flex;">
    <div id="colonne" style="background-color:skyblue; padding:0px 70px 0px 40px;">
      <ul class="menu">
        <li><a href="<?= $CONFIG['URL_SITE'] ?>/gestion/livres/">livres</a></li>
        <ul>
          <li><a href="<?= $CONFIG['URL_SITE'] ?>/gestion/livres/rechercher/">Rechercher</a></li>
          <li><a href="<?= $CONFIG['URL_SITE'] ?>/gestion/livres/creer/">Créer</a></li>
        </ul>
        <li><a href="<?= $CONFIG['URL_SITE'] ?>/gestion/reservations/">réservations</a></li>
        <li><a href="<?= $CONFIG['URL_SITE'] ?>/gestion/lecteurs/">lecteurs</a></li>
      </ul>
    </div>
    <div id="contenu" style="padding:10px;">
      <?php
      if ($routefinale == "livres") {
        require "gestionlivres.php";
        
      } elseif ($routefinale == "auteurs") {
      require "gestionauteurs.php";
      }
      else if($routefinale == "reservations"){

        require "gestionreservations.php";
      }
      else if($routefinale == "lecteurs"){

        require "gestionlecteurs.php";
      }
      else {
        echo "";
      }
      ?>
    </div>
  </div>
</body>
</html>
