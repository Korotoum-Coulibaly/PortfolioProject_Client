<?php
     session_start();
     if ($_SESSION["autoriser"]!="oui") {
        header("location:login.php");
        exit();
     }
     if (date("H")<18)
        $bienvenue="Bonjour et bienvenue dans votre espace personnel";
     else
        $bienvenue="Bonsoir et bienvenue dans votre espace personnel";

    $sub_categories = json_decode(file_get_contents("https://generateur.cloudsteroids.com/public/api/sub_categories"));
    $packs1 = json_decode(file_get_contents("https://generateur.cloudsteroids.com/public/api/packs/"));
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Steroids-Générateur de devis</title>
    <link rel="shortcut icon" href="images\short.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/d2f0a3e457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/test.css">
    <link rel="stylesheet" href="js/node_modules/notyf/notyf.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
        <section class="">
        <div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://images.frandroid.com/wp-content/uploads/2020/04/microsoft-365-2020-scaled.jpeg" class="d-block w-100" alt="..." height="596px">
      <div class="carousel-caption d-none d-md-block">
        <h5>Bienvenu sur le générateur de devis</h5>
        <p>Obtenez directement votre devis en ligne.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://prodwewpstorageaccount.s3.eu-central-1.amazonaws.com/wp-content/uploads/sites/10/2020/06/25110414/What-you-Actually-pay-for-M365-841x281-1.jpg" class="d-block w-100" alt="..." height="596px">
      <div class="carousel-caption d-none d-md-block">
        <h5>Côut de vos licences et services Microsoft</h5>
        <p>Faites vous une estimations du coûts des licences en quelque clics.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://cdn.unwire.hk/wp-content/uploads/2020/07/107768894_296981981351754_6135201636074252505_n-1280x720.png" class="d-block w-100" alt="..." height="596px">
      <div class="carousel-caption d-none d-md-block">
        <h5>Demander des réduction sur le total de vos licences</h5>
        <p>Demander des réduction sur le total de vos licences.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
      </section>

      <section class="super">

        <div class="info">
            <input style="padding: 50px" type="text" name="" id="" disabled placeholder="Vous êtes déjà client Cloud Steroids? Connectez-vous au générateur de devis pour créer, enregistrer et partager des estimations de coûts.">
            <a href="login.php" class="link" onclick=""></a>
        </div>
          <div class="search">
            <input type="search" name="" id="search" placeholder="Rechercher un produit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>

        <?php
                $subcategoryandpacks = "https://generateur.cloudsteroids.com/public/api/allpackofsubcategories";
                $subcategoryandpacks = file_get_contents($subcategoryandpacks);
                $subcategoryandpacks = json_decode($subcategoryandpacks, true);
                //var_dump($subcategoryandpacks);
     ?>

    <div class="side">
    <div class="tabs">
                <?php $firstIteration = true; ?>
                    <?php foreach($subcategoryandpacks as $key => $subcategory) :?>
                      <?php $isActive = $firstIteration ? 'active' : ''; ?>
            <h2 class="tchai <?php echo $isActive; ?>" id="<?php echo $subcategory["id_sub_categorie"]?>"><?= $sub_categorie->libelle ?></h2>
        <?php endforeach; ?>
    </div>
        

        <div class="tab-side">
             <!-- div containing Ms pack -->
             <div id="toggle" class="active">
            
            <?php foreach ($packs1 as $index => $pack) : ?>
                
                <button class="licence" id="button<?= $pack->id_pack ?>" data-price="<?= $pack->microsoft_price ?>">
                    <h1 class="nomLicence"><?= $pack->libelle ?></h1>
                    <h3 class="slogan">Web and mobile apps and services</h3>
                </button>
           
            <?php endforeach; ?>
            
            </div>
            
            <div id="toggl">
                <button class="licence" id="button5" data-price="36.00">
                    <h1 class="nomLicence"><?= $pack->libelle ?></h1>
                    <h3 class="slogan">Web and mobile apps and services</h3>
                </button>
        
                <button class="licence" id="button6" data-price="38.00">
                    <h1 class="nomLicence"><?= $pack->libelle ?></h1>
                    <h3 class="slogan">Desktop, web and mobile apps and services</h3>
                </button>
        
                <button class="licence" id="button7" data-price="10.00">
                    <h1 class="nomLicence"><?= $pack->libelle ?></h1>
                    <h3 class="slogan">Desktop, web and mobile apps  and services</h3>
                </button>
        
                <button class="licence" id="button8" data-price="8.00">
                    <h1 class="nomLicence"><?= $pack->libelle ?></h1>
                    <h3 class="slogan">Desktop, web and mobile apps and services</h3>
                </button>
            </div>
    
            <div id="tog">
                <button class="licence" id="button9">
                    <h1 class="nomLicence">Microsoft intune</h1>
                </button>
        
                <button class="licence" id="button10">
                    <h1 class="nomLicence">Microsoft Exchange online</h1>
                </button>
        
                <button class="licence" id="button11">
                    <h1 class="nomLicence">Microsoft Sharepoint</h1>
                </button>
        
                <button class="licence" id="button12">
                    <h1 class="nomLicence">Microsoft Project</h1>
                </button>
    
                 <button class="licence" id="button13">
                    <h1 class="nomLicence">Microsoft Power BI</h1>
                </button>
        
                <button class="licence" id="button14">
                    <h1 class="nomLicence">Microsoft Teams</h1>
                </button>
        
                <button class="licence" id="button15">
                    <h1 class="nomLicence">Microsoft OneDrive</h1>
                </button>
        
                <button class="licence" id="button16">
                    <h1 class="nomLicence">Microsoft Power Apps</h1>
                </button>
    
                <button class="licence" id="button17">
                    <h1 class="nomLicence">Azure active directory</h1>
                </button>
        
                <button class="licence" id="button18">
                    <h1 class="nomLicence">Microsoft pureview</h1>
                </button>
        
                <button class="licence" id="button19" data-price="10">
                    <h1 class="nomLicence">Defender for office 365 </h1>
                </button>
        
                <button class="licence" id="button20" data-price="10">
                    <h1 class="nomLicence">Azure information protection</h1>
                </button>
            </div>
            
        </div>
    </div>
    
   <form id="myForm" action="" method="post">
