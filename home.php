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
    <link rel="stylesheet" href="css/side.css">
    <link rel="stylesheet" href="js/node_modules/notyf/notyf.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body >

        <div id="full"></div>
        <header>
                <nav>
                      <div class=""><img src="images/d.png" alt="" class="title" width="90%" height="100%"> </div>
                      <div class=" row">
                            <div class="col-sm-6"><a href="liste.php" id="lien" > <i class="fa fa-save" aria-hidden="true" class="icon"> Gerer vos devis</i></a></div>
                            <div class="col-sm-6"><a href="logout.php" id="lien" > <i class="fa fa-sign-out" aria-hidden="true"> Deconnexion</i></a></div>

                   </div>
                    </div>
                </nav>
            
        </header>
       

      <section class="container">

        <?php
                $subcategoryandpacks = "https://generateur.cloudsteroids.com/public/api/allpackofsubcategories";
                $subcategoryandpacks = file_get_contents($subcategoryandpacks);
                $subcategoryandpacks = json_decode($subcategoryandpacks, true);
                //var_dump($subcategoryandpacks);
     ?>


        <div >
            <div class="side container">
                    <div class="nav flex-column nav-pills me-3 tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical" >
                    <?php $firstIteration = true; ?>
                    <?php foreach($subcategoryandpacks as $key => $subcategory) :?>
                      <?php $isActive = $firstIteration ? 'active' : ''; ?>
                      <button class="nav-link <?php echo $isActive; ?> " id="pills-tab-<?php echo $subcategory["id_sub_categorie"]?>" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $subcategory["id_sub_categorie"]?>" 
                        type="button" role="tab" aria-controls="pills-<?php echo $subcategory["id_sub_categorie"]?>" aria-selected="true"> <?php echo $subcategory["libelle"];?> </button>
                        
                        <?php $firstIteration = false; ?>
                        <?php endforeach; ?>

                    </div>
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

<script>
var totalamount = 0;
//supprimer l'élément
// Fonction de suppression de l'élément affiché
         
      var derniersPrixProduits = {};
      var quantités = {};
      var user_id;
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
              var id =  button.getAttribute('data-id');
              var containerDiv = document.getElementById(id);
              if (containerDiv) {
                containerDiv.remove(); // Supprimer le containerDiv s'il existe déjà avec l'ID correspondant
                //supprimer l'element dans le tableau derniersPrixProduits , quantity et faire allprice - total price
                updatetotalglobal(id);
              }
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
                  quantityInput.value = 1;
                  quantityInput.classList.add('small-input'); // Ajouter la classe CSS pour le style personnalisé
                  quantityInput.addEventListener('input', function() {
                      var value = parseInt(quantityInput.value);

                      if (isNaN(value) || value <= 0) {
                        quantityInput.value = 1;
                      }
                    });
                  // Ajouter des styles CSS pour le champ de saisie
                  quantityInput.style.fontSize = '13px';
                  quantityInput.style.width = '40px'; // Réduire la largeur du champ de saisie

                  //variable contenant le total des produits
                  //var totalGlobal = 0;
                  var dataObject = {};

                  // Mettre à jour le contenu du paragraphe avec le libellé, le prix et la quantité
                  function updateParagraph() {
                    var quantity = parseInt(quantityInput.value);
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
                            containerDiv.id = id;
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

function updatetotalglobal(id){
    console.log(id);
    console.log(derniersPrixProduits);
    console.log(quantités);
    delete derniersPrixProduits[id];
    delete quantités[id];
    console.log(derniersPrixProduits);
    console.log(quantités);
      // Calculer le total global à partir des derniers prix totaux
      totalGlobal = Object.values(derniersPrixProduits).reduce(function (acc, prix) {
                      return acc + prix;
                    }, 0);
      all_price = totalGlobal;
    console.log("Prix global : " + totalGlobal);
    // Afficher le total global
    var totalGlobalElement = document.getElementById('total-global');
                      totalGlobalElement.innerHTML = totalGlobal + "CFA";
                    
      }
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
            
        <div class="esti container" id="estimation">
            <h1 class="htitle">Votre estimation</h1> <br>
        <div id="selected-buttons" class="selected"></div>




    <div class="cout">
        <h4 class="">Informations:</h4>
        <input type="radio" name="choix" id="" value="Par mois"> <label for="" class="label1"><i class="fa fa-hand-o-up" aria-hidden="true"></i> &nbsp;Choisissez les services que vous souhaitez avoir + le nombe de licence.  <span> </span> </label>
        <input type="radio" name="choix" id="" value="Par année"> <label for="" class="label2"> <i class="fa fa-user-plus" aria-hidden="true"></i> &nbsp;Sélectionner ou créer le prospect pour lequel vous générez le devis. <br> Et visualiser votre devis. <span> </span> </label>

        <span class="to" type="submit" name="submit">Total = <span id="total-global"></span></span>
        
        <button class="estime" type="submit" data-bs-toggle="modal" data-bs-target="#myModal" onclick="enregistrerDonnees()">Générer votre devis</button><br>
        
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
        <button type="button" class="button-oui" data-bs-toggle="modal" data-bs-target="#myModale2">OUI</button>
      </div>
      <div class="btn-group">
        <button type="button" class="button-non" data-bs-toggle="modal" data-bs-target="#myModal1">NON</button>
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
            <input type="submit" class="send" value="Envoyer">
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
                              <input type="submit" class= "send" value="Envoyer">
                              </div>
                  </form>
          </div>
    </div>
</div>
</div>
 





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

            var buttons = document.getElementsByClassName('licence');
                for (var i = 0; i < buttons.length; i++) {
                  buttons[i].addEventListener('click', function() {
                    var notyf = new Notyf({
                      duration: 4000,
                      position: {
                        x: 'right',
                        y: 'bottom'
                      },
                      callbacks: {
                        onClick: function() {
                          window.location.href = '#estimation';
                        }
                      }
                    });

                    if (this.dataset.clicked === 'true') {
                      notyf.error('Elément retiré');
                      this.dataset.clicked = 'false';
                    } else {
                      notyf.success('Elément ajouté, vérifier votre estimation. <a href="#estimation">Cliquez-ici</a>');
                      this.dataset.clicked = 'true';
                    }
                  });
                }
                  // Récupérer le bouton "estime"
var boutonEstime = document.querySelector('.estime');

// Récupérer la division "selected-buttons"
var selectedButtons = document.getElementById('selected-buttons');

// Vérifier si la division contient des éléments enfants lors du chargement initial de la page
window.addEventListener('load', function() {
  if (selectedButtons.children.length === 0) {
    boutonEstime.disabled = true; // Griser le bouton
  }
});

// Vérifier si la division contient des éléments enfants lorsqu'un changement se produit dans la sélection des produits
selectedButtons.addEventListener('change', function() {
  if (selectedButtons.children.length === 0) {
    boutonEstime.disabled = true; // Griser le bouton
  } else {
    boutonEstime.disabled = false; // Activer le bouton
    boutonEstime.style.backgroundColor = 'green'; // Définir l'arrière-plan vert
    boutonEstime.style.color = 'white'; // Définir la couleur de police blanche
  }
});

// Ajouter un gestionnaire d'événements à tous les boutons avec la classe "licence"
var licenceButtons = document.querySelectorAll('.licence');
licenceButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    boutonEstime.disabled = false; // Asctiver le bouton
    boutonEstime.style.backgroundColor = 'green'; // Définir l'arrière-plan vert
    boutonEstime.style.color = 'white'; // Définir la couleur de police blanche
  });
});


          </script>
        <script src="js/node_modules/notyf/notyf.min.js"></script>
</body>
</html>
