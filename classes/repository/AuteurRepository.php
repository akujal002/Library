<?php
class AuteurRepository {
  // Attributs
  private $_db;

  // Constructeur
  public function __construct(){
    $Database = new Database();
    $this->_db = $Database->getBDD();
  }

  public function getAllAuteurs(){
    $sql = "SELECT * FROM auteurs";

    $req = $this->_db->prepare($sql);
    $req->execute();

    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultat as $key => $infos) {
      $auteurs[$key] = new Auteur($infos);
    }
    return $auteurs;
  }

  public function getAuteur($id_livre){
    $sql = "SELECT * FROM auteurs WHERE Id = (
              SELECT Id_Auteurs FROM relationlivresauteurs WHERE Id_Livres = :id_livre);";
    $req = $this->_db->prepare($sql);
    $req->execute([':id_auteur'=>$id_livre]);

    $infos = $req->fetchAll(PDO::FETCH_ASSOC);

    $auteur = new Auteur($infos[0]);
    return $auteur;
  }

  public function createAuteur($nom, $prenom, $dateVie){
    $sql = 'INSERT INTO Auteurs(Nom, Prenom, Dates_vie) VALUES (:Nom, :Prenom, :Dates_vie)';
    try {
      $req = $this->_db->prepare($sql);
      $req->execute([
      ':nom'=>$nom,
      ':prenom'=>$prenom,
      ':Dates_vie'=>$dateVie
             ]);
    } catch(PDOException $e){
      echo "erreur d'enregistrement : " . $e->getMessage();
    }
  }


}
