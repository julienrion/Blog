<?php

require_once "logic.php";

if (isset($_POST['inscription'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $cost = ['cost' => 12];
        $email = strtolower($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $cost);
        $token = bin2hex(openssl_random_pseudo_bytes(64));

        $insert = $pdo->prepare('INSERT INTO users(email, password, token) VALUES(:email, :password, :token)');
        $insert->execute([
            ':email' => $email,
            ':password' => $password,
            ':token' => $token
        ]);
        header('location:index.php');
        die();
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Inscription</title>
</head>
<body>
    <div class="container bg-secondary my-5">
        <h2 class="text-center">Inscription</h2>
        <div class="mb-3">
        <form method="POST">
            <label for="mailInput" class="form-label">adresse mail</label>
            <input type="email" name="email" class="form-control" placeholder="jf@example.com">
            </div>
            <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input class="form-control" type="password" name="password">
            <button class="btn btn-primary my-5" name="inscription">s'inscrire</button>
            </div>
        </form>
    </div>
</body>
</html>