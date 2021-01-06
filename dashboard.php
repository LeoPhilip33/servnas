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

    require 'back/bdd.php';
    session_start();

    echo '<a href="uploadfile.php"> UploadFile </a>';

   
?>

   <section class="dashboard_container">
       <h1 class="dashboard_title">Dashboard</h1>
       <div class="files_container">
           <h2>Mes documents</h2>

           <div>
           PHP En mode moche : 

            <?php
                $Email = $_POST['Email'];
                $Pass = $_POST['Pass'];
        
                // On écrit notre requête
                $sql = 'SELECT * FROM user';
        
                // On prépare la requête
                $query = $connection->prepare($sql);
        
                // On exécute la requête
                $query->execute();
        
                // On stocke le résultat dans un tableau associatif
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
                foreach($result as $produit){
                    if($produit['email'] == $Email && $produit['mdp'] == $Pass) {
                        $_SESSION["email"] = $Email;
                        header("location:../dashboard.php");
                    }
                    else{
                        
                    }
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