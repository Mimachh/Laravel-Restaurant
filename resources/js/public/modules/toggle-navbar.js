
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