function scrollToElement(id) {
    const element = document.getElementById(id);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
    }
}


function openModal() {
  // Ajoutez ici le code pour afficher la modale
  console.log('Ouvrir la modale');
}