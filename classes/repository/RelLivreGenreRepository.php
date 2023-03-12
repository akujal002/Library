<?php

class RelLivreGenreRepository {
  // Attributs
  private $_db;

  // Constructeur
  public function __construct(){
    $Database = new Database();
    $this->_db = $Database->getBDD();
  }

  public function getIdGenre($Id_livre){
    // Récupère l'id de l'auteur dans la table relationlivreauteur en fonction de l'id du livre
    $sql = "SELECT Id_Genres FROM relationlivresgenres WHERE Id_livres=:Id_livre;";
    $req = $this->_db->prepare($sql);
    $req->execute([":Id_livre" => $Id_livre]);

    $idGenre = $req->fetchAll(PDO::FETCH_ASSOC);

    return $idGenre;
  }

  public function getIdLivres($id_Genre){
    // Récupère l'id de l'auteur dans la table relationlivreauteur en fonction de l'id du livre
    $sql = "SELECT Id_Livres FROM relationlivresgenres WHERE Id_Genres=:id_Genre;";
    $req = $this->_db->prepare($sql);
    $req->execute([":id_Genre" => $id_Genre]);

    $idLivres = $req->fetchAll(PDO::FETCH_ASSOC);

    return $idLivres;
  }
}
