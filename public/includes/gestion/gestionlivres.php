<?php

$repo_livre = new LivreRepository();
$livres = $repo_livre->getAllLivres();
?>

<h2>Gestion des livres</h2>

<?php
// On regarde quelle action est à faire :
if ($formaction == "creer") {
  require "formLivre/creer.php";
} else if ($formaction == "rechercher") {
  require "formLivre/rechercher.php";
} else if ($formaction == "modifier") {
  require "formLivre/modifier.php";
} else{
  // On affiche la liste de tous les livres :

  // Si la suppression d'un livre s'est bien passée :
  if (isset($_GET['livre']) && $_GET['livre'] == "supprimé") {
    echo "<div style='background-color: aquamarine;text-align: center;padding: 10px;'>Le livre a bien été supprimé</div>";
  }
  if (isset($_GET['livre']) && $_GET['livre'] == "créé") {
    echo "<div style='background-color: aquamarine;text-align: center;padding: 10px;'>Le livre a bien été créé</div>";
  }
  if (isset($_GET['livre']) && $_GET['livre'] == "modifié") {
    echo "<div style='background-color: aquamarine;text-align: center;padding: 10px;'>Le livre a bien été modifié</div>";
  }
?>
<table>
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col">Genre</th>
      <th scope="col">Date de publication</th>
      <th scope="col">Résumé</th>
      <th scope="col">Nb d'exemplaires</th>
      <th scope="col">outils</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($livres as $livre) { ?>
  <tr>
    <td scope="row"><?= $livre->getTitre() ?></td>
    <td><?= $livre->getAuteur() ?></td>
    <td><?= $livre->getGenre() ?></td>
    <td><?= $livre->getDate_publi() ?></td>
    <td><?= $livre->getResume() ?></td>
    <td><?= $livre->getStock() ?></td>
    <td>
      <form action="<?= $CONFIG['URL_SITE'] ?>/gestion/livres/?action=modifier" method="post">
        <input type="hidden" name="Id_Livre" value="<?= $livre->getId() ?>">
        <input type="submit" value="modifier" name="Modifier">
      </form>
      <form action="<?= $CONFIG['URL_SITE'] ?>/gestion/livres/?action=supprimer" method="post">
        <input type="hidden" name="Id_Livre" value="<?= $livre->getId() ?>">
        <input type="submit" value="supprimer" name="Supprimer">
      </form>
    </td>
  </tr>
<?php }

?>

  </tbody>
</table>
<?php
}
// $repo_livre->getOneLivre(2);
?>
