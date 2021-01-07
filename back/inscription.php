<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title> Inscription </title>
</head>
<body>
    <?php

        if(!empty($_POST["Inscription"])) {

            require_once('bdd.php');

            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $UserMdp = $_POST['mdp']; //Récupération mdp

            $mdp = sha1($UserMdp); // Hashage en md5 du mdp

            $code_secret_folder = substr($mdp, -5); // fait une coupure de 4 charactères

            mkdir("../upload/".$nom.".".$prenom."_".$code_secret_folder);

            $sql = "INSERT INTO user (prenom, nom, email, mdp) VALUES (:prenom, :nom, :email, :mdp)";

            $pdo_statement = $connection->prepare($sql);
        
            $result = $pdo_statement->execute(array( ':prenom'=>$_POST['prenom'], ':nom'=>$_POST['nom'], ':email'=>$_POST['email'], ':mdp'=>$mdp ));

            header("location:../dashboard.php");
        }

    ?>
    <section class="form_container">
        <form class="w-25" method="POST">
            <div class="form-group">
                <label for="nom"> Nom : </label>
                <input class="form-control" id="nom" type="text" name="nom" placeholder="Nom" maxlength="45">
            </div>
            <div class="form-group">
                <label for="prenom"> Prenom : </label>
                <input class="form-control" id="prenom" type="text" name="prenom" placeholder="Prenom" maxlength="45">
            </div>
            <div class="form-group">
                <label for="email"> Email : </label>
                <input class="form-control" id="email" type="text" name="email" placeholder="Email" maxlength="45">
            </div>
            <div class="form-group">
                <label for="mdp"> Mot de passe : </label>
                <input class="form-control" id="mdp" type="password" name="mdp" placeholder="Mot de passe" maxlength="45">
            </div>
            <button class="btn btn-green" type="envoyer" name="Inscription" value="Envoyer"> Inscription </button>
            <a class="compte_link" href="connexion.php">Déjà un compte? Connectez-vous!</a>
        </form>
    </section>
</body>
</html>

