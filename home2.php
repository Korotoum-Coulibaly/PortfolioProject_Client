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
    <link rel="shortcut icon" href="images\short.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/d2f0a3e457.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/side.css">
    <link rel="stylesheet" href="js/node_modules/notyf/notyf.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

        <div id="full"></div>
        <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/d.png" alt="" class="title">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="logout.php" onclick="" class="nav-link">Deconnexion <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.frandroid.com/wp-content/uploads/2020/04/microsoft-365-2020-scaled.jpeg" class="d-block w-100" alt="..." height="auto">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bienvenu sur le générateur de devis</h5>
                    <p>Obtenez directement votre devis en ligne.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://support.content.office.net/en-us/media/f1c4b693-4670-4e7a-8102-bbf1749e83fe.jpg" class="d-block w-100" alt="..." height="auto">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Côut de vos licences et services Microsoft</h5>
                    <p>Faites vous une estimations du coûts des licences en quelque clics.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://cdn.unwire.hk/wp-content/uploads/2020/07/107768894_296981981351754_6135201636074252505_n-1280x720.png" class="d-block w-100" alt="..." height="auto">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Demander des réduction sur le total de vos licences</h5>
                    <p>Demander des réduction sur le total de vos licences.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
      </section>

      <section class="super">

    <div class="info">
        <input style="padding: 50px" type="text" name="" id="" disabled placeholder="Vous êtes déjà client Cloud Steroids? Connectez-vous au générateur de devis pour créer, enregistrer et partager des estimations de coûts.">
        <a href="login.php" class="link"  onclick=""></a>
    </div>
    <div class="search">
        <input type="search" name="" id="search" placeholder="Rechercher un produit" hidden>
        <i class="fa-solid fa-magnifying-glass" hidden></i>
    </div>

    <?php
        $subcategoryandpacks = "https://generateur.cloudsteroids.com/public/api/allpackofsubcategories";
        $subcategoryandpacks = file_get_contents($subcategoryandpacks);
        $subcategoryandpacks = json_decode($subcategoryandpacks, true);
        //var_dump($subcategoryandpacks);
    ?>

    <div>
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="nav flex-column nav-pills me-3 tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php $firstIteration = true; ?>
                    <?php foreach($subcategoryandpacks as $key => $subcategory) :?>
                        <?php $isActive = $firstIteration ? 'active' : ''; ?>
                        <button class="nav-link <?php echo $isActive; ?> " id="pills-tab-<?php echo $subcategory["id_sub_categorie"]?>" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $subcategory["id_sub_categorie"]?>" 
                            type="button" role="tab" aria-controls="pills-<?php echo $subcategory["id_sub_categorie"]?>" aria-selected="true"> <?php echo $subcategory["libelle"];?> </button>
                        <?php $firstIteration = false; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <?php $secondIteration = true; ?>
                    <?php foreach($subcategoryandpacks as $key => $subcategory) :?>
                        <?php $isActive = $secondIteration ? 'active' : ''; ?>
                        <div class="tab-pane fade show <?php echo $isActive; ?>" id="pills-<?php echo $subcategory["id_sub_categorie"]?>" role="tabpanel" aria-labelledby="pills-tab-<?php echo $subcategory["id_sub_categorie"]?>" tabindex="0">  
                            <?php foreach($subcategory['pack'] as $pack) :?>
                                <button class="licence" id="button<?= $pack['id_pack'] ?>"  data-id="<?= $pack['id_pack'] ?>" data-name="<?= $pack['libelle'] ?>" data-price="<?= $pack['microsoft_price'] ?>" data-userid="<?= $_SESSION['idUtilisateur'] ?>" onclick="updatedisplay(event)" >
                                    <h1 class="nomLicence"><?= $pack['libelle'] ?></h1>
                                    <h3 class="slogan">Web and mobile apps and services</h3>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <?php $secondIteration = false; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

<script>
  //id du user connecté
  
var totalamount = 0;
//supprimer l'élément
// Fonction de suppression de l'élément affiché
function removeElement(element) {
  element.parentNode.removeChild(element);
}
var derniersPrixProduits = {};
var quantités = {};
var user_id ;
var quote_numero;
var all_price;
var infosPost = [];

