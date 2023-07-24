
const toggle = document.querySelector('#toggle');
const nav = document.querySelector('#navbar');

toggle.addEventListener('click', () => {
    nav.classList.toggle('hidden');

    nav.classList.toggle('absolute');
    nav.classList.toggle('bg-nav');
    nav.classList.toggle('top-0');
    nav.classList.toggle('right-0');
    nav.classList.toggle('left-0');
    toggle.classList.toggle('rotate-90')
});



window.addEventListener("scroll", function(){
    var navComplete = document.querySelector("#div-nav-bar");
    navComplete.classList.toggle("sticky-nav", window.scrollY > 0);
})

document.addEventListener("DOMContentLoaded", function () {
    // Gestionnaire de clic sur les liens de la navbar
    const navbarLinks = document.querySelectorAll(".navbar-link");
    navbarLinks.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const targetSection = document.querySelector(link.getAttribute("href"));
            const targetSectionId = targetSection.getAttribute("id");
            updateActiveLink(targetSectionId);
            window.scrollTo({ top: targetSection.offsetTop - 50, behavior: "smooth" });
        });
    });


    // Gestionnaire de défilement pour ajouter la classe "active" au lien correspondant à la section visible
document.addEventListener("scroll", function () {
        const scrollPos = window.scrollY;
        const sections = document.querySelectorAll("section");
        let visibleSectionId = null;

        sections.forEach(section => {
            const offsetTop = section.offsetTop - 50;
            const sectionId = section.getAttribute("id");

            if (scrollPos >= offsetTop) {
                visibleSectionId = sectionId;
            }
        });

        if (visibleSectionId) {
            updateActiveLink(visibleSectionId);
        }
});

    // Fonction pour mettre à jour le lien actif
function updateActiveLink(sectionId) {
        navbarLinks.forEach(link => {
            const linkSectionId = link.getAttribute("data-section-id");
            if (linkSectionId === sectionId) {
                link.classList.add("text-primaryDark");
            } else {
                link.classList.remove("text-primaryDark");
            }
        });
    }
});