import './bootstrap';
import '../css/welcome-page.scss'



// Component
import { createApp } from 'vue'
import ModaleReservation from './components/ModaleReservation.vue'
import Carte from './components/Carte.vue'; 

const app = createApp()
 
app.component('counter', ModaleReservation)
 
app.mount('#app')


app.component('carte', Carte); // Enregistrez le deuxième composant sous un nom de balise personnalisé

app.mount('#carte');


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