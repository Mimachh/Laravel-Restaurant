<style>
.ensemble_des_radios_buttons {
  display: flex;
}

.btn-save {
  outline: 1px solid var(--info);
  color: var(--public-light);
  background-color: var(--info);
}

.btn-save:hover {
  outline: 1px solid var(--info);
  color: var(--info);
  background-color: var(--public-light);
}

.radio_div {

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center; 
  gap: 0.4rem;
  padding: 1rem 0;
  height: fit-content;
}

/* Bouton radios */
input[type="radio"] {
  -webkit-appearance: none;
}

label.label-radio {
  height: 80px;
  width: 140px;
  border-radius: var(--border-radius);
  /* border: 2px solid var(--hover-info); */
  position: relative;
  text-align: center;
  transition: 0.5s;
  cursor: pointer;
}

.sun, .moon {
  position: absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -30%);
  width: 50px !important;
  height: auto;
  /* background-color: red !important; */
}

input[type="radio"]:checked + label.label-radio {
  background-color: var(--hover-info);
  color: var(--public-light);
  box-shadow: 0 15px 45px rgb(24,249,141,0.2);
}

dialog {
  display: none;
}
dialog[open] {
  display: block;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}
.text-muted {
  color: gray;
}

.lds-ring {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 64px;
  height: 64px;
  margin: 8px;
  border: 8px solid #20202f;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: #20202f transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>

<template>
    <!-- <button @click="openDialog" id="openModalBtn" v-if="fermetureData.status !== 1 && resaOnlineActive.is_online_booking == 1">Ouvrir la fenêtre modale</button> -->
    <dialog id="modalResa" ref="modalResa" class="w-[85%] xl:w-[60%] min-h-[60%] rounded-md modalResa" @click="closeDialogOutside">
      <form @submit.prevent="submitForm" v-if="fermetureData.status !== 1 && resaOnlineActive.is_online_booking == 1" >
        <div>
            <h2 class="text-center font-bold text-xl md:text-3xl mt-4 md:mt-8">Réserver une table</h2>
            
            <!-- NAVIGATION -->
            <div class="my-8">
              <ul class="flex flex-wrap justify-between lg:w-[60%] w-full mx-auto
              bg-creme  rounded-full text-sm md:text-md
              ">
              
              <!-- DATE -->
                <li class="rounded-full"
                
                ><button 
                @click="goToPage(1)"
                class="py-3 px-3 md:px-8  hover:bg-primary hover:text-light rounded-full"
                :class="{ 'bg-primary text-light': currentPage === 1}" 
                type="button">Date</button></li>

              <!-- SERVICE -->
                <li class="rounded-full relative"
                :class="{
                
                 }"
                ><button 
                @click="goToPage(2)"
                type="button"
                class="py-3 px-3 md:px-8 rounded-full"
                :class="{ 
                  'bg-primary text-light': currentPage === 2,
                  'text-muted cursor-not-allowed': !selectedDate && currentPage === 1,
                  'hover:bg-primary hover:text-light' : selectedDate
                }"
                >Service</button>
              <div v-if="!selectedDate && currentPage === 1" class="absolute inset-0 cursor-not-allowed"></div>
              </li>

              <!-- HEURE -->
                <li class="rounded-full relative"
                ><button 
                @click="goToPage(3)"
                type="button"
                class="py-3 px-3 md:px-8 rounded-full"
                :class="{ 
                  'bg-primary text-light': currentPage === 3,
                  'text-muted cursor-not-allowed': !selectedService,
                  'hover:bg-primary hover:text-light' : selectedService
                }"
                >Heure</button>
                <div v-if="!selectedService" class="absolute inset-0 cursor-not-allowed"></div>
                </li>

                
              <!-- INFOS -->
                <li class="rounded-full relative"
                ><button 
                @click="goToPage(4)"
                type="button"
                class="py-3 px-3 md:px-8 rounded-full"
                :class="{ 
                  'bg-primary text-light': currentPage === 4,
                  'text-muted cursor-not-allowed': !selectedCreneau,
                  'text-muted cursor-not-allowed':  !numberOfGuests,
                  'hover:bg-primary hover:text-light' : selectedCreneau && numberOfGuests
                }"
                >Informations</button>
                <div v-if="!selectedCreneau && !numberOfGuests" class="absolute inset-0 cursor-not-allowed"></div>
                </li>
              </ul>
            </div>

            <!-- Messages d'erreur -->
            <div v-if="errorMessages.length > 0" class="text-center">
              <ul class="space-y-1 bg-error">
                <li v-for="errorMessage in errorMessages" :key="errorMessage">
                  {{ errorMessage }}
                </li>
              </ul>
            </div>
            <!-- Message success -->
            <div v-if="successMessages.length > 0" class="success-messages">
              <ul class="bg-successBG text-center text-success">
                <li v-for="successMessage in successMessages" :key="successMessage">
                  {{ successMessage }}
                </li>
              </ul>
            </div>
            <!-- Ajouter le nouvel élément pour l'erreur unique -->
            <div v-if="errorUnique">
              <ul class="text-center bg-error">
                <li>{{ errorUnique }}</li>
              </ul>
            </div>

            <!-- LOADING -->
            <div v-if="loading" class="flex justify-center py-16">
              <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
              <!-- <p>Loading...</p> -->
            </div>
            <!-- PAGE 1 -->
            <div v-if="currentPage === 1 && loading == false" class="pt-4 pb-6">          
              <label for="reservationDate" 
              class="block py-2 text-primary font-medium text-lg md:text-2xl"
              >Date de réservation :</label>
              <VueDatePicker
                  v-model="selectedDate"
                  :disabled-dates="disabledDates"
                  :enable-time-picker="false"
                  teleport-center
                  @update:modelValue="handleDateSelection"
              ></VueDatePicker>
            </div>

            <!-- PAGE 2 -->
            <div v-if="currentPage === 2 && loading == false" >
                  
                  <!-- Choix du service -->
                  <h3 class="text-center font-medium text-lg md:text-2xl">Choisissez votre service</h3>
                  <p class="text-center font-normal text-md">{{ selectedChoice }}</p>
                  <div class="ensemble_des_radios_buttons justify-center gap-8 md:gap-24">
                      <div class="radio_div" v-if="isRestaurantOpenMidi">
                          <input type="radio" 
                          name="service" 
                          id="midi" 
                          value="midi" 
                          @change="handleRadioChange"
                          v-model="selectedService"
                          >
                          <label class="label-radio border border-primary" for="midi">
                              <span class="font-medium">Midi</span>
                              <svg id="icone" class="sun" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M276,170a106,106,0,0,0-84.28,170.28A106,106,0,0,0,340.28,191.72,105.53,105.53,0,0,0,276,170Z" fill="#f7ad1e"/><path d="M150.9,242.12A107.63,107.63,0,0,0,150,256a106,106,0,1,0,19.59-61.37" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><path d="M157.56,216.68c-.17.41-.34.81-.5,1.22" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="256" x2="256" y1="64" y2="123"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="256" x2="256" y1="389" y2="447.99"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="120.24" x2="161.96" y1="120.24" y2="161.95"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="350.04" x2="391.76" y1="350.04" y2="391.76"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="64" x2="123" y1="256" y2="256"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="389" x2="448" y1="256" y2="256"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="120.24" x2="161.96" y1="391.76" y2="350.04"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="350.04" x2="391.76" y1="161.95" y2="120.24"/></svg>
                          </label>
                          <small class="font-normal text-primary text-md">Couverts restants: {{ nbCouvertsMidi  }}</small>
                      </div>
                      <div class="radio_div" v-if="isRestaurantOpenSoir" >
                          <input type="radio" 
                          name="service" 
                          id="soir" 
                          value="soir" 
                          @change="handleRadioChange"
                          v-model="selectedService"
                          >
                          <label class="label-radio  border border-primary" for="soir">
                              <span class="font-medium">Soir</span>
                              <svg class="moon" id="icone" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M276.6,127.6A148.4,148.4,0,0,0,162.14,370.46,148.49,148.49,0,0,0,326.47,387a150.66,150.66,0,0,1-15.94-16.51,148.38,148.38,0,0,1,9.79-236.29A148.18,148.18,0,0,0,276.6,127.6Z" fill="#fff133"/><path d="M116.5,207c-.37,1.05-.73,2.11-1.07,3.17" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><path d="M109.77,234.43a148.43,148.43,0,0,0,221,150.11,148.44,148.44,0,0,1,0-257.08,148.46,148.46,0,0,0-204,56.62" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/></svg>
                          </label>
                          <small class="font-normal text-primary text-md">Couverts restants: {{ nbCouvertsSoir  }}</small>
                      </div>
                  </div>
                  
            </div>

            <!-- PAGE 3 -->
            <div v-if="currentPage === 3 && loading == false" class="w-[80%] md:w-[60%] mx-auto">
              <h3 class="text-center font-medium text-lg md:text-2xl">Sélectionnez un créneau horaire :</h3>
              <div class="w-full py-4 md:py-8">
                  <select v-model="selectedCreneau" 
                  class="border border-primary w-full py-2 rounded-md text-center font-normal md:font-medium text-md md:text-lg
                  focus:outline-none focus:visible-none
                  ">
                      <option :value="null" disabled>Choisissez votre créneau</option>
                      <option v-for="creneau in creneaux" :value="creneau" :key="creneau" :selected="creneaux.indexOf(creneau) === 0">{{ creneau }}</option>
                  </select>
              </div>

              <h3 class="text-center font-medium text-lg md:text-2xl">Nombre d'invités : </h3>
              <div class="w-full py-4 md:py-8">
                  <input
                  class="border border-primary rounded-md w-full py-2 
                  text-center md:font-medium text-md md:text-lg
                  focus:outline-none focus:visible-none
                  " 
                  v-model.lazy="numberOfGuests" 
                  name="couverts" 
                  id="couverts" 
                  type="number"
                  @change="handleNumberChange"
                  >
                  <div v-if="errorCouvertsRestantsMessage" 
                  class="w-full text-center bg-error py-3 my-4 md:my-8 text-light font-normal text-md md:text-lg rounded-md"
                  >{{ errorCouvertsRestantsMessage }}</div>

                  <div v-if="successCouvertsRestantsMessage" 
                  class="w-full text-center bg-successBG py-3 my-4 md:my-8 text-success font-normal text-md md:text-lg rounded-md"
                  >{{ successCouvertsRestantsMessage }}</div>
              </div>
            </div>

            <!-- PAGE 4 -->
            <div v-if="currentPage === 4 && loading == false" class="w-[90%] md:w-[80%] lg:w-[60%] mx-auto">
              <h3 class="text-center font-medium text-lg md:text-2xl">Vos informations personnelles</h3>
              <div class="w-full flex flex-col gap-2 py-1 md:py-3">
                <label for="nom" class="font-medium text-md md:text-lg">Nom *</label>
                <input 
                class="border border-primary rounded-md py-2 pl-4 focus:visible-none focus:outline-none"
                v-model="nom" name="nom" id="nom" type="text" placeholder="Votre nom" required>
              </div>
              
              <div class="w-full flex flex-col gap-2 py-1 md:py-3">
                <label for="prenom" class="font-medium text-md md:text-lg">Prénom *</label>
                <input 
                class="border border-primary rounded-md py-2 pl-4 focus:visible-none focus:outline-none"
                v-model="prenom" name="prenom" id="prenom" type="text" placeholder="Votre prénom" required>
              </div>

              <div class="w-full flex flex-col gap-2 py-1 md:py-3">
                <label for="mail" class="font-medium text-md md:text-lg">Mail *</label>
                <input 
                class="border border-primary rounded-md py-2 pl-4 focus:visible-none focus:outline-none"
                v-model="mail" name="mail" id="mail" placeholder="Votre mail" type="email" required>
              </div>

              <div class="w-full flex flex-col gap-2 py-1 md:py-3">
                <label for="telephone" class="font-medium text-md md:text-lg">Téléphone</label>
                <input 
                class="border border-primary rounded-md py-2 pl-4 focus:visible-none focus:outline-none"
                v-model="telephone" placeholder="Votre téléphone" name="telephone" id="telephone" type="tel">
              </div>

              <div class="w-full flex flex-col gap-2 py-1 md:py-3">
                <label for="informations" class="font-medium text-md md:text-lg">Informations supplémentaires (allergies, demandes particulières)</label>
                <textarea 
                class="border border-primary rounded-md py-2 pl-4 focus:visible-none focus:outline-none"
                rows="4" v-model="informations" name="informations" id="informations"></textarea>
              </div>

              <div class="w-full flex items-center gap-4 py-1 md:py-3">
                <input 
                v-model="conditionsUtilisation" name="conditionsUtilisation" id="conditionsUtilisation" type="checkbox" required
                value="1">
                <label for="conditionsUtilisation" class="font-normal">J'accepte les conditions d'utilisation *</label>
              </div>
            </div>

              <!-- Page 5 -->
              <div v-if="currentPage === 5">
                <div v-if="confirmationMessage" class="confirmation-messages">
                      <p class="text-center">{{ confirmationMessage }}</p>  
                </div>
              </div>

            <div class="w-full mx-auto text-center py-6">
              <button  v-if="selectedDate && selectedService && selectedCreneau && numberOfGuests && currentPage === 4"
                type="submit"
                class="bg-primary px-6 py-2 rounded-md text-light
                font-medium font-quicksand
                border border-transparent hover:bg-light hover:text-primary hover:border-primary"
              >Soumettre</button>
            </div>

            <button type="button" class="bg-error px-3 py-1 rounded-xl font-bold font-quicksand absolute top-0 right-0 mr-2 mt-2"  @click="closeDialog">X</button>
        </div>
      </form>  
      <p v-if="fermetureData.status === 1 || resaOnlineActive.is_online_booking !== 1">Les réservations ne sont pas disponibles pour l'instant</p>
      {{ fermetureData.status }}
      {{ resaOnlineActive.is_online_booking }}
    </dialog>
  </template>
  
  <script>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { ref, onMounted } from 'vue';
