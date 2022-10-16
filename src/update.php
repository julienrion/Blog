<?php

  require_once "logic.php";
  // require_once "index.php";

  $id = $_GET['id'];

  if(isset($_POST["new_comment"])){

    $comment = $_REQUEST['comment'];
    $stmt = $pdo->prepare("UPDATE articles SET comment = :comment WHERE id = :id");
    $stmt->execute([':comment' => $comment, ':id' => $id]);

    header('Location: index.php');
    exit();
  }
  if(isset($_POST["delete_comment"])){
    $comment = $_REQUEST['comment'];

    $stmt = $pdo->prepare("UPDATE articles SET comment = :comment WHERE id = :id ");
    $stmt->execute([':id' => $id, ':comment' => NULL]);

    header('Location: index.php');
    exit();
  }

?>
