<?php

class Livre {
  // Attributs
  private $_Id,
  $_Titre,
  $_Date_publi,
  $_Stock,
  $_Resume,
  $_Auteur,
  $_Genre;
  // Constructeur

  public function __construct(Array $infos){

    // hydrater les objets
    $this->hydrate($infos);


  }

  // Méthodes

  /**
   * Permet d'hydrater l'objet en appelant tous les setters
   * @param  Array  $infos Le tableau de données à associer
   */
  private function hydrate(Array $infos){

    foreach ($infos as $key => $value) {
      $methode = "set".ucfirst($key); // permet de savoir quel setter appeler

      if(method_exists($this, $methode)){
        $this->$methode($value);
      }
    }
    // récupérer deux valeurs, une clé et une valeur
    // la clé va me permettre de construire le setter
    // si le setter existe, je l'appelle en lui donnant la valeur à associer.
  }

  private function setId(int $Id){
    $this->_Id = $Id;
  }

  public function getId(){
    return $this->_Id;
  }

  private function setTitre(string $Titre){
    $Titre = htmlspecialchars($Titre);
    $this->_Titre = $Titre;
  }

  public function getTitre(){
    return htmlspecialchars_decode($this->_Titre);
  }

  private function setDate_publi($Date_publi){
    $this->_Date_publi = $Date_publi;
  }

  public function getDate_publi(){
    return $this->_Date_publi;
  }

  private function setStock(int $Stock){
    if ($Stock < 0) {
      $Stock = 0;
    }
    $this->_Stock = $Stock;
  }

  public function getStock(){
    return $this->_Stock;
  }

  private function setResume(string $Resume){
    $Resume = htmlspecialchars($Resume);
    $this->_Resume = $Resume;
  }

  public function getResume(){
    return htmlspecialchars_decode($this->_Resume);
  }

  private function setAuteur(string $Auteur){
    $this->_Auteur = htmlspecialchars($Auteur);
  }

  public function getAuteur(){
    return htmlspecialchars_decode($this->_Auteur);
  }

  private function setGenre(string $Genre){
    $this->_Genre = htmlspecialchars($Genre);
  }

  public function getGenre(){
    return htmlspecialchars_decode($this->_Genre);
  }

}
