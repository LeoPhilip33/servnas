<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> UPLOAD FILE </title>
    </head>
    <body>

    <a href="dashboard.php"> dashboard </a>
        <form method="POST" enctype="multipart/form-data">
        <input type="file" name="uploaded_file" /> <br />
        <input type="submit" name="submit"/>
    </body>
</html>

<?php


if (isset($_POST['submit'])) {

    $maxSize= 1000000000;

    if ( $_FILES['uploaded_file']['error'] > 0 ) {
        echo "Une erreur est survenue lors du transfert";
        die;
    }

    $filesSize = $_FILES['uploaded_file']['size']; // Permet de calculer la taille du fichier
    
    if ($filesSize > $maxSize) {
        echo "Le fichier est trop gros, il fait ".$filesSize." alors que la valeur maximum d'upload est de ".$maxSize;
        die;
    }

    $filename = $_FILES['uploaded_file']['name'];

    $tmpName = $_FILES['uploaded_file']['tmp_name'];

    $uniqueName = $filename;

    $uniqueNameBdd = md5(uniqid(rand(), true));

    session_start();

    require_once('back/bdd.php');

    $email = $_SESSION["email"];

    $sql = "SELECT * FROM user WHERE email='$email'"; // Exploitation de la table "user" ou l'email est égale à l'email de l'utilisateur actuellement connecté.

    $query = $connection->prepare($sql); // On prépare la requête

    $query->execute(); // On exécute la requête

    $result = $query->fetchAll(PDO::FETCH_ASSOC); // On stocke le résultat dans un tableau associatif

    foreach($result as $produit){
        $prenom = $produit['prenom'];
        $nom = $produit['nom'];
        $mdp = $produit['mdp'];
        echo "<br>";
    }

    $code_secret_folder = substr($mdp, -10); // Calcule du code secret utilisateur

    $filename = "upload/".$nom.".".$prenom."_".$code_secret_folder."/". $filename;

    $resultat = move_uploaded_file($tmpName, $filename);

    if ($resultat) {

        $nomfichier = $uniqueName;

        $sql = "INSERT INTO files (email, nomfichier, uniquename) VALUES (:email, :nomfichier, :uniquename)";

        $pdo_statement = $connection->prepare($sql);
    
        $result = $pdo_statement->execute(array( ':email'=>$email, ':nomfichier'=>$nomfichier, ':uniquename'=>$uniqueNameBdd ));

        echo "Transfert terminé !";
    }

}