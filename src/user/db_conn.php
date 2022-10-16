# setup 
<?php

$sname= "localhost";

$unmae= "root";

$password = "";

$db_name = "dump.sql";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

# gestion de l'échec de la connexion

if (!$conn) {

    echo "pas de chance";

}

# setup session/authentification

session_start(); 

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

# gestion des champs non remplis

 $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: index.php?error=il faut renseigner le champ chef");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=il faut renseigner le deuxième champ chef");

        exit();

    }else{

# confirmation de l'authentification

        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['user_name'] === $uname && $row['password'] === $pass) {

                echo "Bienvenue :)";

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: home.php");

                exit();

            }else{

# gestion des identifiants incorrects

                header("Location: index.php?error=les calculs sont pas bons");

                exit();

            }

        }else{

            header("Location: index.php?error=les calculs sont pas bons");

            exit();

        }

    }

# ok

}else{

    header("Location: create.php");

    exit();

}

