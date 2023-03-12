<?php

class Genre{
  // Attributs
  private $_Id,
  $_Nom,
  $_Resume;
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

  private function setNom(string $Nom){
    $Nom = htmlspecialchars($Nom);
    $this->_Nom = $Nom;
  }

  public function getNom(){
    return htmlspecialchars_decode($this->_Nom);
  }

  private function setResume(string $Resume){
    $Resume = htmlspecialchars($Resume);
    $this->_Resume = $Resume;
  }

  public function getResume(){
    return htmlspecialchars_decode($this->_Resume);
  }
}