import dayjs from 'dayjs';
import axios from 'axios';

import isSameOrBefore from 'dayjs/plugin/isSameOrBefore';
import 'dayjs/locale/fr';


dayjs.extend(isSameOrBefore);
dayjs.locale('fr');

export default {
  components: { VueDatePicker },
  setup() {
   const modalResa = ref(null);
    const showModal = ref(false);
    const loading = ref(false);
    const errorCouvertsRestantsMessage = ref('');
    const successCouvertsRestantsMessage = ref('');
    const errorMessages = ref([]);
    const successMessages = ref([]);
    const errorUnique = ref('');
    const confirmationMessage = ref('');
    // Gestion des pages
    const currentPage = ref(1);

    // V-model du datepicker
    // const date = ref(null);

    // Trouver l'index du jour selectionné
    const selectedChoice = ref('');

    // Vérifier si ouvert midi + couverts
    const isRestaurantOpenMidi = ref(false);
    const nbCouvertsMidi = ref('');
    // Vérifier si ouvert soir + couverts
    const isRestaurantOpenSoir = ref(false);
    const nbCouvertsSoir = ref('');


    // Service selectionné
    const selectedService = ref(null);

    // Table jours
    const joursData = ref([]);

    // Table fermeture
    const fermetureData = ref({});
    const resaOnlineActive = ref({});
    // Dates désactivées
    const disabledDates = ref([]);

    // Jour selectionné pour faire des vérifications dessus
    const selectedDay = ref(null);

    // Date selectionnée dans le date picker
    const selectedDate = ref(null);
    // Formatage de ma date sélectionnée
    const formattedDateToStore = ref(null);

    // Tableau des creneaux
    const creneaux = ref([]);
    // Créneaux horaires sélectionnés
    const selectedCreneau = ref(null);

    // Nombre d'invité
    const numberOfGuests = ref(null);

    // Nom du service et de la date pour enregistrer le nombre de couverts
    const serviceDateCouverts = ref(null);
    // Nombre de couverts restants pour enregistrer en base de données
    const serviceCouvertsRestants = ref(null);
    const nombreDeCouvertsRestantsDeBase = ref(null);

    // Vérification si couvertsrestantstable existe
    const nombreRestantAprèsTestMatin = ref(null);
    const nombreRestantAprèsTestSoir = ref(null);

    // Formulaire de fin
    const nom = ref(null);
    const prenom = ref(null);
    const mail = ref(null);
    const telephone = ref(null);
    const informations = ref(null);
    const conditionsUtilisation = ref(false);


    const openDialog = () => {
      modalResa.value.showModal();
 
    }

    const closeDialogOutside = (event) => {
      if (event.target.classList.contains('modalResa')) {
        // closeModal();
        modalResa.value.close();
      }
      
      successCouvertsRestantsMessage.value = '';
      errorCouvertsRestantsMessage.value = '';
    }

    const closeDialog = () => {
      modalResa.value.close();
      successCouvertsRestantsMessage.value = '';
      errorCouvertsRestantsMessage.value = '';
    }



    // Fonction pour mettre à jour les créneaux
    const updateCreneaux = (creneauxData) => {
        creneaux.value = creneauxData;
    };

    // BOUTONS SERVICE
    const handleRadioChange = async (event) => {
        selectedService.value = event.target.value;
  
        try {
            loading.value = true;
            const response = await axios.get(`api/jours/${selectedDay.value}/${selectedService.value}/creneaux`);
            const openingHours = response.data;

            const creneaux = [];
            let start = openingHours.ouverture;
            const end = subtractMinutes(openingHours.fermeture, 30);

            while (start <= end) {
            creneaux.push(formatTime(start)); // Appel à la fonction formatTime pour formater l'horaire
            start = addMinutes(start, 30);
            }

            console.log(creneaux);
            updateCreneaux(creneaux);

            if (selectedService.value === 'midi' || selectedService.value === 'soir') {
            // setTimeout(() => {
            //     goToPage(3);
            // }, 10);
              goToPage(3);
            }
        } catch (error) {
            console.error("Erreur lors de la récupération des informations d'ouverture du restaurant", error);
        }
        loading.value = false;
    };

    const formatTime = (time) => {
    return time.slice(0, 5);
    };

    // Fonction pour ajouter des minutes à une heure donnée
    const addMinutes = (time, minutes) => {
        const date = new Date(`1970-01-01T${time}`);
        date.setMinutes(date.getMinutes() + minutes);
        return date.toTimeString().slice(0, 5);
    };

    // Fonction pour soustraire des minutes à une heure donnée
    const subtractMinutes = (time, minutes) => {
        const date = new Date(`1970-01-01T${time}`);
        date.setMinutes(date.getMinutes() - minutes);
        return date.toTimeString().slice(0, 5);
    };

    // Date picker
    const handleDateSelection = (value) => {
        selectedDate.value = value;
        errorUnique.value = "";
  
        // ICI JE REQUETE POUR VOIR SI UNE ENTREE EXISTE le MIDI OU LE SOIR
        formattedDateToStore.value = dayjs(selectedDate.value).format('DD-MM-YYYY');

        const testSiDataCouvertsRestantsTableExistMatin = async () => {
          const testerLeMatin = "AM+" + formattedDateToStore.value;
          try {
            loading.value = true;
            const response = await axios.get(`api/jours/${testerLeMatin}/couverts_restants`);
            // console.log('response', response.data);
            nombreRestantAprèsTestMatin.value = response.data.couverts_restants;
            if(response.data.message === "no exist") {
              nombreRestantAprèsTestMatin.value = null;
            }
          } catch (error) {
            console.error("Erreur lors de la récupération des informations du nombre de couverts restants", error);
          }
          // console.log('matin', nombreRestantAprèsTestMatin.value);

        }
        testSiDataCouvertsRestantsTableExistMatin();
        
        const testSiDataCouvertsRestantsTableExistSoir = async () => {
          const testerLeSoir = "PM+" + formattedDateToStore.value;
          try {
            loading.value = true;
            const response = await axios.get(`api/jours/${testerLeSoir}/couverts_restants`);
            // console.log(response.data);
            nombreRestantAprèsTestSoir.value = response.data.couverts_restants;
            if(response.data.message === "no exist") {
              nombreRestantAprèsTestSoir.value = null;
            }
            
          } catch (error) {
            console.error("Erreur lors de la récupération des informations du nombre de couverts restants", error);
          }

          // console.log('soir', nombreRestantAprèsTestSoir.value);

        }
        testSiDataCouvertsRestantsTableExistSoir();
        // FIN

        if (currentPage.value === 1 && selectedDate.value) {
       
            // Récupérer le jour de la semaine correspondant à la date sélectionnée
           selectedDay.value = dayjs(selectedDate.value).day();
            
            // Effectuer la requête vers le point de terminaison Laravel avec l'ID du jour sélectionné
            axios.get(`api/jours/${selectedDay.value}/opening-hours`)
            .then((response) => {
                const openingHours = response.data;
                if (openingHours.is_open_midi === 1 && openingHours.is_open_soir === 1) {
                    selectedChoice.value = "Le restaurant est ouvert pour le midi et le soir.";
                    isRestaurantOpenMidi.value = true;
                    isRestaurantOpenSoir.value = true;
   

                    if(nombreRestantAprèsTestMatin.value === null) {
                      if(openingHours.couverts_midi !== null) {
                        nbCouvertsMidi.value = openingHours.couverts_midi;
                      } else {
                          nbCouvertsMidi.value = 'Non renseigné';
                      }
                    } else {
                      nbCouvertsMidi.value = nombreRestantAprèsTestMatin.value;
                    }

                    if(nombreRestantAprèsTestSoir.value == null) {
                  
                        if(openingHours.couverts_soir !== null) {
                          nbCouvertsSoir.value = openingHours.couverts_soir;
                        } else {
                          nbCouvertsSoir.value = 'Non renseigné';
                        }
                    } else {
                      nbCouvertsSoir.value = nombreRestantAprèsTestSoir.value;
                    }

                    
                } else if (openingHours.is_open_midi === 1) {
                    isRestaurantOpenMidi.value = true;
                    isRestaurantOpenSoir.value = false;

                    // Vérification nb de couverts
                    if(nombreRestantAprèsTestMatin.value) {
                      nbCouvertsMidi.value = nombreRestantAprèsTestMatin.value;
                    } else {
                      if(openingHours.couverts_midi !== null) {
                        nbCouvertsMidi.value = openingHours.couverts_midi;
                      } else {
                          nbCouvertsMidi.value = 'Non renseigné';
                      }  
                    }
                    nbCouvertsSoir.value = "";

                selectedChoice.value = "Le restaurant est ouvert uniquement le midi.";
                } else if (openingHours.is_open_soir === 1) {
                    selectedChoice.value = "Le restaurant est ouvert uniquement le soir.";
                    isRestaurantOpenSoir.value = true;
                    isRestaurantOpenMidi.value = false;
                    console.log(nombreRestantAprèsTestSoir.value);
                    // Vérification nb de couverts
                    nbCouvertsMidi.value = "";

                    if(nombreRestantAprèsTestSoir.value) {
                      nbCouvertsSoir.value = nombreRestantAprèsTestSoir.value;
  
                    } else {
                      if(openingHours.couverts_soir !== null) {
                          nbCouvertsSoir.value = openingHours.couverts_soir;
                        } else {
                          nbCouvertsSoir.value = 'Non renseigné';
                        }
                    }
                } else {
                    selectedChoice.value = "Le restaurant est fermé ce jour-là.";
                    isRestaurantOpenMidi.value = false;
                    isRestaurantOpenSoir.value = false;

                    nbCouvertsMidi.value = "";
                    nbCouvertsSoir.value = "";
                }
                loading.value = false;
                goToPage(2);
            })
            .catch((error) => {
                console.error("Erreur lors de la récupération des informations d'ouverture du restaurant", error);
            });
        }
        
        

    };

    // Nombre d'invité
    const handleNumberChange = async () => {
        // Effectuez les actions souhaitées lorsque le nombre change
        errorUnique.value = "";
        // On cherche en base de données s'il reste des couverts
        var prefix = "";

        var verifPourPasserPageSuivante = "";
        
        if(selectedService.value === 'midi') {
            prefix = "AM";
        } else if(selectedService.value === 'soir') {
            prefix = 'PM';
        }

        serviceDateCouverts.value = prefix + "+" + formattedDateToStore.value; 
      
      // SI ENTREE DANS LA TABLE ON L'UTILISE
      var nbApresTest = null;
      if(selectedService.value === 'midi' && nombreRestantAprèsTestMatin.value !== null) {
        nbApresTest = nombreRestantAprèsTestMatin.value;
      } else if (selectedService.value === 'midi' && nombreRestantAprèsTestMatin.value === null) {
        nbApresTest = null;
      }

      if(selectedService.value === 'soir' && nombreRestantAprèsTestSoir.value !== null) {
        nbApresTest = nombreRestantAprèsTestSoir.value;
      } else {
        nbApresTest = null;
      }
      
    
      if(nbApresTest !== null) {
        loading.value = true;
        if(numberOfGuests.value >= 1) {
          if (nbApresTest >= numberOfGuests.value) {
            errorCouvertsRestantsMessage.value = '';
            successCouvertsRestantsMessage.value = `Il nous reste assez de place`;
            verifPourPasserPageSuivante = "ok";
          } else if (nbApresTest < numberOfGuests.value) {
            errorCouvertsRestantsMessage.value = `Désolé il ne reste que ${nbApresTest} places`;
            successCouvertsRestantsMessage.value = '';
            numberOfGuests.value = '';
            verifPourPasserPageSuivante = "non";
          }
        } else {
            // successCouvertsRestantsMessage.value = '';
            // errorCouvertsRestantsMessage.value = '';
        }
      }

        if(nbApresTest == null) {
          // DATA DE BASE
          try {
              loading.value = true;
              const response = await axios.get(`api/jours/${selectedDay.value}/${selectedService.value}/couverts`);
              // console.log('response de base', response.data);
              nombreDeCouvertsRestantsDeBase.value = response.data.couverts;
              serviceCouvertsRestants.value = response.data.couverts;
              if(numberOfGuests.value > 1) {
                if (serviceCouvertsRestants.value >= numberOfGuests.value) {
                  errorCouvertsRestantsMessage.value = '';
                  successCouvertsRestantsMessage.value = `Il nous reste assez de place`;
                  verifPourPasserPageSuivante = "ok";

                } else if (serviceCouvertsRestants.value < numberOfGuests.value) {
                  errorCouvertsRestantsMessage.value = `Désolé il ne reste que ${serviceCouvertsRestants.value} places`;
                  successCouvertsRestantsMessage.value = '';
                  numberOfGuests.value = '';
                  verifPourPasserPageSuivante = "non";
                }
              } else {
                  // successCouvertsRestantsMessage.value = '';
                  // errorCouvertsRestantsMessage.value = '';
              }
              // REMETTRE ICI LES CONDITIONS

          } catch (error) {
              console.error("Erreur lors de la récupération des informations du nombre de couverts restants", error);
          }
        }

        if(verifPourPasserPageSuivante === "ok" && selectedCreneau) {
          setTimeout(() => {
            // Modifiez la valeur de loading après le délai
            loading.value = false;
            // Appelez la fonction goToPage après le délai
            goToPage(4);
          }, 2000);
        } else if (verifPourPasserPageSuivante !== "ok" && selectedCreneau) {
          loading.value = false;
        }

      // Si entrée dans la table != no exist et différent de null alors on utilise, sinon on récupère la donnée de base.

    };

    const returnToPage1AndReset = () => {
      closeDialog();
      currentPage.value = 1;
      selectedDate.value = null;
      formattedDateToStore.value = null;
      selectedService.value = null;
      nom.value = null;
      prenom.value = null;
      telephone.value = null;
      informations.value = null;
      selectedCreneau.value = null;
      mail.value = null;
      conditionsUtilisation.value = null;
      numberOfGuests.value = null;
      serviceDateCouverts.value = null;
      nombreDeCouvertsRestantsDeBase.value = null;
    };

    // Changement de page
    const goToPage = (page) => {
      

      currentPage.value = page;
    };
    // TABLE JOURS
    const getJoursData = async () => {
        try {
            const response = await axios.get('api/jours');
            joursData.value = response.data;
            console.log(response.data);
            generateDisabledDates();
        } catch (error) {
            console.error("Erreur lors de la récupération des données de l'API des jours", error);
        }
    };

    // TABLE FERMETURE
    const getFermetureData = async () => {
        try {
            const response = await axios.get('api/fermeture');
            fermetureData.value = response.data.fermeture;
            console.log('fermeture', response.data.fermeture);
            resaOnlineActive.value = response.data.validation;
            console.log('validation', response.data.validation);
        } catch (error) {
            console.error("Erreur lors de la récupération des données de l'API de fermeture", error);
        }
    };


    // GENERER LES JOURS A DESACTIVER
    const generateDisabledDates = () => {
      const currentDate = dayjs();
      const startOfWeek = currentDate.startOf('week');
      const endOfWeek = currentDate.endOf('week');
      const disabledDatesArray = [];

      // les ids des jours correspondent à leur index dans le datepicker
      const idDayDisabled = [];
      if (Array.isArray(joursData.value)) {
          joursData.value.forEach((jour) => {
            console.log('joursData.value',joursData.value);
          if (jour.is_open_midi != 1 && jour.is_open_soir != 1) {
              idDayDisabled.push(jour.id);
          }
          });
      }
      
      console.log('disabledDate', idDayDisabled);
      // Remplacer 7 par 0 si présent dans idDayDisabled car le Dimanche vaut 0
      const index = idDayDisabled.indexOf(7);
      if (index !== -1) {
        idDayDisabled.splice(index, 1, 0);
      }

      // Tableau des dates spécifiques à désactiver
      const specificDatesDisabled = [
        { month: 11, day: 26 }, // Exemple : 25 décembre
        // Ajoutez d'autres dates ici au format { month: mois, day: jour }
        { month: 11, day: 27 },
      ];

      // Parcourir toutes les semaines
      for (let i = 0; i < 52; i++) {
        // Parcourir tous les jours de la semaine
        for (let j = 0; j < 7; j++) {
          const targetDate = startOfWeek.add(i, 'weeks').add(j, 'days');
          // Vérifier si le jour est désactivé ou fait partie des dates spécifiques à désactiver
          if (idDayDisabled.includes(targetDate.day()) || specificDatesDisabled.some(date => date.month === targetDate.month() && date.day === targetDate.date())) {
            disabledDatesArray.push(targetDate.toDate());
          }
        }
      }

      disabledDates.value = disabledDatesArray;
    };

    // CLEAN MES DONNEES
    const isValidEmail = (email) => {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    };

    const cleanFormData = () => {
      // var infoIfExistClean = "";
      // var telIfExistClean = "";
      // if(informations.value) {
      //   infoIfExistClean = informations.value.trim();
      // }

      // if(telephone.value) {
      //   telIfExistClean = telephone.value.trim();
      // }

      const cleanedData = {
        date: formattedDateToStore.value.trim(),
        service: selectedService.value.trim(),
        nom: nom.value.trim(),
        prenom: prenom.value.trim(),
        telephone: telephone.value,
        informations: informations.value,
        creneau: selectedCreneau.value.trim(),
        mail: isValidEmail(mail.value.trim()) ? mail.value.trim() : '',
        regles: conditionsUtilisation.value ? 1 : 0,
        convives: parseInt(numberOfGuests.value, 10) || 0,
        nomPourTableCouvertsRestants: serviceDateCouverts.value,
        nombreCouvertsRestants: nombreDeCouvertsRestantsDeBase.value,
        // Ajoutez d'autres champs du formulaire si nécessaire
      };

      return cleanedData;
    };


    const submitForm = async () => {
      try {
        loading.value = true;
        errorMessages.value = [];
        successMessages.value = [];
        const cleanedData = cleanFormData();

        console.log("Données du formulaire :", cleanedData);

        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        const response = await axios.post('/api/reservation', cleanedData, {
          headers: {
            'X-CSRF-TOKEN': csrfToken
          }
        });

        console.log(response.data.message);
        confirmationMessage.value = response.data.message;
        loading.value = false;
        goToPage(5);
        setTimeout(() => {
          returnToPage1AndReset();
        }, 3000); // Délai de 3 secondes (3000 millisecondes)
        // Traitez la réponse ou effectuez d'autres actions après la soumission réussie
      } catch (error) {
        console.log(error.response.data.error);
        if (error.response && error.response.status === 422 && error.response.data.errors) {
          // Récupérer les erreurs de validation de la réponse
          const validationErrors = error.response.data.errors;
          errorUnique.value = "";
          // Réinitialiser les messages d'erreur
          errorMessages.value = [];

          // Parcourir les erreurs de validation et ajouter les messages appropriés
          for (let field in validationErrors) {
            // errorMessages.value.push(validationErrors[field][0]);
            errorMessages.value = Object.values(validationErrors).flat();
          }
          console.log('erreurs')
          
        } else if (error.response.data.error === 'Désolé nous n\'avons plus de place disponible.') {
          // Réinitialiser les messages d'erreur
          errorMessages.value = [];
          console.log('erreur')
          // Récupérer l'erreur unique de la réponse
          const uniqueError = error.response.data.error;

          // Assigner l'erreur unique à la propriété error
          errorUnique.value = uniqueError;
        } else {
          console.error("Erreur lors de la soumission du formulaire", error);
          // Traitez les autres erreurs ici
        }
      }
    };

    onMounted(() => {
      getJoursData();
      getFermetureData();
      generateDisabledDates();
      modalResa.value = document.getElementById('modalResa');
    });

    return {
        loading,
        openDialog,
        closeDialogOutside,
        closeDialog,
        showModal,
        joursData,
        currentPage,
        fermetureData,
        resaOnlineActive,
        disabledDates,
        selectedDate,
        handleDateSelection,
        goToPage,
        selectedChoice,
        isRestaurantOpenMidi,
        isRestaurantOpenSoir,
        nbCouvertsMidi,
        nbCouvertsSoir,
        handleRadioChange,
        selectedService,
        selectedDay, 
        creneaux,
        updateCreneaux,
        selectedCreneau,
        numberOfGuests,
        handleNumberChange,
        formattedDateToStore,
        serviceDateCouverts,
        errorCouvertsRestantsMessage,
        successCouvertsRestantsMessage,
        nom,
        prenom,
        mail,
        telephone,
        informations,
        conditionsUtilisation,
        submitForm,
        errorMessages,
        successMessages,
        serviceCouvertsRestants,
        nombreDeCouvertsRestantsDeBase,
        nombreRestantAprèsTestMatin,
        nombreRestantAprèsTestSoir,
        errorUnique,
        confirmationMessage,
    };
  },
};

  </script>
  

  