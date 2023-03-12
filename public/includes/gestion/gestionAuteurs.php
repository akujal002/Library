<?php

$repo_auteur = new AuteurRepository();

?>

<h2>Gestion des auteurs</h2>

<h2>Enregistrer un nouvel auteur</h2>

<form action="#" method="POST">
  <label for="nom">Nom de l'auteur : </label>
  <input type="text" id="Titre" name="nom" required><br>
  <label for="prenom">Prenom de l'auteur : </label>
  <input type="text" id="Titre" name="prenom" required><br>
  <label for="dateVie">Année de vie et de mort : </label>
  <input type="text" id="dateVie" name="dateVie" placeholder="AAAA - AAAA" required><br>
  <input type="submit" >
</form>

<?php

// if (isset($_POST['nom']) && ($_POST['prenom']) && ($_POST['dateVie'])) {
//     $nom = $_POST['nom'];
//     $prenom = $_POST['prenom']; 
//     $dateVie = $_POST['dateVie'];

//     $auteurs = $repo_auteur->createAuteur($nom, $prenom, $dateVie);
// }


?>