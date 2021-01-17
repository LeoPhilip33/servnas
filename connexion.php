<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title> Connexion - Pnas </title>
    </head>
    <body>
        <?php

            session_start(); // On ferme toutes les sessions possible
            session_destroy(); // On ferme toutes les sessions possible
            require 'back/bdd.php';
            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                require('function/str_to_noaccent.php');

                $Email = $_POST['Email'];
                $Pass = $_POST['Pass'];

                $sql = 'SELECT * FROM user'; // On écrit notre requête
                $query = $connection->prepare($sql); // On prépare la requête
                $query->execute(); // On exécute la requête
                $result = $query->fetchAll(PDO::FETCH_ASSOC); // On stocke le résultat dans un tableau associatif

                foreach($result as $produit){
                    if($produit['email'] == $Email && $produit['mdp'] == sha1($Pass)) {

                        $nom = $produit['nom'];
                        $prenom = $produit['prenom'];
                        $mdp = $produit['mdp'];
                        $code_secret_folder = substr($mdp, -10); // fait une coupure de 10 charactères

                        $nom = str_to_noaccent($nom); // On enlève les accents
                        $prenom = str_to_noaccent($prenom); // On enlève les accents

                        $creationVariable = "tableuser_".$nom.$prenom.$code_secret_folder;
                        $dossierUser = $nom.".".$prenom."_".$code_secret_folder;

                        $_SESSION["nom"] = $nom;
                        $_SESSION["prenom"] = $prenom;
                        $_SESSION["email"] = $Email;
                        $_SESSION["tableUser"] = $creationVariable;
                        $_SESSION["dossierUser"] = $dossierUser;

                        header("location:dashboard.php");
                    }
                    else{
                        echo "Auncun compte n'a été trouvé ! <a href='inscription.php'> M'inscrire </a>";
                        break;
                    }
                }
            }
        ?>

        <?php
            include("file_insert/navbar.php");
        ?>

        <div class="zone_connexion">
            <div class="delim_zone_con">
                <div class="">
                    <div>
                        <h1 class="connexion_h1"> Connectez-vous et profité de notre <span class="bold_txt"> rapidité de transfert </span> pour upload vos fichiers.<h1>
                    </div>
                    <div class="center_img_connexion">
                        <img class="reponsive_image_connexion" src="img/connexion_graphismes.png" alt="graphisme inscription" />
                    </div>
                </div>
            </div>
            <div class="delim_zone_con">
                <div class="max_width_connexion">
                    <form method="POST">
                        <div class="max_width_form_connexion">
                            <div class="connexiondesign">
                                <h2 class="connexion_title_modification"> Se connecter </h2>
                                <div class="espacement_generale_inscription change_width_connexion">
                                    <label style="display:none;" for="email"> Email : </label>
                                    <input class="input_inscription max_width_input_connexion" id="email" type="text" name="Email" placeholder="Votre adresse email" maxlength="45">
                                </div>
                                <div class="espacement_generale_inscription change_width_connexion">
                                    <label style="display:none;" for="mdp"> Mot de passe : </label>
                                    <input class="input_inscription max_width_input_connexion" id="mdp" type="password" name="Pass" placeholder="Mot de passe" maxlength="45" />
                                </div>
                                <div class="flex_MotDePasseOublie">
                                    <div>
                                        <img class="cadenas_width_connexion" src="img/lock.png" alt="cadenas" />
                                    </div>
                                    <div class="centrage_verticale_mdp_oublie">
                                        Mot de passe oublié ?
                                    </div>
                                </div>
                                <div class="btn_align_gauche_connexion">
                                    <button class="espacement_generale_inscription btn_connexion" type="envoyer" value="Envoyer"> Connexion </button>
                                </div>
                            </div>
                            <div class="emplacement_connexion">
                                <p class="txt_compte_inscription"> Avez-vous un compte ? <a class="a_unstyle_white_inscription" href="inscription.php"> Inscription </a> </p>
                            </div>
                        <div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>