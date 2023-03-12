<?php

function ChargerClasses($classe){
  if (file_exists("../classes/".$classe.".php")) {
    require "../classes/".$classe.".php";
  } else if (file_exists("../classes/repository/".$classe.".php")) {
    require "../classes/repository/".$classe.".php";
  }
}


spl_autoload_register('ChargerClasses');

session_start();
header("HTTP/1.1 200 Found");
require "../config.php";
if ($CONFIG['DATABASE_READY'] === FALSE ) {
  $db = new Database();
  $reponse = $db->initialisationBDD($CONFIG);

  echo $reponse;
}