// Fonction pour mettre à jour l'affichage du bouton lorsqu'il est cliqué
function updatedisplay(event) {


  var button = event.target;
  var divElement = document.getElementById("selected-buttons");

  if (button.classList.contains('licence'))
     {
            var currentStyle = button.getAttribute('style');

            if (currentStyle && currentStyle === 'outline: 3px solid #1473E6;') {
              button.removeAttribute('style');
              
            } else {
              button.setAttribute('style', 'outline: 3px solid #1473E6;');

              var libelle = button.getAttribute('data-name');
              var price = button.getAttribute('data-price');
              var id = button.getAttribute('data-id');
              var id_user = button.getAttribute('data-userid');

              // Créer un nouvel élément de paragraphe pour afficher les données
              var newParagraph = document.createElement('p');
              // Appliquer des styles CSS au nouvel élément de paragraphe
              newParagraph.style.fontSize = '16px';

              newParagraph.innerHTML = "<span id='' style='font-size: 16px;'></span>" + libelle + "<br> <span style='font-size: 16px;'></span>" + price + "$ / utilisateur";

                // Créer des boutons "+" et "-"
                var addButton = document.createElement('button');
                addButton.innerHTML = '+';
                addButton.classList.add('small-button'); // Ajouter la classe CSS pour le style personnalisé

                var subtractButton = document.createElement('button');
                subtractButton.innerHTML = '-';
                addButton.classList.add('small-button'); // Ajouter la classe CSS pour le style personnalisé

                // Ajouter des styles CSS pour les boutons
                addButton.style.fontSize = '14px'; // Réduire la taille de la police du bouton
                addButton.style.width = '24px'; // Réduire la taille de la police du bouton
                subtractButton.style.fontSize = '14px'; // Réduire la taille de la police du bouton
                subtractButton.style.width = '24px'; // Réduire la taille de la police du bouton

                // Ajouter des gestionnaires d'événements pour les boutons "+" et "-"
                addButton.addEventListener('click', function() {
                  quantityInput.value = parseInt(quantityInput.value) + 1;
                  updateParagraph();
                });

                subtractButton.addEventListener('click', function() {
                  var currentQuantity = parseInt(quantityInput.value);
                  if (currentQuantity > 1) {
                    quantityInput.value = currentQuantity - 1;
                    updateParagraph();
                  }
                });

                  // Créer un champ de saisie de type number avec une valeur minimale de 1
                  var quantityInput = document.createElement('input');
                  quantityInput.type = 'number';
                  quantityInput.placeholder = 'Qte';
                  quantityInput.min = 1;
                  quantityInput.classList.add('small-input'); // Ajouter la classe CSS pour le style personnalisé

                  // Ajouter des styles CSS pour le champ de saisie
                  quantityInput.style.fontSize = '13px';
                  quantityInput.style.width = '40px'; // Réduire la largeur du champ de saisie

                  //variable contenant le total des produits
                  var totalGlobal = 0;
                  var dataObject = {};

                  // Mettre à jour le contenu du paragraphe avec le libellé, le prix et la quantité
                  function updateParagraph() {
                    var quantity = (quantityInput.value);
                    var totalPrice = price * quantity;
                    newParagraph.innerHTML = "<span style='font-size: 16px;'></span>" + libelle + "<br><span style='font-size: 16px;'></span>" + price + "CFA / utilisateur<br><span style='font-size: 16px;'>Quantité : </span>" + quantity + "<br><span style='font-size: 16px;'>Total : </span>" + totalPrice + "CFA";
                    derniersPrixProduits[id] = totalPrice;
                    quantités[id] = quantity;
                    user_id = id_user;
                    //console.log(derniersPrixProduits);
    

               // Calculer le total global à partir des derniers prix totaux
                  var totalGlobal = Object.values(derniersPrixProduits).reduce(function (acc, prix) {
                    return acc + prix;
                  }, 0);
                  all_price = totalGlobal;
                  console.log("Prix global : " + totalGlobal);
             // Afficher le total global
                 var totalGlobalElement = document.getElementById('total-global');
                    totalGlobalElement.innerHTML = totalGlobal + "CFA";
                  }
            // Appliquer des styles CSS pour le paragraphe
                  newParagraph.style.margin = '10px'; // Ajouter une marge inférieure entre chaque nouvel élément
            // Mettre à jour le paragraphe à chaque changement de quantité
                  quantityInput.addEventListener('input', function() {
                           updateParagraph();
                        });
            // Appeler la fonction updateParagraph pour mettre à jour le paragraphe initial
                          updateParagraph();
            // Créer un conteneur div pour regrouper les éléments
                            var containerDiv = document.createElement('div');
                            containerDiv.appendChild(newParagraph);
                            containerDiv.appendChild(subtractButton);
                            containerDiv.appendChild(quantityInput);
                            containerDiv.appendChild(addButton);
            // Ajouter le nouvel élément de paragraphe à la div
                            divElement.appendChild(containerDiv);
                          }
              }

}
      infosPost.push(derniersPrixProduits);

      console.log(infosPost);
      console.log(quantités);
                console.log(user_id);

       function genererNumeroDevis(longueur) {
                var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                var resultat = '';

                for (var i = 0; i < longueur; i++) {
                  var index = Math.floor(Math.random() * caracteres.length);
                  resultat += caracteres.charAt(index);
                }

                return resultat;
              }

  function enregistrerDonnees() {
        // URL de l'API pour enregistrer les données
        var url = 'https://generateur.cloudsteroids.com/public/api/users_choice';

        // Données à envoyer
        console.log(user_id);
          // Exemple d'utilisation avec une longueur de 8 caractères
          var numeroDevis = genererNumeroDevis(8);
          quote_numero = numeroDevis;
        console.log(numeroDevis);
        var keys = Object.keys(quantités);
      // Boucle pour chaque clé
      for (var i = 0; i < keys.length; i++) {
          var packId = parseInt(keys[i]);
          var quantity = parseInt(quantités[keys[i]]);
          var totalPrice = infosPost[0][keys[i]];

          //données à envoyer
                  var data = {
                      user_id: parseInt(user_id),
                      quote_numero: numeroDevis,
                      pack_id: packId,
                      quantity: quantity,
                      total_price: totalPrice,
                      // Ajoutez d'autres champs selon vos besoins
                    };
                    console.log(data);

                    // Conversion des données en JSON
                    var dataJson = JSON.stringify(data);

                    // Configuration de la requête
                    var options = {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json',
                      },
                      body: dataJson,
                    };

                    // Envoi de la requête HTTP
                    fetch(url, options)
                      .then(response => {
                        if (response.ok) {
                          // Succès de l'enregistrement
                          console.log('Les données ont été enregistrées avec succès !');
                        } else {
                          // Erreur lors de la requête
                          console.error('Erreur lors de l\'enregistrement des données.');
                        }
                      })
                      .catch(error => {
                        console.error('Erreur lors de l\'enregistrement des données.', error);
                      });
        }
}


