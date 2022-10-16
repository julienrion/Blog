<?php

  $fetch = array();

  try{
    $pdo= new PDO('mysql:host=db:3306;dbname=data', 'root', 'root');
  } catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  };

  $id = $_GET['id'];

  $stmt = $pdo->prepare("DELETE FROM articles WHERE id = :id");
  $stmt->execute([
    ':id' => $id
  ]);
  $fetch = $stmt->fetch();


  header("Location: index.php");
  echo "Post deleted succefully";

?>
