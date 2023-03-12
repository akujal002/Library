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
      $relLivreAuteur = new RelLivreAuteurRepository();
      $id_auteur = $relLivreAuteur->getIdAuteur($infos['Id']);

      // Récupérer prénom et nom de l'auteur dans la table auteur
      $Auteur_Repo = new AuteurRepository();
      $infos['Auteur'] = $Auteur_Repo->getAuteur($id_auteur);

      // Récupérer l'Id du genre
      $relLivreGenre = new RelLivreGenreRepository();
      $id_genre = $relLivreGenre->getIdGenre($infos['Id']);

      // Récupérer le nom du genre
      $Genre_Repo = new GenreRepository();
      $infos['Genre'] = $Genre_Repo->getGenre($id_genre);

      $tousLesLivres[$ligne] = new Livre($infos);
    }

    return $tousLesLivres;
  }
  // Get one
  public function getOneLivre($id_livre){
    $sql = "SELECT * FROM livres WHERE id=:id_livre";
    $requete = $this->_db->prepare($sql);
    $requete->execute([':id_livre' => $id_livre]);
    $infos = $requete->fetchAll(PDO::FETCH_ASSOC);


    $sql = "SELECT Id_Auteurs FROM relationlivresauteurs WHERE Id_Livres=:id_livre;";
    $req = $this->_db->prepare($sql);
    $req->execute([":id_livre" => $id_livre]);

    $id_auteur = $req->fetch();

    // Récupérer prénom et nom de l'auteur dans la table auteur
    $sql = "SELECT Nom, Prenom FROM auteurs WHERE Id = :id_auteur;";
    $req = $this->_db->prepare($sql);
    $req->execute([':id_auteur'=>$id_auteur]);

    $infos = $req->fetAll(PDO::FETCH_ASSOC);

    $auteur = new Auteur($infos);
    $infos['Auteur'] = $auteur->getNom() . ' ' . $auteur->getPrenom();

    // Récupérer l'Id du genre
    $sql = "SELECT Id_Genres FROM relationlivresgenres WHERE Id_livres=:Id_livre;";
    $req = $this->_db->prepare($sql);
    $req->execute([":Id_livre" => $id_livre]);

    $id_genre = $req->fetch();

    // Récupérer le nom du genre
    $sql = "SELECT Nom, Prenom FROM genres WHERE Id = :id_genre;";
    $req = $this->_db->prepare($sql);
    $req->execute([':id_genre'=>$id_genre]);

    $infos = $req->fetAll(PDO::FETCH_ASSOC);

    $genre = new Genre($infos);
    $infos['Genre'] = $genre->getNom();


    // Et finalement :

    $Livre = new Livre($infos);

    return $Livre;
  }
  // Create
  // Update
  // Delete
}
