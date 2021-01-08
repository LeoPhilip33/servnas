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

                    $dossierUser = $_SESSION["dossierUser"];
                    $tableUser = $_SESSION["tableUser"];

                    $sql = "SELECT * FROM $tableUser";
                    $query = $connection->prepare($sql); // On prépare la requête
                    $query->execute(); // On exécute la requête
                    $result = $query->fetchAll(PDO::FETCH_ASSOC); // On stocke le résultat dans un tableau associatif
        
                    foreach($result as $produit){
                        $nomFichier = $produit['nomfichier'];
                        echo "<a href='upload/".$dossierUser."/".$nomFichier."' download='".$nomFichier."'> " . $nomFichier." </a> <br>";
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