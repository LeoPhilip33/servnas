<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>


    <?php

    require 'bdd.php';
    session_start();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $Login = $_POST['Login'];
        $Pass = $_POST['Pass'];

        if($Login == "ExoSlash" && $Pass == "Amandedu33" || $Login == "Pilmax" && $Pass == "Chatchien290901" ) {
            echo "Le compte est bien identifié";
            $_SESSION["Login"] = $Login;
            header("location:admin.php");   
        }

        else {
            echo "Vous n'êtes pas connecté";     
        }
    }
    ?>

    <section class="form_container">
        <form class="w-25" method="POST">
            <div class="form-group">
                <label for="email"> Email : </label>
                <input class="form-control" id="email" type="text" name="Email" placeholder="Email" maxlength="45">
            </div>
            <div class="form-group">
                <label for="mdp"> Mot de passe : </label>
                <input class="form-control" id="mdp" type="password" name="Pass" placeholder="Mot de passe" maxlength="45">
            </div>
            <button class="btn btn-green" type="envoyer" value="Envoyer"> Connexion </button>
        </form>
    </section>
</body>
</html>