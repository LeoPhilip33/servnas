<?php
    $dsn = 'mysql:host=localhost;dbname=servnav'; // Met ou est heberger la BDD + donne le nom de la BDD
    $username = 'root'; // Met l'user dans une varaible
    $password = ''; // Met le MDP dans une variable
    try {
        $connection = new PDO($dsn, $username, $password); // On donne id et mdp pour se connecter
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $error) {
        die('Failed to connect : ' . $error->getMessage());
    }
?>