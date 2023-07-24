document.addEventListener("DOMContentLoaded", function () {
    const scrollToTopButton = document.getElementById("scrollToTopButton");

    // Gestionnaire de défilement pour afficher/cacher le bouton
    window.addEventListener("scroll", function () {
      if (window.scrollY >= 200) {
        scrollToTopButton.style.display = "block";
      } else {
        scrollToTopButton.style.display = "none";
      }
    });

    // Gestionnaire de clic pour remonter en haut de l'écran
    scrollToTopButton.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
});