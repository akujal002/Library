<?php

$repo_auteurs = new AuteurRepository();
$auteurs = $repo_auteurs->getAllAuteurs();
$repo_genres = new GenreRepository();
$genres = $repo_genres->getAllGenres();

?>
<h2>Enregistrer un nouveau livre</h2>

<form action="#" method="POST">
  <label for="Titre">Titre du livre : </label>
  <input type="text" id="Titre" name="Titre" required><br>
  <label for="Date_publi">Date de publication : </label>
  <input type="date" id="Date_publi" name="Date_publi" required><br>
  <label for="Resume">Résumé : </label>
  <textarea id="Resume" name="Resume" rows="5" required></textarea><br>
  <label for="Stock">Stock : </label>
  <input type="number" id="Stock" name="Stock" required><br>
  <label for="Auteur">Auteur : </label>
  <select type="text" id="Auteur" name="Auteur" required>
    <?php
    foreach ($auteurs as $auteur) {
      echo "<option value='".$auteur->getId()."'>".$auteur->getPrenom()." ".$auteur->getNom()."</option>";
    }
    ?>
  </select><br>
  <label for="Genre">Genre : </label>
  <select type="text" id="Genre" name="Genre" required>
    <?php
    foreach ($genres as $genre) {
      echo "<option value='".$genre->getId()."'>".$genre->getNom()."</option>";
    }
    ?>
  </select><br>
  <input type="submit" value="Enregistrer" name="Creer">
</form>
