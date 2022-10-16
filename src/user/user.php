<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
   <form action="login.php" method="post">

        <h2>Bonjour</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>Username</label>

        <input type="text" name="uname" placeholder="comment tu t'appelles, JF?"><br>

        <label>Password</label>

        <input type="password" name="password" placeholder="à l'abri des regards évidemment"><br> 

        <button type="submit">Login</button>
</body>
</html>