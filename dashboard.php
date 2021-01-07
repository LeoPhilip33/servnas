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
    echo '<a href="uploadfile.php"> UploadFile </a>';   
?>

   <section class="dashboard_container">
       <h1 class="dashboard_title">Dashboard</h1>
       <div class="files_container">
           <h2>Mes documents</h2>

           <div>
           PHP En mode moche :  <br>

            <?php        
                require 'back/bdd.php';

                session_start();

                $email = $_SESSION["email"]; // Récupération de la personne actuellement connecté

                $sql = "SELECT * FROM files WHERE email='$email'"; // Exploitation de la table "user" ou l'email est égale à l'email de l'utilisateur actuellement connecté.

                $query = $connection->prepare($sql); // On prépare la requête

                $query->execute(); // On exécute la requête

                $result = $query->fetchAll(PDO::FETCH_ASSOC); // On stocke le résultat dans un tableau associatif
    
                foreach($result as $produit){
                    echo $produit['nomfichier'];
                    echo "<br>";
                    
                    // $nomFichierUserBdd = $produit['nomfichier'];
                    // $uniqueNameUserBdd = $produit['uniquename'];
                    // echo "<a href='upload' download='".$uniqueNameUserBdd."'> " . $nomFichierUserBdd." </a>";
                }
    
            ?>

           </div>
           <div class="each_files_container">
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
               <div class="files"></div>
           </div>
       </div>
   </section>
</body>
</html>