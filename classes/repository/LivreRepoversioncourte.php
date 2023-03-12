<?php

class LivreRepository {
  // Attributs
  private $_db;

  // Constructeur
  public function __construct(){
    $Database = new Database();
    $this->_db = $Database->getBDD();
  }
  // Méthodes CRUD
  // Get All
  public function getAllLivres(){
    $sql = "SELECT * FROM livres";
    $requete = $this->_db->query($sql);
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultat as $ligne => $infos) {
      // Récupérer l'ID de l'auteur dans la table relationlivresauteurs


      $tousLesLivres[$ligne] = new Livre($infos);
    }

    return $tousLesLivres;
  }
  // Get one
  public function getOneLivre($id_livre){
    $sql = "SELECT livres.Id, Titre, Date_publi, Stock, Resume, Nom, Prenom
            FROM livres, relationlivresauteurs Rel, auteurs
            WHERE livres.Id = Rel.Id_Livres
            AND Rel.Id_Auteurs = auteurs.Id
            AND auteurs.Nom = 'Baudelaire';";
    $requete = $this->_db->prepare($sql);
    $requete->execute();
    $infos = $requete->fetchAll(PDO::FETCH_ASSOC);


    $Livre = new Livre($infos);

    return $Livre;
  }
  // Create
  // Update
  // Delete
}



























SELECT * FROM `livres` WHERE Id = (
    SELECT Id_Livres
    FROM relationlivresauteurs
    WHERE Id_Auteurs = (
        SELECT Id
        FROM auteurs
        WHERE Nom = "Baudelaire")
    );

SELECT * FROM livres, relationlivresauteurs Rel, auteurs
WHERE livres.Id = Rel.Id_Livres
AND Rel.Id_Auteurs = auteurs.Id
AND auteurs.Nom = "Baudelaire";

SELECT livres.Id, Titre, Date_publi, Stock, Resume, Nom, Prenom
FROM livres, relationlivresauteurs Rel, auteurs
WHERE livres.Id = Rel.Id_Livres
AND Rel.Id_Auteurs = auteurs.Id
AND auteurs.Nom = "Baudelaire";
