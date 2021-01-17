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

        $cgu_non="";
        $perte_mdp="";
        $LesDeuxMDPSontFaux="";
        $ChangementCouleurFormulaire ="";
        $UnCompteExciseteDeja ="";

        session_start(); // On ferme toutes les sessions possible
        session_destroy(); // On ferme toutes les sessions possible

        require('function/str_to_noaccent.php');

        session_start();

        $leCompteExiste = "none";

        if(!empty($_POST["Inscription"])) {

            $cgu = $_POST['cgu']; // Checkbox coché ou pas ?
            $perte_mdp = $_POST['perte_mdp']; // Checkbox coché ou pas ?

            $UserMdp = $_POST['mdp']; // Récupération mdp champ 1
            $mdp_deuxieme = $_POST['mdp_deuxieme']; // Récupération mdp champ 2

            if($cgu == "cgu_non"){
                $cgu_non = "color:red!important;";
            }

            if($perte_mdp == "perte_mdp_non"){
                $perte_mdp = "color:red!important;";
            }

            if($UserMdp != $mdp_deuxieme){
                $LesDeuxMDPSontFaux ="<p style='color:red; margin-top:10px;'>Les deux mots de passe ne correspondents pas. </p>";
                $ChangementCouleurFormulaire =" border-bottom: 1px solid red !important; ";
            }

            if($cgu == "cgu_oui" && $perte_mdp == "perte_mdp_oui" && $UserMdp == $mdp_deuxieme) {


                require_once('back/bdd.php');

                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $email = $_POST['email'];
    
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
                    $UnCompteExciseteDeja = "Vous avez déja un compte. <a href='connexion.php'> Se connecter </a>";
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
            else{ // Sinon on fait rien

            }
        }

    ?>

    <?php
        include("file_insert/navbar.php");
    ?>

    <div class="zone_inscription">
        <div class="container_flex">
            <div class="delimitation_flex_inscription">      
                <div class="max_width_formulaire_inscription">      
                    <div class="container_creation">
                        <h1 class="inscription_h1"> Créer votre compte <span class="couleur_txt_bleu"> Gratuit </span> </h1>
                        <?= $UnCompteExciseteDeja ?>
                        <form method="POST">

                            <div class="flex_elements_inscription espacement_generale_inscription">
                                <div class="">
                                    <label style="display:none;" for="prenom"> Prenom : </label>
                                    <input class="input_inscription" id="prenom" type="text" name="prenom" placeholder="Prénom" maxlength="45" required>
                                </div>
                                <div class="">
                                    <label style="display:none;" for="nom"> Nom : </label>
                                    <input class="input_inscription" id="nom" type="text" name="nom" placeholder="Nom de famille" maxlength="45" required>
                                </div>
                            </div>

                            <div class="espacement_generale_inscription">
                                <label style="display:none;" for="email"> Email : </label>
                                <input class="input_inscription input_width_max" id="email" type="email" name="email" placeholder="Email" maxlength="45" required>
                            </div>

                            <div class="espacement_generale_inscription">
                                <label style="display:none;" for="mdp"> Mot de passe : </label>
                                <input class="input_inscription input_width_max" id="mdp" type="password" name="mdp" placeholder="Mot de passe" maxlength="45" required>
                            </div>

                            <div class="espacement_generale_inscription">
                                <label style="display:none;" for="mdp_deuxieme"> Saisissez le mot de passe de nouveau : </label>
                                <input class="input_inscription input_width_max" style="<?= $ChangementCouleurFormulaire ?>" id="mdp_deuxieme" type="password" name="mdp_deuxieme" placeholder="Saisissez le mot de passe de nouveau" maxlength="45" required>
                            </div>

                            <?= $LesDeuxMDPSontFaux ?>

                            <div class="espacement_generale_inscription">
                                <input type="hidden" name="perte_mdp" value="perte_mdp_non">
                                <input type="checkbox" name="perte_mdp" value="perte_mdp_oui">
                                <label class="label_inscription" style="<?= $perte_mdp ?>"> Je comprends que si je perds mon mot de passe, je pourrais perdre mes données. En apprendre davantage sur notre <a href="#" class="a_unstyle_bleu_bold" style="<?= $perte_mdp ?>"> chiffrement de données </a> </label>
                            </div>

                            <div class="espacement_generale_inscription">
                                <input type="hidden" name="cgu" value="cgu_non">
                                <input type="checkbox" name="cgu" value="cgu_oui">
                                <label class="label_inscription" style="<?= $cgu_non ?>"> J'accepte les <a href="#" class="a_unstyle_bleu_bold" style="<?= $cgu_non ?>"> Conditions générales d'utilisation </a> de P-NAS </label>
                            </div>

                            <div class="espacement_generale_inscription position_btn_inscription btn_bottom_inscription">
                                <button class="btn_inscription" type="envoyer" name="Inscription" value="Envoyer"> Créer mon compte </button>
                            </div>
                        </form>
                    </div>

                    <div class="emplacement_connexion">
                        <p class="txt_compte_inscription"> Avez-vous un compte ? <a class="a_unstyle_white_inscription" href="connexion.php"> Connexion </a> </p>
                    </div>
                </div>
            </div>

            <div class="delimitation_flex_inscription">
                <div>
                    <div>
                        <h2 class="max_width_txt_inscription"> Nous avons un <span class="bold_txt"> système d'encryptage </span> très complexe, veillez à bien enregistrer votre mot de passe ! <h2>
                    </div>
                </div>
                <div class="centrer_img_inscription">
                    <img class="reponsive_image_inscription" src="img/inscription_graphismes.png" alt="illustration système d'encryptage"/>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

