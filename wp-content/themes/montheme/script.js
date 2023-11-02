
const btncontact = document.getElementById("menu-item-68");
btncontact.classList.add('modal-trigger');
const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");

modalTriggers.forEach(trigger => trigger.addEventListener("click", toggleModal))

function toggleModal(){
  modalContainer.classList.toggle("active")
}


// Variable pour suivre la page actuelle
let currentPage = 1;
// Fonction pour charger davantage de publications
function loadMorePosts() {
  // Incrémente la page actuelle à chaque clic sur "Load More"
  currentPage++;
  $.ajax({
    type: 'POST',
    url: 'wp-admin/admin-ajax.php',
    dataType: 'html',
    data: {
      action: 'filtre',
      paged: currentPage,
      category: $('#categFiltre').val(),
      post_format: $('#formFiltre').val(),
      post_ordre: $('#triFiltre').val(),
    },
    success: function (res) {
      // Filtrer le nouveau contenu pour extraire les images
      const newImages = $(res).filter('.full_screen');
      // Ajouter le nouveau contenu à la liste existante de photos
      $('.photos-acc').append(res);
      // Réinitialiser la liste d'images avec les nouvelles images ajoutées
      images = $('.photos-acc .full_screen');
      // Réappliquer les événements de lightbox pour les nouvelles images
      openLightbox();
      // Appliquer les filtres après l'ajout du nouveau contenu
      applyFilters();
    }
  });
}
// Gérer le clic sur le bouton "Load More"
$('#load-more').on('click', loadMorePosts);

// Fonction pour charger le contenu en utilisant AJAX avec des filtres
function loadContent(page, category, postFormat, postOrder) {
  // Effectuer une requête AJAX pour obtenir le contenu filtré
  $.ajax({
    type: 'POST',
    url: 'wp-admin/admin-ajax.php',
    dataType: 'html',
    data: {
      action: 'filtre',
      paged: page,
      category: category,
      post_format: postFormat,
      post_ordre: postOrder,
    },
    success: function (res) {
      // Filtrer le nouveau contenu pour extraire les images
      const newImages = $(res).filter('.full_screen');
      // Remplacer le contenu de .photos-acc par la réponse AJAX
      $('.photos-acc').html(res);
      // Réinitialiser la liste d'images avec les nouvelles images ajoutées
      images = $('.photos-acc .full_screen');
    }
  });
}

// Fonction pour appliquer les filtres
function applyFilters() {
  // Réinitialiser la page actuelle lorsque les filtres changent
  currentPage = 1;
  // Charger le contenu avec les filtres actuels
  loadContent(currentPage, $('#categFiltre').val(), $('#formFiltre').val(), $('#triFiltre').val());
}
// Gérer les changements dans les sélecteurs de filtre
$('#categFiltre, #formFiltre, #triFiltre').on('change', applyFilters);