<?php

// Enregistrement d'un nouveau livre en base de données :
if (isset($_POST['Creer']) && isset($_POST['Titre']) && isset($_POST['Date_publi']) && isset($_POST['Resume']) && isset($_POST['Stock']) && isset($_POST['Auteur']) && isset($_POST['Genre'])) {

  $infos = ["Titre"=>$_POST['Titre'],
            "Date_publi"=>$_POST['Date_publi'],
            "Resume"=>$_POST['Resume'],
            "Stock"=>$_POST['Stock'],
            "Id_auteur"=>$_POST['Auteur'],
            "Id_genre"=>$_POST['Genre']];

            //echo $_POST['Titre'];
        if (str_contains($_POST['Titre'], "<script>") == true) {
          echo 'Veuillez indiquer un autre nom pour ce livre';
        } else {
            $repo_livre = new LivreRepository();
            $retourcreation = $repo_livre->creerLivre($infos);
   
        if  ($retourcreation === TRUE){
    header('location:'.$CONFIG['URL_SITE'].'/gestion/livres/?livre=créé');
    exit();
  }}
}

// Modification d'un livre
if (isset($_POST['EnregistrerModifs'])&& isset($_POST['Id_Livre']) && isset($_POST['Titre']) && isset($_POST['Date_publi']) && isset($_POST['Resume']) && isset($_POST['Stock']) && isset($_POST['Auteur']) && isset($_POST['Genre'])) {

  $infos = ["Id"=>$_POST['Id_Livre'],
            "Titre"=>$_POST['Titre'],
            "Date_publi"=>$_POST['Date_publi'],
            "Resume"=>$_POST['Resume'],
            "Stock"=>$_POST['Stock'],
            "Id_auteur"=>$_POST['Auteur'],
            "Id_genre"=>$_POST['Genre']];

  $repo_livre = new LivreRepository();
  $retourmodification = $repo_livre->modifierLivre($infos);
  if ($retourmodification === TRUE) {
    header('location:'.$CONFIG['URL_SITE'].'/gestion/livres/?livre=modifié');
    exit();
  }
}


// Suppression d'un livre
if (isset($_POST['Supprimer']) && isset($_POST['Id_Livre'])) {
  $repo_livre = new LivreRepository();
  $retoursuppression = $repo_livre->supprimerLivre($_POST['Id_Livre']);
  if ($retoursuppression === TRUE) {
    header('location:'.$CONFIG['URL_SITE'].'/gestion/livres/?livre=supprimé');
    exit();
  }
}


// Faire une recherche
if (isset($_POST['recherchelivres']) && isset($_POST['requete'])) {
  $repo_livre = new LivreRepository();
  $retourrecherche = $repo_livre->rechercherLivre($_POST['requete']);

}
