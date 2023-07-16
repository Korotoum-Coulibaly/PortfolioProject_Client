<?php
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectez-vous</title>
    <link rel="shortcut icon" href="images\caroussel2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/loginPage.css">
</head>
<body>
    
   <!-- div containing the Cloud Steroids logo on the left -->

     <div class="container">
        <div  class="side">
            <img src="images/download.jpg" alt="">
        </div>

        <!-- form on the right -->
        <div>
            <form action="conn.php" class="form" method="post">
                <h2>Veuillez entrer vos coordonnées</h2>
                
                <label for="" class="title">Email: </label> <input type="email" name="email" class="box" required>
                
                  <label for="" class="title">Mot de passe: </label> <input type="password" name="password" id="" class="box" >

                <input type="submit" value="Connexion" id="submit" name="valider"> <br>
                
                <button class="loginbutton"> <img src="images/microsoft.png" alt="" class="logomicro"> Connectez-vous via Microsoft</button>
            </form>
        </div>
     </div>
   
</body>
</html>
