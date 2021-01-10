<?php
    session_start();

    if (!isset($_SESSION["email"])) {
        header('Location:connexion.php');
    }

    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $email = $_SESSION["email"];
    $tableUser = $_SESSION["tableUser"];
    $dossierUser = $_SESSION["dossierUser"];

    echo '<a href="dashboard.php"> Dashboard </a> <br>';
?>

<?php // Modification email

?>

<?php // Modification mot de passe

?>


<?php // Supprimer le compte

    if(!empty($_POST["supprimercompte"])) {
        $emailConfirmationCompteDelet = $_POST["emailconfirmationcomptedelet"];
        if ( $emailConfirmationCompteDelet ==  $email) {
            require_once('back/bdd.php');

            require('function/rmdir_recursive.php');
            rmdir_recursive("upload/".$dossierUser); // Suppression du dossier utilisateur en récurcif

            $dropTable = <<<EOSQL
                    DROP TABLE $tableUser 
                    EOSQL;
            $res = $connection->exec($dropTable);


            $UserDelet = "DELETE FROM user WHERE email='$email'";
            $connection->exec($UserDelet);

            echo "<p style='color:red;'>Votre compte vient d'être supprimé, vous allez être redirigé à la page d'inscription</p>";

            header('Refresh: 5; inscription.php');

        }
        else {
            echo "L'email informé est érroné, compte pas supprimé";
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Informations personnelles </title>
</head>
<body>

    <h1> Informations personnelles </h1>
    Votre nom : <?= $nom ?> <br>
    Votre nom : <?= $prenom ?> <br>
    Votre Email : <?= $email ?><br>

    <form method="POST">
        <label> Merci de retaper votre email pour pouvoir supprimer votre compte ( La suppression est définitive ) : </label>
        <input type="email" name="emailconfirmationcomptedelet" placeholder="email" />
        <button class="btn btn-green" type="envoyer" name="supprimercompte" value="Envoyer"> Supprimer le compte </button>
    </form>
    
</body>
</html>