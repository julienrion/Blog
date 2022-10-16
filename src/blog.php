<?php
  require_once "logic.php";

  session_start();

  if(isset($_SESSION['user'])) {
    $connexion = $pdo->prepare('SELECT * FROM users WHERE token = ?');
    $connexion->execute(array($_SESSION['user']));
  
    $fetch = $pdo->prepare('SELECT * FROM articles');
    $fetch->execute();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
 <?php if (isset($_SESSION['user'])) { ?>
    <div class="container">
      <div class="">
        <h3 class="btn btn-primary"><a class="nav-link" href="create.php">+ Create a new post +</a></h3>
        <a class="nav-link" href="deconnexion.php"><button class="btn btn-danger">Deconnexion</button></a>
      </div>

      <?php foreach($fetch as $f) { ?>
        <div class="card p-3 my-3">
          <h1 class=""><?= $f['title'] ?></h1>
          <div class="card-body">
            <h3><?= $f['content'] ?></h3>
            <form method="GET">
              <button class="btn btn-danger" name="delete_article"><a class="nav-link" href="delete.php?id=<?= $f['id']?>">Delete article</a></button>
            </form>

            <div class="mt-3 card-header ">
              <form class="" action="update.php?id=<?= $f['id']?>" method="POST">
                <div class="form-group">
                  <div class="form-group">
                    <p>=> <?= $f['comment'] ?></p>
                  </div>
                  <textarea class="form-control my-3" name="comment" id=""cols="28" rows="4" placeholder="comment"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-success" name="new_comment">Post commment</button>
                  <button class="btn btn-danger" name="delete_comment">Delete comment</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } else { ?>    
    <h1 class="text-center">Vous n'êtes pas connecté</h1>
  <?php } ?>


</body>
</html>
