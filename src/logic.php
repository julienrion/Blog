<?php

  try{
    $pdo= new PDO('mysql:host=db:3306;dbname=data', 'root', 'root');
  } catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  };

?>
