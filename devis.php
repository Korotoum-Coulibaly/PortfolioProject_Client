<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Steroids-Générateur de devis</title>
    <link rel="shortcut icon" href="images\caroussel2.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/d2f0a3e457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="js/node_modules/notyf/notyf.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/side.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div id="full"></div>
        <header>
            
        <nav>
                    <div class="hero">
                    <img src="images/d.png" alt="" class="title">
                      <a href="logout.php" onclick="" class="login"> <i class="fa fa-sign-out" aria-hidden="true"> Deconnexion</i></a>
                    <span id="login-status" class="status"></span>
                    </div>
                </nav>
            
        </header>
        <div class="py-5"></div>

            
        <div  class=" container py-5 text-center">
                
            <div class="container">
            <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='5' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="liste.php">Liste de vos devis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Page de devis</li>
                </ol>
            </div>
        <?php $parametre = $_GET['parametre']; ?>

        <embed src="newdevis.php?parametre=<?php echo urlencode($parametre); ?>" type="text/html" height="1000" width="100%" >
        </div>
        </div>
</body>
</html>
