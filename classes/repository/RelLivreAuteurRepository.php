<?php

class RelLivreAuteurRepository {
  // Attributs
  private $_db;

  // Constructeur
  public function __construct(){
    $Database = new Database();
    $this->_db = $Database->getBDD();
  }
  public function getIdAuteur($id_livre){
    // Récupère l'id de l'auteur dans la table relationlivreauteur en fonction de l'id du livre
    $sql = "SELECT Id_Auteurs FROM relationlivresauteurs WHERE Id_Livres=:id_livre;";
    $req = $this->_db->prepare($sql);
    $req->execute([":id_livre" => $id_livre]);

    $auteur = $req->fetchAll(PDO::FETCH_ASSOC);

    return $auteur;
  }

  public function getIdLivre($id_Auteur){
    // Récupère l'id de l'auteur dans la table relationlivreauteur en fonction de l'id du livre
    $sql = "SELECT Id_Livres FROM relationlivresauteurs WHERE Id_Auteurs=:id_Auteur;";
    $req = $this->_db->prepare($sql);
    $req->execute([":id_Auteur" => $id_Auteur]);

    $livre = $req->fetchAll(PDO::FETCH_ASSOC);

    return $livre;
  }
}
