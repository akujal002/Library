<?php

$repo_auteurs = new AuteurRepository();
$auteurs = $repo_auteurs->getAllAuteurs();
$repo_genres = new GenreRepository();
$genres = $repo_genres->getAllGenres();
$repo_livre = new LivreRepository();
$livre = $repo_livre->getOneLivre($_POST['Id_Livre']);
?>
<h2>Modifier le livre "<?= $livre->getTitre() ?>"</h2>

<form action="#" method="POST">
  <input type="hidden" name="Id_Livre" value="<?= $livre->getId() ?>">
  <label for="Titre">Titre du livre : </label>
  <input type="text" id="Titre" name="Titre" value="<?= $livre->getTitre() ?>" required><br>
  <label for="Date_publi">Date de publication : </label>
  <input type="date" id="Date_publi" name="Date_publi" value="<?= $livre->getDate_publi() ?>" required><br>
  <label for="Resume">Résumé : </label>
  <textarea id="Resume" name="Resume" rows="5" required><?= $livre->getResume() ?></textarea><br>
  <label for="Stock">Stock : </label>
  <input type="number" id="Stock" name="Stock" value="<?= $livre->getStock() ?>" required><br>
  <label for="Auteur">Auteur : </label>
  <select type="text" id="Auteur" name="Auteur" value="<?= $livre->getAuteur() ?>" required>
    <?php
    foreach ($auteurs as $auteur) {
      echo "<option value='".$auteur->getId()."'>".$auteur->getPrenom()." ".$auteur->getNom()."</option>";
    }
    ?>
  </select><br>
  <label for="Genre">Genre : </label>
  <select type="text" id="Genre" name="Genre" value="<?= $livre->getGenre() ?>" required>
    <?php
    foreach ($genres as $genre) {
      echo "<option value='".$genre->getId()."'>".$genre->getNom()."</option>";
    }
    ?>
  </select><br>
  <input type="submit" value="Enregistrer" name="EnregistrerModifs">
</form>

