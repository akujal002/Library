<?php

final class Database {

  private $_db;

  //constructeur
  public function __construct(){
    require "../config.php";
    $this->connexionDB($CONFIG);
  }
  //methodes

  private function connexionDB($CONFIG){
    try {
      $dsn = "mysql:host=" . $CONFIG['DB_HOST'] . ";dbname=" . $CONFIG['DB_NAME'];
      $this->_db = new PDO($dsn,$CONFIG['DB_USER'],$CONFIG['DB_MDP'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    }catch(PDOException $erreur){
      echo "Erreur de connexion : " . $erreur->getMessage();
    }
  }

  public function getBDD(){
    return $this->_db;
  }

  public function closeBDD(){
    $this->_db = NULL;
  }

  public function initialisationBDD($CONFIG){
    if ( $CONFIG['URL_SITE'] == "http://biblio") {
      echo "Merci de modifier le fichier config.php pour lancer l'installation du site.";
      die;
    }
    $sql = file_get_contents('../Ressources/biblio_remplie.sql');
    try {
      $retour = $this->_db->query($sql);

      // On poursuis en modifiant de fichier config.php :
      require_once "../config.php";
      $CONFIG['DATABASE_READY'] = TRUE;

      $conf = fopen('../config.php', 'w');
      $contenu = '<?php
      $CONFIG[\'URL_SITE\'] = "'.$CONFIG['URL_SITE'].'"; // en prod, ce sera https://biblio.com
      $CONFIG[\'DATABASE_READY\'] = '.$CONFIG['DATABASE_READY'].';
      $CONFIG[\'DB_HOST\'] = "'.$CONFIG['DB_HOST'].'";
      $CONFIG[\'DB_NAME\'] = "'.$CONFIG['DB_NAME'].'";
      $CONFIG[\'DB_USER\'] = "'.$CONFIG['DB_USER'].'";
      $CONFIG[\'DB_MDP\'] = "'.$CONFIG['DB_MDP'].'";';

      fwrite($conf, $contenu);

      return "Installation de la Base de Données terminé !";
    } catch (PDOException $e) {
      "impossible de remplir la Base de données : " . $e->getMessage();
    }
  }

  public function desinstallationBDD(){
    // code sql de suppression des tables de la BDD
  }
}
