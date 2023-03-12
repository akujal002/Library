<?php

//inscrire un nouvel auteur dans BDD
if (isset($_POST['nom']) && ($_POST['prenom']) && ($_POST['dateVie'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom']; 
    $dateVie = $_POST['dateVie'];
    $auteurs = $repo_auteur->createAuteur($nom, $prenom, $dateVie);
}

?>