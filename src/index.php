<?php
require_once 'logic.php';

session_start();


if (!empty($_POST)) {
    if (!empty($_POST['email'] && !empty($_POST['password']))) {

        $email = htmlspecialchars($_POST['email']);            // Stocker les Posts dans des htmlspecialcards pour éviter la faille xss
        $password = htmlspecialchars($_POST['password']); 
        
        $email = strtolower($email); // email transformé en minuscule
    
        $check = $pdo->prepare('SELECT email, password, token FROM users WHERE email = ?');      //On vérifie que la personne est bien inscrite sur notre base
        $check->execute(array($email));
        $data = $check->fetch();            // On stock les données dans data
        $row = $check->rowCount();         // On vérifie si il existe dans la table ou pas avec row
    
        // Si > à 0 alors l'utilisateur existe
        if($row > 0) {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password'])) {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $data['token'];
                    header('Location: blog.php');
                    die();
                }
            }
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container my-5 bg-secondary p-3">
        <div class="col">
            <div class="row">
            <h2 class="text-center">Connexion</h2>
            <div class="mb-3">
            <form method="POST" action="">
                <label for="mailInput" class="form-label">adresse mail</label>
                <input type="email" name="email" class="form-control" id="mailInput" placeholder="jf@example.com">
                </div>
                <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input class="form-control" type="password" name="password" id="">
                <button class="btn btn-primary my-5" type="submit">Connexion</button>
                <button class="btn btn-primary"><a class="nav-link" href="registration.php">Inscription</a></button>
            </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>