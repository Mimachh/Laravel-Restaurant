function scrollToElement(id) {
    const element = document.getElementById(id);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
    }
}


function openModal() {
  // Ajoutez ici le code pour afficher la modale
  console.log('Ouvrir la modale');
// const modal = document.getElementById('myModal');
  const modale = document.getElementById('modalResa');
  // modale.classList.toggle('hidden');
  modale.showModal();
}

const modal = document.getElementById('modalReservation');

// Récupérer le bouton pour ouvrir la fenêtre modale
const openModalBtn = document.getElementById('openModalBtn');

// Récupérer le bouton pour fermer la fenêtre modale
const closeModalBtn = document.getElementById('closeModalBtn');

// Fonction pour ouvrir la fenêtre modale
// function openModal() {
//   modal.showModal();
// }

// Fonction pour fermer la fenêtre modale
function closeModal() {
  modal.close();
}

// Ajouter un événement de clic pour ouvrir la fenêtre modale
// openModalBtn.addEventListener('click', openModal);

// Ajouter un événement de clic pour fermer la fenêtre modale
// closeModalBtn.addEventListener('click', closeModal);

