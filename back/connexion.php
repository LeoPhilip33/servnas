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

<form class="formcont" method="POST">
    <label> Email : </label>
    <input type="text" name="Login" placeholder="Mot de passe" maxlength="45">

    <label> Mot de passe : </label>
    <input type="password" name="Pass" placeholder="Mot de passe" maxlength="45">

    <button type="envoyer" value="Envoyer"> Connexion </button>
</form>