<div class="esti" id="estimation">
    <h1 class="htitle">Votre estimation</h1> <br>
<div id="selected-buttons" class="selected"></div>

    <div class="cout">
        <h4 class="">Durée du coût des licences</h4>
        <input type="radio" name="choix" id="" value="Par mois"> <label for="" class="label1"> Le mois <span> </span> </label>
        <input type="radio" name="choix" id="" value="Par année"> <label for="" class="label2"> L'année <span> </span> </label>
        <span class="to" type="submit" name="submit">Total = <span id="total"></span></span>
        
            <button class="estime"><i class="fa fa-save" aria-hidden="true" class="icon"> Enregistrer</i></button><br>
            <a href="liste.php" class="estime"><i class="fa fa-save" aria-hidden="true" class="icon"> Vos devis</i></a>
    </div>
</div>
</form>
  </section>


  <div class="btn"><img src="images/arrow-up-solid.svg" class="icon" alt=""></div>



  <footer class="footer">
   
    
    <div class="footer-2">
        <p>Visitez notre site <a href="https://www.cloudsteroids.com" style="color: #fff; text-decoration: none; font-size: 18px; font-weight: bold;">Cloud Steroids</a> | Contact: sales@cloudsteroids.com</p>
        <br>
        <span class="socials">
            <a href="https://www.facebook.com/CloudSteroids2020?mibextid=ZbWKwL" title="Facebook" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/cloud_steroids?t=moW1xHJCfKivbFoUbzvlhw&s=09" title="Twitter" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="https://www.linkedin.com/company/cloudsteroids/" title="Linkedin" class="linkedin"><i class="fa fa-linkedin"></i></a> 
         </span>
    </div>
</footer>
</div>


    
    
          <br><br>
          <script>
            //flêche pour remonter en haut
            const btn = document.querySelector('.btn');

            btn.addEventListener('click', () => {

                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: "smooth"
                })

            })
          </script>
        <script src="js/node_modules/notyf/notyf.min.js"></script>
        <script src="js/side.js"></script>

</body>
</html>
