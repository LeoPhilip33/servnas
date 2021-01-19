<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title> Dashboard </title>
    </head>
    <body>

    <?php        
        session_start();

        if (!isset($_SESSION["email"])) {
            header('Location:connexion.php');
        }

        $emailUtilisateur = $_SESSION["email"];

        $dossierUser = $_SESSION["dossierUser"];
        $tableUser = $_SESSION["tableUser"];

        require 'back/bdd.php';

        $sql = "SELECT * FROM $tableUser";
        $query = $connection->prepare($sql); // On prépare la requête
        $query->execute(); // On exécute la requête
        $result = $query->fetchAll(PDO::FETCH_ASSOC); // On stocke le résultat dans un tableau associatif

        foreach($result as $produit){
            $nomFichier = $produit['nomfichier'];
            echo "<a href='upload/".$dossierUser."/".$nomFichier."' download='".$nomFichier."'> " . $nomFichier." </a> <br>";
        }
    ?>

    <div class="dashboard_container">
        <div class="barre_alterale">
            <div class="margin_top_logo_dashboard">
                <img class="logo_width_dashboard" src="img/logo.png" alt="Logo P-NAS" />
            </div>
            <div>
                <div class="margin_items_dashboard_left">
                    <img class="items_width_dashboard" src="img/dashboard/liens.png" alt="Logo P-NAS" />
                </div>
                <div class="margin_items_dashboard_left">
                    <img class="items_width_dashboard" src="img/dashboard/poubelle.png" alt="fichier partagé" />
                </div>
                <div class="margin_items_dashboard_left">
                    <img class="items_width_dashboard" src="img/dashboard/parametres.png" alt="fichier mis à la poubelle" />
                </div>
            </div>
        </div>
        <div class="barre_laterale_couleur">
            <div>
                <h1 class="h1_dashboard"> P-NAS Cloud </h1>
            </div>
        </div>
        <div class="max_width_top_app">
            <div class="top_app">
                <div class="flex_elements_top_app">
                    <div class="espacement_elements_top_app">
                        <p class="color_email_utilisateur"> <?= $emailUtilisateur ?> </p>
                    </div>
                    <div class="center_btn_deconnexion_dash">
                        <a href="connexion.php">
                            <button class="btn_deconnexion_dashboard" type="button" > Déconnexion </button>
                        </a>
                    </div>
                <div>
            </div>
        </div>
    </div>


    <?php
        echo '<a href="uploadfile.php"> UploadFile </a> <br>';
        echo '<a href="profile.php"> Profile </a>';
    ?>

    </body>
</html>