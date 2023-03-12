<?php

class GenreRepository{
  // Attributs
  private $_db;

  // Constructeur
  public function __construct(){
    $Database = new Database();
    $this->_db = $Database->getBDD();
  }

  public function getAllGenres(){
    $sql = "SELECT * FROM genres";

    $req = $this->_db->prepare($sql);
    $req->execute();

    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultat as $key => $infos) {
      $genres[$key] = new Genre($infos);
    }
    return $genres;
  }

  public function getGenre($id_livre){
    $sql = "SELECT * FROM genres WHERE Id = (
              SELECT Id_Genres FROM relationlivresgenres WHERE Id_Livres = :id_livre)";
    $req = $this->_db->prepare($sql);
    $req->execute([':id_livre'=>$id_livre]);

    $infos = $req->fetAll(PDO::FETCH_ASSOC);

    $genre = new Genre($infos[0]);
  }


}
