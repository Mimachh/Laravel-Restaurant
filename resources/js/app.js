import './bootstrap';
import '../css/welcome-page.scss'



// Component
import { createApp } from 'vue'
import ModaleReservation from './components/ModaleReservation.vue'
 
const app = createApp()
 
app.component('counter', ModaleReservation)
 
app.mount('#app')