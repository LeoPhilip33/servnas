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

    echo $uniqueNameBdd;

    $filename = "upload/" . $uniqueNameBdd;

    $resultat = move_uploaded_file($tmpName, $filename);

    if ($resultat) {

        require_once('back/bdd.php');

        session_start();

        $nomfichier = $uniqueName;
        
        echo $uniqueName;

        $email = $_SESSION["email"];

        $sql = "INSERT INTO files (email, nomfichier, uniquename) VALUES (:email, :nomfichier, :uniquename)";

        $pdo_statement = $connection->prepare($sql);
    
        $result = $pdo_statement->execute(array( ':email'=>$email, ':nomfichier'=>$nomfichier, ':uniquename'=>$uniqueNameBdd ));

        echo "Transfert terminé !";
    }

}