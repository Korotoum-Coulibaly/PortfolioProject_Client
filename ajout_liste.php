<?php
$user = json_decode(file_get_contents("https://generateur.cloudsteroids.com/public/api/users/"));
$packs = json_decode(file_get_contents("https://generateur.cloudsteroids.com/public/api/packs/"));
ob_start();
//connexion à la session
if (!isset($_SESSION)){
    //sinon start session
    session_start();
}
if (!isset($_SESSION['liste'])){
    //créer une session
    $_SESSION['liste'] = array();
}
//get l'id dans le lien
if (isset($_GET['id_pack'])){
    $id = $_GET['id_pack'];
    //checking
    $produit = mysqli_query($con, "SELECT * FROM packs WHERE id_pack = $id");
if (empty(mysqli_fetch_assoc($produit))){
    //if ça n'existe pas
    die("Ce produit n'existe pas");
}
//add le produit
if (isset($_SESSION['liste']['$id'])){
    $_SESSION['liste']['$id'] = 1;
    echo "Bien ajouté !";
    //
    var_dump($_SESSION['liste']);
}
}