function enregistrerquote(prospectId) {
   
        // URL de l'API pour enregistrer les données
        var url = 'https://generateur.cloudsteroids.com/public/api/quotes';
        // Données à envoyer
           console.log(user_id);
           console.log(quote_numero);
           console.log(all_price);
           console.log(prospectId);
          //données à envoyer
                  var data = {
                      user_id: parseInt(user_id),
                      quote_numero: quote_numero,
                      prospect_id: prospectId,
                      office_id: 1,
                      all_price: parseInt(all_price),
                      // Ajoutez d'autres champs selon vos besoins
                    };
                    console.log(data);

                   
                    // Conversion des données en JSON
                    var dataJson = JSON.stringify(data);

                    // Configuration de la requête
                    var options = {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json',
                      },
                      body: dataJson,
                    };

                    // Envoi de la requête HTTP
                    fetch(url, options)
                      .then(response => {
                        if (response.ok) {
                          // Succès de l'enregistrement
                          console.log('Les données ont été enregistrées avec succès !');
                          window.location.href = './devis.php?parametre=' + encodeURIComponent(quote_numero);
                        } else {
                          // Erreur lors de la requête
                          console.error('Erreur lors de l\'enregistrement des données.');
                        }
                      })
                      .catch(error => {
                        console.error('Erreur lors de l\'enregistrement des données.', error);
                      });
        
  }
</script>
            
            
    
     
        </div>
    </div>
            
    <div class="container estimation">
    <h1 class="htitle">Votre estimation</h1>
    <br>
    <div id="selected-buttons" class="selected"></div>

    <div class="cost">
        <h4 class="">Durée du coût des licences</h4>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="choix" id="parMois" value="Par mois">
            <label class="form-check-label" for="parMois">Le mois<span></span></label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="choix" id="parAnnee" value="Par année">
            <label class="form-check-label" for="parAnnee">L'année<span></span></label>
        </div>
        <span class="total" type="submit" name="submit">Total = <span id="total-global"></span></span>

        <button class="btn btn-primary estime" type="submit" data-bs-toggle="modal" data-bs-target="#myModal" onclick="enregistrerDonnees()"><i class="fa fa-save" aria-hidden="true"></i> Enregistrer</button>
        <br>
        <a href="liste.php" class="btn btn-primary estime"><i class="fa fa-save" aria-hidden="true"></i> Vos devis</a>
    </div>
</div>
    
  </section>
  <!-- The Modal -->
<div class="modal py-5" id="myModal">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header">
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <!-- Modal body -->
    <div class="modal-body">
      Ce prospect existe-t-il déjà?
      <div class="btn-group">
        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#myModale2">OUI</button>
      </div>
      <div class="btn-group">
        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#myModal1">NON</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- The Modal -->
