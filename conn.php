<?php
 session_start();
 $user_login = "https://generateur.cloudsteroids.com/public/api/users";
 $data = file_get_contents($user_login);
 $data = json_decode($data, true);
 $user_emails = array();
 $passwords = array();
 $user_ids = array();

//var_dump($data);
 foreach ($data as $datas) {
    $user_emails[] = $datas['email'];
    $passwords[] =  $datas['password'];
    $user_ids[] = $datas['id_user'];
 }

 if (isset($_POST['valider'])) {
     $user_email = $_POST['email'];
     $password = $_POST['password'];

     if (in_array($user_email, $user_emails)) {
         foreach ($passwords as $key => $pass) {
            //var_dump($pass);
            //var_dump($password);
             if(password_verify($password, $pass)) {
                $_SESSION["autoriser"]="oui";
                $_SESSION["idUtilisateur"] = (int)$user_ids[$key]; // Enregistre l'ID de l'utilisateur dans la session
                header("location:home.php");
             }
             else{
                $erreur = "Mot de passe invalide";
                echo "<script>alert('$erreur');window.location.href='login.php';</script>";

            }
         }
     } else {
         $erreur = "Email invalide";
         echo "<script>alert('$erreur');window.location.href='login.php';</script>";
     }
 }
