<?php

require_once "index.php";

  $fetch = array();

  try{
    $pdo= new PDO('mysql:host=db:3306;dbname=data', 'root', 'root');
  } catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  };

  $id = $_GET['id'];
  $comment = $_REQUEST['comment'];

  $stmt = $pdo->prepare("UPDATE articles SET comment = NULL WHERE id = :id");
  $stmt->execute([
    ':id' => $id,
    ':comment' => $comment
  ]);
  $fetch = $stmt->fetch();
  var_dump($id)
  // header("Location: index.php");


?>
