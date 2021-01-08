<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title> Connexion </title>
</head>
<body>
    <?php
        require 'bdd.php';
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
                    $creationVariable = "tableuser_".$nom.$prenom.$code_secret_folder;
                    $dossierUser = $nom.".".$prenom."_".$code_secret_folder;

                    $_SESSION["email"] = $Email;
                    $_SESSION["tableUser"] = $creationVariable;
                    $_SESSION["dossierUser"] = $dossierUser;

                    header("location:../dashboard.php");
                }
                else{
                    echo "Auncun compte n'a été trouvé ! <a href='inscription.php'> M'inscrire </a>";
                    break;
                }
            }
        }
    ?>

    <section class="form_container">
        <form class="w-25" method="POST">
            <div class="form-group">
                <label for="email"> Email : </label>
                <input class="form-control" id="email" type="text" name="Email" placeholder="Email" maxlength="45">
            </div>
            <div class="form-group">
                <label for="mdp"> Mot de passe : </label>
                <input class="form-control" id="mdp" type="password" name="Pass" placeholder="Mot de passe" maxlength="45">
            </div>
            <button class="btn btn-green" type="envoyer" value="Envoyer"> Connexion </button>
        </form>
    </section>
</body>
</html>