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

<?php
    // On écrit notre requête
    $sql = 'SELECT * FROM user';

    // On prépare la requête
    $query = $connection->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $produit){
        echo $produit['email'];
        echo $produit['mdp'];
    }
?>

<form class="formcont" method="POST">
    <label> Email : </label>
    <input type="text" name="Login" placeholder="Mot de passe" maxlength="45">

    <label> Mot de passe : </label>
    <input type="password" name="Pass" placeholder="Mot de passe" maxlength="45">

    <button type="envoyer" value="Envoyer"> Connexion </button>
</form>