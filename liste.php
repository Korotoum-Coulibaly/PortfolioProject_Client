<?php
     session_start();
     if ($_SESSION["autoriser"]!="oui") {
        header("location:login.php");
        exit();
     }
    
    $id_user = $_SESSION["idUtilisateur"];
     //var_dump($_SESSION["idUtilisateur"]);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gérer vos devis</title>
        <link rel="shortcut icon" href="images\caroussel2.png" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/liste.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <style>
            .generer {
                text-decoration: none;
                color: #0077b5;
            }

            .details {
                text-decoration: none;
            }
            .details:hover {
                color: #0077b5;
            }
    </style>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">Gérer vos devis</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class=""></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="liste.php">Liste de vos devis</a></li>

                        <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <br><br>
        <?php
                $quotes = "https://generateur.cloudsteroids.com/public/api/quotes/".$id_user;
                $quotes = file_get_contents($quotes);
                $quotes = json_decode($quotes, true);
                //var_dump($quotes);
        ?>
      
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                            </div>
                            <div class="py-2"></div>
                    <div class= "h4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='5' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php" class="generer"><i class="fa fa-spinner-third"></i> Générer un devis</a></li>
                            </ol>
                    </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                              
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Numéro du devis</th>
                                            <th>Nom du prospect</th>
                                            <th>Prix total</th>
                                            <th>Date d'émission</th>
                                            <th>Date d'expiration</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Numéro du devis</th>
                                            <th>Nom du prospect</th>
                                            <th>Prix total</th>
                                            <th>Date d'émission</th>
                                            <th>Date d'expiration</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    
                                        <tr>
                                        <?php foreach($quotes as $key => $quote) : ?>
                                        <?php foreach($quote["prospect"] as $key => $prospect) :?>
                                            
                                            <td><?php echo $quote["quote_numero"] ?></td>
                                            <td><?php echo $prospect["name_prospect"]. " " .$prospect["firstName_prospect"] ?></td>
                                            <td><?php echo $quote["all_price"] ?></td>
                                            <td><?php echo $quote["date_emission"] ?></td>
                                            <td><?php echo $quote["date_expiration"] ?></td>
                                            <td><a href="devis.php?parametre=<?php echo $quote["quote_numero"]; ?>" class="details">Voir plus</a></td>
                                        </tr>

                                        <?php endforeach;?>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a href="https://www.cloudsteroids.com">Cloud Steroids</a></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});
     /*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    //
// Scripts
//

window.addEventListener('DOMContentLoaded', event => {

// Toggle the side navigation
const sidebarToggle = document.body.querySelector('#sidebarToggle');
if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
}

});

        </script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
