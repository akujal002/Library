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
    $sql = "SELECT livres.Id, Titre, Date_publi, Stock, livres.Resume, auteurs.Nom, Prenom,genres.Nom
            FROM livres, relationlivresauteurs RLA, auteurs, genres, relationlivresgenres RLG
            WHERE livres.Id = RLA.Id_Livres
            AND RLA.Id_Auteurs = auteurs.Id
            AND genres.Id = RLG.Id_Genres
            AND livres.Id = RLG.Id_Livres ;";
    $requete = $this->_db->prepare($sql);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_NUM);

    return $this->switch_resultat($resultat);
  }
  // Get one
  public function getOneLivre($id_livre){
    $sql = "SELECT livres.Id, Titre, Date_publi, Stock, livres.Resume, auteurs.Nom, Prenom,genres.Nom
            FROM livres, relationlivresauteurs RLA, auteurs, genres, relationlivresgenres RLG
            WHERE livres.Id = RLA.Id_Livres
            AND RLA.Id_Auteurs = auteurs.Id
            AND genres.Id = RLG.Id_Genres
            AND livres.Id = RLG.Id_Livres
            AND livres.Id = :id_livre ;";
    $requete = $this->_db->prepare($sql);
    $requete->execute([':id_livre'=>$id_livre]);
    $infos = $requete->fetchAll(PDO::FETCH_NUM);

    $retour = $this->switch_resultat($infos);
    return $retour[0];
  }
  // Create
  public function creerLivre($infos){
    // je pars du principe que dans le formulaire de création d'un nouveau livre, je ne peux que sélectionner des auteurs et des genres déjà existant. Si on veut entrer un nouvel auteur, il faudra d'abord aller sur le formulaire des auteurs, idem pour les genres. De cette manière, je n'ai qu'une commande sql à faire lors de l'enregistrement : pas besoin de vérifier d'abord si l'auteur existe ou s'il faut le créer...



    $sql="INSERT INTO livres (Titre, Date_publi, Stock, Resume) VALUES (:titre, :date_publi, :stock, :resume);
          SET @Last_Id = LAST_INSERT_ID();
          INSERT INTO relationlivresgenres (Id_Genres,Id_Livres) VALUES (:id_genre,@Last_Id);
          INSERT INTO relationlivresauteurs (Id_Auteurs,Id_Livres) VALUES (
            :id_auteur,@Last_Id);";
    try{
      $requete = $this->_db->prepare($sql);
      $requete->execute([':titre'=>$infos['Titre'],
                         ':date_publi'=>$infos['Date_publi'],
                         ':stock'=>$infos['Stock'],
                         ':resume'=>$infos['Resume'],
                         ':id_genre'=>$infos['Id_genre'],
                         ':id_auteur'=>$infos['Id_auteur'] ]);
      return TRUE;
    } catch (PDOException $e){
      echo "erreur d'enregistrement du livre : " .$e->getMessage();
    }
  }
  // Update
  public function modifierLivre(Array $infos){
    $retour1 = $this->supprimerLivre($infos['Id']);
    $retour2 = $this->creerLivre($infos);

    if($retour1 === TRUE && $retour2 === TRUE){
      return TRUE;
    }
  }
  // Delete
  public function supprimerLivre($Id_Livre){
    $sql = "DELETE FROM relationlivresauteurs WHERE Id_Livres = :Id_Livre;
            DELETE FROM relationlivresgenres WHERE Id_Livres = :Id_Livre;
            DELETE FROM livres WHERE Id = :Id_Livre; ";
    try{
      $requete = $this->_db->prepare($sql);
      $requete->execute([':Id_Livre'=>$Id_Livre]);

      return TRUE;
    } catch (PDOException $e){
      echo "erreur de suppression du livre : " .$e->getMessage();
    }
  }

  public function rechercherLivre(string $recherche){
    $sql = "SELECT livres.Id, Titre, Date_publi, Stock, livres.Resume, auteurs.Nom, Prenom,genres.Nom
FROM livres, relationlivresauteurs RLA, auteurs, genres, relationlivresgenres RLG
            WHERE livres.Id = RLA.Id_Livres
            AND RLA.Id_Auteurs = auteurs.Id
            AND genres.Id = RLG.Id_Genres
            AND livres.Id = RLG.Id_Livres
            AND livres.Titre LIKE :requete1
            OR livres.Id = RLA.Id_Livres
            AND RLA.Id_Auteurs = auteurs.Id
            AND genres.Id = RLG.Id_Genres
            AND livres.Id = RLG.Id_Livres
            AND livres.Resume LIKE :requete2;";
    $requete = $this->_db->prepare($sql);
    $requete->execute([':requete1'=>"%".$recherche."%",':requete2'=>"%".$recherche."%"]);
    $infos = $requete->fetchAll(PDO::FETCH_NUM);
    if (isset($infos[0])) {
      $Livres = $this->switch_resultat($infos);
    }else {
      $Livres = NULL;
    }

    return $Livres;
  }


  private function switch_resultat(Array $resultat){
    foreach ($resultat as $ligne => $infos) {
      foreach ($infos as $key => $value) {
        switch ($key) {
        case '0':
          $donnees['Id'] = $value;
          break;
        case '1':
          $donnees['Titre'] = $value;
          break;
        case '2':
          $donnees['Date_publi'] = $value;
          break;
        case '3':
          $donnees['Stock'] = $value;
          break;
        case '4':
          $donnees['Resume'] = $value;
          break;
        case '5':
          $donnees['Auteur'] = $infos[6] . " " . $infos[5];
          break;
        case '7':
          $donnees['Genre'] = $value;
          break;
      }
      }

      $tableau_livres[$ligne] = new Livre($donnees);
    }

    return $tableau_livres;
  }
}
