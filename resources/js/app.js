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