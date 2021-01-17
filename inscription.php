<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> Inscription - Pnas</title>
</head>
<body>
    <?php
        session_start(); // On ferme toutes les sessions possible
        session_destroy(); // On ferme toutes les sessions possible

        require('function/str_to_noaccent.php');

        session_start();

        $leCompteExiste = "none";

        if(!empty($_POST["Inscription"])) {

            require_once('back/bdd.php');

            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $UserMdp = $_POST['mdp']; //Récupération mdp

            $sql = "SELECT * FROM user";
            $query = $connection->prepare($sql); // On prépare la requête
            $query->execute(); // On exécute la requête
            $result = $query->fetchAll(PDO::FETCH_ASSOC); // On stocke le résultat dans un tableau associatif

            foreach($result as $produit){
                $emailUserBdd = $produit['email'];

                if ($emailUserBdd == $email) {
                    $leCompteExiste = "true";
                }
            }
            if ($leCompteExiste == "true") {
                echo "Compte non créé car un compte est déja enregistré avec cette adresse email";
            } 
            elseif ($leCompteExiste == "none") {

                $mdp = sha1($UserMdp); // Hashage en md5 du mdp
                $code_secret_folder = substr($mdp, -10); // fait une coupure de 10 charactères

                $_SESSION["nom"] = $nom; // On récupère le nom est prénom dans les session avant d'enlever les accents
                $_SESSION["prenom"] = $prenom; // On récupère le nom est prénom dans les session avant d'enlever les accents

                $nom = str_to_noaccent($nom); // On enlève les accents
                $prenom = str_to_noaccent($prenom); // On enlève les accents
                
    
                $dossierUser = $nom.".".$prenom."_".$code_secret_folder;
                mkdir("upload/".$dossierUser);
    
                $creationVariable = "tableuser_".$nom.$prenom.$code_secret_folder;
                $sql = <<<EOSQL
                CREATE TABLE $creationVariable (
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    nomfichier TEXT NOT NULL
                ) ENGINE=InnoDB
                EOSQL;
                $res = $connection->exec($sql);
     
                $sql = "INSERT INTO user (prenom, nom, email, mdp) VALUES (:prenom, :nom, :email, :mdp)";
                $pdo_statement = $connection->prepare($sql);
                $result = $pdo_statement->execute(array( ':prenom'=>$_POST['prenom'], ':nom'=>$_POST['nom'], ':email'=>$_POST['email'], ':mdp'=>$mdp ));
    

                $_SESSION["email"] = $email;
                $_SESSION["tableUser"] = $creationVariable;
                $_SESSION["dossierUser"] = $dossierUser;
    
                header("location:dashboard.php");
            }
        }

    ?>

    <div class="zone_inscription">

    <div>
        
    <form method="POST">
            <div class="">
                <label for="nom"> Nom : </label>
                <input class="" id="nom" type="text" name="nom" placeholder="Nom" maxlength="45" required>
            </div>
            <div class="">
                <label for="prenom"> Prenom : </label>
                <input class="" id="prenom" type="text" name="prenom" placeholder="Prenom" maxlength="45" required>
            </div>
            <div class="">
                <label for="email"> Email : </label>
                <input class="" id="email" type="email" name="email" placeholder="Email" maxlength="45" required>
            </div>
            <div class="">
                <label for="mdp"> Mot de passe : </label>
                <input class="" id="mdp" type="password" name="mdp" placeholder="Mot de passe" maxlength="45" required>
            </div>
            <button class="" type="envoyer" name="Inscription" value="Envoyer"> Inscription </button>
            <a class="" href="connexion.php">Déjà un compte? Connectez-vous!</a>
        </form>
    </div>

    </div>
</body>
</html>

