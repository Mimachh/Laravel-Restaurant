function toggleMenuLinksCarte() {
    var menuButton = document.querySelector('.menu-button-carte');
    var menuLinksContainer = document.getElementById('menuLinksContainerCarte');
    var toggleSpanPlus = document.querySelector(".toggleSpanPlusCarte");
    var toggleSpanMinus = document.querySelector(".toggleSpanMinusCarte");

    menuButton.classList.toggle('open-links-div-carte');
    menuLinksContainer.classList.toggle('hidden');
  
    if (menuButton.classList.contains('open-links-div-carte')) {
      menuLinksContainer.style.display = 'block';
      toggleSpanPlus.style.display = "none";
      toggleSpanMinus.style.display = "block";
    } else {
      menuLinksContainer.style.display = 'none';
      toggleSpanPlus.style.display = "block";
      toggleSpanMinus.style.display = "none";
    }
  }
  
  // Au chargement de la page, vérifie si la div des liens doit être ouverte
  window.addEventListener('DOMContentLoaded', function() {
    var menuButton = document.querySelector('.menu-button-carte');
    var menuLinksContainer = document.getElementById('menuLinksContainerCarte');
    var toggleSpanPlus = document.querySelector(".toggleSpanPlusCarte");
    var toggleSpanMinus = document.querySelector(".toggleSpanMinusCarte");
  
    if (menuButton.classList.contains('open-links-div-carte')) {
      menuLinksContainer.style.display = 'block';
      toggleSpanPlus.style.display = "none";
      toggleSpanMinus.style.display = "block";
    } else {
      menuLinksContainer.style.display = 'none';
      toggleSpanPlus.style.display = "block";
      toggleSpanMinus.style.display = "none";
    }
  });