// import "../css/public/baseline/variables.scss"
// import "../css/public/baseline/baseline.scss"

// import "../css/public/modules/nav.scss"


// Component
import { createApp } from 'vue'
import ModaleReservation from './components/ModaleReservation.vue'
import Carte from './components/Carte.vue'; 

const createMyApp = () => {
    const app = createApp();
    return app;
};

// Modale Resa
const app = createMyApp();
app.component('counter', ModaleReservation)
app.mount('#app'); 


// Carte request
const app2 = createMyApp();
app2.component('carte', Carte);
app2.mount('#carte');


document.addEventListener('DOMContentLoaded', function () {
    // Trouvez l'élément de l'alerte par son identifiant
    var successAlert = document.getElementById('success-alert');

    // Si l'alerte est présente, planifiez sa suppression après 5 secondes
    if (successAlert) {
        setTimeout(function () {
            successAlert.remove(); // Supprimez l'élément de l'alerte
        }, 5000); // 5000 millisecondes équivalent à 5 secondes
    }
});


