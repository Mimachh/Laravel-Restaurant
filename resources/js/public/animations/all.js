const mainTitle = document.getElementById('main-title');
const subtitle = document.getElementById('subtitle');

const aboutImage1 = document.getElementById('aboutImage1');
const aboutImage2 = document.getElementById('aboutImage2');
const aboutImage3 = document.getElementById('aboutImage3');
const aboutImage4 = document.getElementById('aboutImage4');
const aboutContent = document.getElementById('aboutContent');

const teamImage1 = document.getElementById('teamImage1');
const teamImage2 = document.getElementById('teamImage2');
const teamImage3 = document.getElementById('teamImage3');

const horaireHeader1 = document.getElementById('horaireHeader1');
const horaireHeader2 = document.getElementById('horaireHeader2');
const horaireFooter1 = document.getElementById('horaireFooter1');
const horaireFooter2 = document.getElementById('horaireFooter2');


// Ajout des classes


// mainTitle.classList.add('animate__animated', 'animate__bounceInLeft');
// subtitle.classList.add('animate__animated', 'animate__fadeInUp', 'animate__delay-1s');

// aboutImage1.classList.add('animate__animated', 'animate__fadeInLeft');
// aboutImage2.classList.add('animate__animated', 'animate__fadeInUp', 'animate__delay-1s');
// aboutImage3.classList.add('animate__animated', 'animate__fadeInRight', 'animate__delay-1s');
// aboutImage4.classList.add('animate__animated', 'animate__fadeInDown');
// aboutContent.classList.add('animate__animated', 'animate__bounceInUp');

// teamImage1.classList.add('animate__animated', 'animate__fadeInLeft');
// teamImage2.classList.add('animate__animated', 'animate__fadeInUp');
// teamImage3.classList.add('animate__animated', 'animate__fadeInRight');

// horaireHeader1.classList.add('animate__animated', 'animate__fadeIn');
// horaireHeader2.classList.add('animate__animated', 'animate__fadeIn');
// horaireFooter1.classList.add('animate__animated', 'animate__fadeIn');
// horaireFooter2.classList.add('animate__animated', 'animate__fadeIn');



// Fonction qui sera exécutée lorsque les éléments deviennent visibles
const handleIntersection = (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Récupérer les classes d'animation pour l'élément
        const animationClasses = animations[entry.target.id];
        // Vérifier si des classes d'animation sont spécifiées pour cet élément
        if (animationClasses) {
          // Ajouter les classes d'animation
          entry.target.classList.add(...animationClasses);

          entry.target.classList.remove('opacity-0');
          // Arrêt de l'observation une fois que l'animation a été ajoutée
          observer.unobserve(entry.target);
        }
      }
    });
  };
  
  // Options de l'Intersection Observer
  const options = {
    root: null, // Utiliser le viewport comme root
    rootMargin: '0px', // Marge autour du viewport pour déclencher l'intersection
    threshold: 0.2, // Pourcentage de visibilité nécessaire pour déclencher l'intersection
  };
  
  // Création de l'Intersection Observer
  const observer = new IntersectionObserver(handleIntersection, options);
  
  // Objet avec les identifiants des éléments et les classes d'animation correspondantes
  const animations = {
    'main-title': ['animate__animated', 'animate__bounceInLeft'],
    'subtitle': ['animate__animated', 'animate__fadeInUp', 'animate__delay-1s'],
    
    'aboutImage1': ['animate__animated', 'animate__fadeInLeft'],
    'aboutImage2': ['animate__animated', 'animate__fadeInUp', 'animate__delay-1s'],
    'aboutImage3': ['animate__animated', 'animate__fadeInRight', 'animate__delay-1s'],
    'aboutImage4': ['animate__animated', 'animate__fadeInDown'],
    'aboutContent': ['animate__animated', 'animate__bounceInUp'],

    'teamImage1': ['animate__animated', 'animate__fadeInLeft'],
    'teamImage2': ['animate__animated', 'animate__fadeInUp'],
    'teamImage3': ['animate__animated', 'animate__fadeInRight'],

    'horaireHeader1': ['animate__animated', 'animate__fadeIn'],
    'horaireHeader2': ['animate__animated', 'animate__fadeIn'],
    'horaireFooter1': ['animate__animated', 'animate__fadeIn'],
    'horaireFooter2': ['animate__animated', 'animate__fadeIn'],
    // Ajoutez les autres éléments et leurs classes d'animation ici


  };
  
  // Liste des éléments à observer
  const elementsToObserve = Object.keys(animations).map((id) => document.getElementById(id));
  
  // Ajout des éléments à observer
  elementsToObserve.forEach((element) => {
    observer.observe(element);
  });
  