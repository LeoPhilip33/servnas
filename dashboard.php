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


    $str = 'apple';
    $crypt = md5($str);
    echo $crypt;


   
?>

   <section class="dashboard_container">
       <h1 class="dashboard_title">Dashboard</h1>
       <div class="files_container">
           <h2>Mes documents</h2>

           <div>
           PHP En mode moche :  <br>

            <?php        
                require 'back/bdd.php';

                // On écrit notre requête
                $sql = 'SELECT * FROM files';

                // On prépare la requête
                $query = $connection->prepare($sql);

                // On exécute la requête
                $query->execute();

                // On stocke le résultat dans un tableau associatif
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
    
                foreach($result as $produit){
                    $emailUserBdd = $produit['email'];
                    $nomFichierUserBdd = $produit['nomfichier'];
                    $uniqueNameUserBdd = $produit['uniquename'];
                    echo "<a href='upload' download='".$uniqueNameUserBdd."'> " . $nomFichierUserBdd." </a>";
                    echo "<br>";
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