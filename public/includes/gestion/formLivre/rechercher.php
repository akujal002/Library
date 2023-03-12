<?php
?>
<h2>Faire une recherche</h2>
<form action="#?action=rechercher" method="POST">
  <label for="requete">Indiquez vos mots-clefs : </label>
  <input type="text" id="requete" name="requete" required>
  <input type="submit" id="recherche" name="recherchelivres" value="Rechercher" required>
</form>
<?php
if (!isset($retourrecherche)) {
echo "<br><br> Aucun Résultat. Cette recherche ne permet pas de chercher par auteur ou genre. Pas encore... ;)";
}else {
?>
  <br><br>
  <table>
    <thead>
      <tr>
        <th scope="col">Titre</th>
        <th scope="col">Auteur</th>
        <th scope="col">Genre</th>
        <th scope="col">Date de publication</th>
        <th scope="col">Résumé</th>
        <th scope="col">Nb d'exemplaires</th>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach ($retourrecherche as $livre) { ?>
    <tr>
      <td scope="row"><?= $livre->getTitre() ?></td>
      <td><?= $livre->getAuteur() ?></td>
      <td><?= $livre->getGenre() ?></td>
      <td><?= $livre->getDate_publi() ?></td>
      <td><?= $livre->getResume() ?></td>
      <td><?= $livre->getStock() ?></td>
    </tr>
  <?php } ?>

    </tbody>
  </table>
<?php }