<div class="modal" id="myModale2">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header">
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <!-- Modal body -->
        
    <?php
                $listprospects = "https://generateur.cloudsteroids.com/public/api/prospects";
                $listprospects  = file_get_contents($listprospects);
                $listprospects  = json_decode($listprospects, true);
                //var_dump($subcategoryandpacks);
     ?>

    <div class="modal-body">
      <form onsubmit="recupererprospectinfos(event)">
      <select class="form-select">
        <option>-- Sélectionnez --</option>
        <?php foreach($listprospects as $key => $prospect) :?>
        <option value="<?php echo $prospect["id_prospect"]?>"><?php echo $prospect["name_prospect"] .' '. $prospect["firstName_prospect"] . ':' . $prospect["email"] . ':' . $prospect["allied_enterprise"]; ?></option>
        <?php endforeach ?>

      </select>
      <div class="py-5">
            <input type="submit" class="" value="Envoyer">
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
          Entrer les informations du prospect pour lequel vous souhaitez générer un devis
                      <form onsubmit="enregistrerprospect(event)">
                              <div>
                              <label for="nom" class="form-label">Nom :</label>
                              <input type="text" id="nom" name="nom" class="form-control form-control-sm" required>

                              <label for="prenom" class="form-label">Prénom(s) :</label>
                              <input type="text" id="prenom" name="prenom" class="form-control form-control-sm" required>

                              <label for="email" class="form-label">Email :</label>
                              <input type="text" id="email" name="email" class="form-control form-control-sm" required>

                              <label for="sexe" class="form-label">Sexe :</label>
                              <select id="sexe" name="sexe" class="form-control form-control-sm" required>
                                <option value="">-- Sélectionnez --</option>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                              </select>

                              <label for="entreprise" class="form-label">Pour quelle entreprise le prospect travaille :</label>
                              <input type="text" id="entreprise" name="entreprise" class="form-control form-control-sm" required>

                              <div class="py-5">
                              <input type="submit" class= "" value="Envoyer">
                              </div>
                  </form>
          </div>
    </div>
</div>
</div>
 





  <div class="btn"><img src="images/arrow-up-solid.svg" class="icon" alt=""></div>



  <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>Visitez notre site <a href="https://www.cloudsteroids.com" style="color: #fff; text-decoration: none; font-size: 18px; font-weight: bold;">Cloud Steroids</a> | Contact: sales@cloudsteroids.com</p>
            </div>
            <div class="col-md-6">
                <div class="socials text-md-end">
                    <a href="https://www.facebook.com/CloudSteroids2020?mibextid=ZbWKwL" title="Facebook" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/cloud_steroids?t=moW1xHJCfKivbFoUbzvlhw&s=09" title="Twitter" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/company/cloudsteroids/" title="Linkedin" class="linkedin"><i class="fa fa-linkedin"></i></a> 
                </div>
            </div>
        </div>
    </div>
</footer>
</div>


 <script>
     function enregistrerprospect(event) {
        // Empêcher le comportement par défaut du formulaire
          event.preventDefault();

        // Récupérer les valeurs des champs du formulaire
        var nom = event.target.nom.value;
        var prenom = event.target.prenom.value;
        var email = event.target.email.value;
        var sexe = event.target.sexe.value;
        var entreprise = event.target.entreprise.value;

        // URL de l'API pour enregistrer les données
        var url = 'https://generateur.cloudsteroids.com/public/api/prospects';
          //données à envoyer
                  var data = {
                      name_prospect: nom,
                      firstName_prospect: prenom,
                      sexe: sexe,
                      email: email,
                      allied_enterprise: entreprise,
                      // Ajoutez d'autres champs selon vos besoins
                    };
                    console.log(data);

                    // Conversion des données en JSON
                    var dataJson = JSON.stringify(data);

                    // Configuration de la requête
                    var options = {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json',
                      },
                      body: dataJson,
                    };

                    // Envoi de la requête HTTP
                    fetch(url, options)
                      .then(response => {
                        if (response.ok) {
                          // Succès de l'enregistrement
                          console.log('Les données ont été enregistrées avec succès !');
                          return response.json(); // Analyser la réponse JSON
                        } else {
                          // Erreur lors de la requête
                          console.error('Erreur lors de l\'enregistrement des données.');

                        }
                      })
                      .then(data => {
                            // Récupérer l'ID du prospect créé
                            var prospectId = data.id_prospect;
                            console.log('ID du prospect créé :', prospectId);

                            // Faire ce que vous voulez avec l'ID du prospect
                            enregistrerquote(prospectId);
                          })
                      .catch(error => {
                        console.error('Erreur lors de l\'enregistrement des données.', error);
                      });
   }

   function recupererprospectinfos(event) {
    event.preventDefault();

    // Récupérer la valeur de l'option sélectionnée
    var selectElement = event.target.querySelector('select');
    var id_prospect = selectElement.value;
    enregistrerquote(id_prospect);
   }
 </script>
    
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
</body>
</html>
