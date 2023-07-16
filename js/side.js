//onglet pour les différents packs
let tabTitles = document.querySelectorAll(".tabs h2");
let tabContents = document.querySelectorAll(".tab-side div");

tabTitles.forEach((title, index) => {
    title.addEventListener("click", () => {
        tabContents.forEach((content) => {
            content.classList.remove("active");
        });
        tabTitles.forEach((title) => {
            title.classList.remove("active");
        });
        tabContents[index].classList.add("active");
        title.classList.add("active");
    });
});

// Récupération du bouton par sa classe
// Récupération de tous les boutons par leur classe
var buttons = document.getElementsByClassName('licence');

// Parcours de tous les boutons et ajout d'un événement de clic à chacun d'eux
for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener('click', function() {
    // Création de l'objet notyf
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

    // Affichage de la notification
    notyf.success('Elément ajouté, vérifier votre estimation. <a href="#estimation">Cliquez-ici</a>');
  });
}


function openLogin() {
  var loginWindow = window.open("login.html", "Login", "height=600,width=1000,top=100,right=100,left=100,modal=yes");
}

//login status
const loginStatus = document.getElementById("login-status");

if (authenticated) {
  // Si l'utilisateur est connecté, affichez son nom et un bouton de déconnexion
  loginStatus.innerHTML = `Bonjour, ${username} <button id="logout-btn">Déconnexion</button>`;

  // Ajoutez un écouteur d'événements sur le bouton de déconnexion pour gérer la déconnexion de l'utilisateur
  const logoutBtn = document.getElementById("logout-btn");
  logoutBtn.addEventListener("click", function() {
    // Ajoutez ici le code pour déconnecter l'utilisateur
  });
} else {
  // Si l'utilisateur n'est pas connecté, affichez un bouton de connexion
  loginStatus.innerHTML = '<button id="login-btn">Connexion</button>';

  // Ajoutez un écouteur d'événements sur le bouton de connexion pour afficher le formulaire de connexion
  const loginBtn = document.getElementById("login-btn");
  loginBtn.addEventListener("click", function() {
    // Ajoutez ici le code pour afficher le formulaire de connexion
  });
}

//logout status
function logout() {
  // Supprimez le jeton d'authentification de l'utilisateur
  localStorage.removeItem("authToken");

  // Rechargez la page pour afficher le bouton de connexion
  location.reload();
}

