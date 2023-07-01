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

function toggleMenuLinksResto() {
  var menuButtonResto = document.querySelector('.menu-button-resto');
  var menuLinksContainerResto = document.getElementById('menuLinksContainerResto');
  var toggleSpanPlusResto = document.querySelector(".toggleSpanPlusResto");
  var toggleSpanMinusResto = document.querySelector(".toggleSpanMinusResto");

  menuButtonResto.classList.toggle('open-links-div-resto');
  menuLinksContainerResto.classList.toggle('hidden');

  if (menuButtonResto.classList.contains('open-links-div-resto')) {
    menuLinksContainerResto.style.display = 'block';
    toggleSpanPlusResto.style.display = "none";
    toggleSpanMinusResto.style.display = "block";
  } else {
    menuLinksContainerResto.style.display = 'none';
    toggleSpanPlusResto.style.display = "block";
    toggleSpanMinusResto.style.display = "none";
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

    // RESTO
    var menuButtonResto = document.querySelector('.menu-button-resto');
    var menuLinksContainerResto = document.getElementById('menuLinksContainerResto');
    var toggleSpanPlusResto = document.querySelector(".toggleSpanPlusResto");
    var toggleSpanMinusResto = document.querySelector(".toggleSpanMinusResto");
  
  
    if (menuButtonResto.classList.contains('open-links-div-resto')) {
      menuLinksContainerResto.style.display = 'block';
      toggleSpanPlusResto.style.display = "none";
      toggleSpanMinusResto.style.display = "block";
    } else {
      menuLinksContainerResto.style.display = 'none';
      toggleSpanPlusResto.style.display = "block";
      toggleSpanMinusResto.style.display = "none";
    }
 });