<?php
     session_start();
     if ($_SESSION["autoriser"]!="oui") {
        header("location:login.php");
        exit();
     }
    
     //var_dump($_SESSION["idUtilisateur"]);


?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   

    <style>
      a {
        text-decoration: none;
        margin: 10px;
      }
       @media print {
    .no-print {
      display: none;
    }
    .print-page {
    height: 100vh; /* Hauteur maximale de la page */
    overflow: hidden; /* Masquer le contenu qui dépasse */
  }
  .invoice-col ,th, td{
    font-size: 12px;
  }
  }
    </style>
</head>
<body>
        <div id="full "></div>
      
    <div class="container card-body  no-page-break print-page" id="devis">
        <div class="container row ">
        <?php $quote_numero =  $_GET['parametre']; ?>
        <?php
                $quotes = "https://generateur.cloudsteroids.com/public/api/userprospectofficeinformationforone/".$quote_numero;
                $quotes = file_get_contents($quotes);
                $quotes = json_decode($quotes, true);
                //var_dump($quotes);
        ?>
    <?php foreach($quotes as $key => $quote) :?>
    <?php foreach($quote['office'] as $key => $office) :?>
    <?php foreach($quote['prospect'] as $key => $prospect) :?>

                <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                          <!-- title row -->
                          <div class="">
                            <div class="col-8">
                              <h4>
                                <img src="./images/d.png" alt="">
                              </h4>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-4 invoice-col">
                              De
                              <address>
                                <strong><?php echo $office["office_name"]; ?>.</strong><br>
                               <strong> <?php echo $office["location"]; ?></strong><br>
                                <strong> <?php echo $quote["user"]["name"]; ?></strong><br>
                                <strong> <?php echo $quote["user"]["function"]; ?></strong><br>
                                <strong><?php echo $quote["user"]["email"]; ?></strong> <br>
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-4 invoice-col">
                              A  
                              <address>
                                <strong><?php echo $prospect["allied_enterprise"]?></strong><br>
                                <strong>   <?php echo $prospect["name_prospect"] . " " . $prospect["firstName_prospect"]  ?></strong><br>
                                <strong> <?php echo $prospect["email"]?></strong>
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-4 invoice-col">
                              <b><?php echo $office["subject_quotation_form"] ?></b><br>
                              <br>
                              <b>Devis ID:</b> <?php echo $quote["quote_numero"] ?><br>
                              <b>Date d'emission:</b> <?php echo $quote["date_emission"] ?><br>
                              <b>Date d'expiration:</b> <?php echo $quote["date_expiration"] ?>

                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- Table row -->
                          <div class="row">
                            <div class="col-12 table-responsive">
                              <table class="table table-striped">
                                <thead>
                                <tr>
                                  <th>Pack</th>
                                  <th>Quantité</th>
                                  <th>Montant</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($quote['choice'] as $key => $choice) :?>

                                <tr>
                                <?php foreach($choice['packdepuisquote'] as $key => $pack) :?>
                                  <td><?php echo $pack["libelle"] ?></td>
                                  <?php endforeach;?>
                                  <td><?php echo $choice["quantity"] . " licence(s)" ?></td>
                                  <td><?php echo $choice["total_price"] . " CFA" ?></td>
                                </tr>

                                <?php endforeach;?>
                                </tbody>
                              </table>
                              
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <div class="row py-2">
                            <!-- accepted payments column -->
                                <div class="col-6">
                                  <p class="lead">Mode de paiement:</p>
                                   
                                    <ul>
                                        <i class="fa fa-credit-card" aria-hidden="true"></i> Virement bancaire : 0010051000025
                                    </ul>
                                    <ul>
                                        <i class="fa fa-money" aria-hidden="true"></i> Payer en espèce dans le siège de Cloud Steroids
                                    </ul>
                                    <ul>
                                       <i class="fa fa-file-o" aria-hidden="true"></i> éditer un Chèque au nom de l'entreprise
                                    </ul>
                                                         
                              
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                              <p class="lead">Montant à payer</p>

                              <div class="table-responsive">
                                <table class="table">
                                  <tbody>
                                  <tr>
                                    <th>Total:</th>
                                    <td><?php echo $quote["all_price"] . " CFA" ?></td>
                                  </tr>
                                </tbody></table>
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                              <?php echo $office["remark_subject_quotation"] ?>
                            </p>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- this row will not appear when printing -->
                          <div class="row no-print">
                            <div class="col-12">

                              <a href="" onclick="printPage()"target="_blank" class="btn btn-secondary "><i class="fa fa-print"></i> Imprimer ou Telecharger en PDF</a>
                              

              

                            </div>
                          </div>

                        </div>
                        <!-- /.invoice -->
                      </div>

                      <?php endforeach;?>
                      <?php endforeach;?>
                      <?php endforeach;?>

        </div>
    </div>


<script>
  //imprimer pdf
  function printPage() {
  window.print();
}

</script>
    </body>
</html>
