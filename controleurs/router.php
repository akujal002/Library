<?php
require "init.php";

$route = $_SERVER['REQUEST_URI'];
$routefinale = "";
$formaction = "";

// var_dump($_SERVER);

//
// Interface de gestion :
//  • livres
//  • réservations
//  • lecteurs
//

if (strpos($route, "gestion" )) {

  //
  // Interface de gestion des livres :
  //
  if (strpos($route, "livres" )) {
    $routefinale = "livres";
    //
    // Action à réaliser sur les livres :
    //
    if (strpos($route, "rechercher" )) {
      $formaction = "rechercher";
      if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['recherchelivres'])) {
          require "LivreController.php";
        }
      }
    }else if (strpos($route, "creer" )) {
      $formaction = "creer";
      if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        require "LivreController.php";
      }
    }else if (strpos($route, "modifier" )) {
      if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['EnregistrerModifs'])) {
          require "LivreController.php";

        }else if (isset($_POST['Modifier'])){
          $formaction = "modifier";
        }

      }
    }else if (strpos($route, "supprimer" )) {
      $formaction = "supprimer";
      if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        require "LivreController.php";
      }
    }

  }else if(strpos($route, "auteurs")){
    $routefinale = "auteurs";

  }  else if(strpos($route, "reservations")){
    $routefinale = "reservations";

  }else if(strpos($route, "lecteurs")){
    $routefinale = "lecteurs";
  }
  require "../public/includes/gestion/index.php";
}

else {
  require "../public/index.php";
}



