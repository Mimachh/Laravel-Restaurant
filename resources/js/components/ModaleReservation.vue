<template>
    <div>
      <button @click="openModal">Ouvrir la fenêtre modale</button>
  
      <!-- Fenêtre modale -->
      <div v-if="showModal" class="modal" @click="closeModalOutside">
        <div class="modal-content">
          <!-- Contenu de la fenêtre modale -->
          <h2>Réserver une table</h2>
            <!-- Page 1 -->
            <div v-if="currentPage === 1" class="page_1">
                <p v-if="fermetureData.status == 1" >
                    Ce paragraphe ne doit être affiché que si fermeture->status == 1
                </p>
        
                <label for="reservationDate">Date de réservation :</label>
                <VueDatePicker
                    v-model="selectedDate"
                    :disabled-dates="disabledDates"
                    :enable-time-picker="false"
                    teleport-center
                    @update:modelValue="handleDateSelection"
                ></VueDatePicker>
            </div>

            <!-- Page 2 -->
            <div v-if="currentPage === 2" >
                <p>{{ selectedChoice }}</p>
                <!-- Choix du service -->
                <div class="ensemble_des_radios_buttons">
                    <div class="radio_div" v-if="isRestaurantOpenMidi">
                        <input type="radio" 
                        name="service" 
                        id="midi" 
                        value="midi" 
                        @change="handleRadioChange"
                        v-model="selectedService"
                        >
                        <label class="label-radio" for="midi">
                            <span>Midi</span>
                            <svg id="icone" class="sun" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M276,170a106,106,0,0,0-84.28,170.28A106,106,0,0,0,340.28,191.72,105.53,105.53,0,0,0,276,170Z" fill="#f7ad1e"/><path d="M150.9,242.12A107.63,107.63,0,0,0,150,256a106,106,0,1,0,19.59-61.37" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><path d="M157.56,216.68c-.17.41-.34.81-.5,1.22" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="256" x2="256" y1="64" y2="123"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="256" x2="256" y1="389" y2="447.99"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="120.24" x2="161.96" y1="120.24" y2="161.95"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="350.04" x2="391.76" y1="350.04" y2="391.76"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="64" x2="123" y1="256" y2="256"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="389" x2="448" y1="256" y2="256"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="120.24" x2="161.96" y1="391.76" y2="350.04"/><line fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" x1="350.04" x2="391.76" y1="161.95" y2="120.24"/></svg>
                        </label>
                        <small>Couverts restants: {{ nbCouvertsMidi  }}</small>
                    </div>
                    <div class="radio_div" v-if="isRestaurantOpenSoir" >
                        <input type="radio" 
                        name="service" 
                        id="soir" 
                        value="soir" 
                        @change="handleRadioChange"
                        v-model="selectedService"
                        >
                        <label class="label-radio" for="soir">
                            <span>Soir</span>
                            <svg class="moon" id="icone" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title/><path d="M276.6,127.6A148.4,148.4,0,0,0,162.14,370.46,148.49,148.49,0,0,0,326.47,387a150.66,150.66,0,0,1-15.94-16.51,148.38,148.38,0,0,1,9.79-236.29A148.18,148.18,0,0,0,276.6,127.6Z" fill="#fff133"/><path d="M116.5,207c-.37,1.05-.73,2.11-1.07,3.17" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><path d="M109.77,234.43a148.43,148.43,0,0,0,221,150.11,148.44,148.44,0,0,1,0-257.08,148.46,148.46,0,0,0-204,56.62" fill="none" stroke="#02005c" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/></svg>
                        </label>
                        <small>Couverts restants: {{ nbCouvertsSoir  }}</small>
                    </div>
                </div>
                
            </div>

            <!-- Page 3 -->
            <div v-if="currentPage === 3" >
                page 3
            </div>
            <!-- Pagination -->
            <div class="pagination_buttons">
                <button v-if="currentPage === 2 || currentPage === 3" @click="goToPage(currentPage - 1)">Précédent</button>
                <button v-if="selectedDate && currentPage === 1 || selectedService && currentPage === 2" @click="goToPage(currentPage + 1)">Page suivante</button>
            </div>
          <button id="closeModalButton" @click="closeModal">X</button>
        </div>
      </div>
    </div>
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
    const showModal = ref(false);

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

    // Dates désactivées
    const disabledDates = ref([]);

    // Jour selectionné pour faire des vérifications dessus
    const selectedDay = ref(null);

    // Date selectionnée dans le date picker
    const selectedDate = ref(null);



    const openModal = () => {
      showModal.value = true;
    };

    const closeModal = () => {
      showModal.value = false;
    };

    const closeModalOutside = (event) => {
      if (event.target.classList.contains('modal')) {
        closeModal();
      }
    };

    // BOUTONS SERVICE
    const handleRadioChange = async (event) => {
        selectedService.value = event.target.value;

        try {
            const response = await axios.get(`api/jours/${selectedDay.value}/${selectedService.value}/creneaux`);
            const openingHours = response.data;

            const creneaux = [];
            let start = openingHours.ouverture;
            const end = subtractMinutes(openingHours.fermeture, 30);

            while (start <= end) {
            creneaux.push(start);
            // Ajouter 30 minutes à l'heure de début
            start = addMinutes(start, 30);
            }

            console.log(creneaux);

            if (selectedService.value === 'midi' || selectedService.value === 'soir') {
            setTimeout(() => {
                goToPage(3);
            }, 100); // Délai d'une seconde (1000 millisecondes)
            }
        } catch (error) {
            console.error("Erreur lors de la récupération des informations d'ouverture du restaurant", error);
        }
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
        if (currentPage.value === 1 && selectedDate.value) {
            // Récupérer le jour de la semaine correspondant à la date sélectionnée
           selectedDay.value = dayjs(selectedDate.value).day();
            
            // Assigner l'index du jour sélectionné dans la semaine à selectedChoice
            // selectedChoice.value = selectedDay;

            // Effectuer la requête vers le point de terminaison Laravel avec l'ID du jour sélectionné
            axios.get(`api/jours/${selectedDay.value}/opening-hours`)
            .then((response) => {
                const openingHours = response.data;
                if (openingHours.is_open_midi === 1 && openingHours.is_open_soir === 1) {
                    selectedChoice.value = "Le restaurant est ouvert pour le midi et le soir.";
                    isRestaurantOpenMidi.value = true;
                    isRestaurantOpenSoir.value = true;

                    console.log(openingHours.couverts_soir);

                    if(openingHours.couverts_midi !== null) {
                        nbCouvertsMidi.value = openingHours.couverts_midi;
                    } else {
                        nbCouvertsMidi.value = 'Non renseigné';
                    }

                    if(openingHours.couverts_soir !== null) {
                        nbCouvertsSoir.value = openingHours.couverts_soir;
                    } else {
                        nbCouvertsSoir.value = 'Non renseigné';
                    }
                    
                } else if (openingHours.is_open_midi === 1) {
                    isRestaurantOpenMidi.value = true;
                    isRestaurantOpenSoir.value = false;

                    // Vérification nb de couverts
                    if(openingHours.couverts_midi !== null) {
                        nbCouvertsMidi.value = openingHours.couverts_midi;
                    } else {
                        nbCouvertsMidi.value = 'Non renseigné';
                    }
                    nbCouvertsSoir.value = "";

                selectedChoice.value = "Le restaurant est ouvert uniquement pour le midi.";
                } else if (openingHours.is_open_soir === 1) {
                    selectedChoice.value = "Le restaurant est ouvert uniquement pour le soir.";
                    isRestaurantOpenSoir.value = true;
                    isRestaurantOpenMidi.value = false;

                    // Vérification nb de couverts
                    nbCouvertsMidi.value = "";

                    if(openingHours.couverts_soir !== null) {
                        nbCouvertsSoir.value = openingHours.couverts_soir;
                    } else {
                        nbCouvertsSoir.value = 'Non renseigné';
                    }
                } else {
                    selectedChoice.value = "Le restaurant est fermé ce jour-là.";
                    isRestaurantOpenMidi.value = false;
                    isRestaurantOpenSoir.value = false;

                    nbCouvertsMidi.value = "";
                    nbCouvertsSoir.value = "";
                }
                
                goToPage(2);
            })
            .catch((error) => {
                console.error("Erreur lors de la récupération des informations d'ouverture du restaurant", error);
            });
        }
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
            generateDisabledDates();
        } catch (error) {
            console.error("Erreur lors de la récupération des données de l'API des jours", error);
        }
    };

    // TABLE FERMETURE
    const getFermetureData = async () => {
        try {
            const response = await axios.get('api/fermeture');
            fermetureData.value = response.data;
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
        if (jour.is_open_midi != 1 && jour.is_open_soir != 1) {
            idDayDisabled.push(jour.id);
        }
        });
    }

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

    onMounted(() => {
      getJoursData();
      getFermetureData();
    });

    return {
        showModal,
        joursData,
        currentPage,
        fermetureData,
        disabledDates,
        openModal,
        closeModal,
        closeModalOutside,
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
    };
  },
};
  </script>
  
  <style>
  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .modal-content {
    background-color: var(--public-light-creme);
    padding: 20px;
    /* width: 100%;
    height: 100%; */
    display: block;
    position: relative;
  }

  .page_1 {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    padding: 1rem 0.5rem;
  }

  .ensemble_des_radios_buttons {
    display: flex;
  }

  #closeModalButton {
    background-color: red;
    border: none;
    outline: 1px solid var(--public-dark);
    color: var(--public-dark);
    padding: 0.2rem 0.4rem;
    border-radius: var(--border-radius);
    font-weight: 600;
    font-size: 0.8rem;

    position: absolute;
    top: 0;
    right: 0;
    transform: translate(-15%, 15%);

    cursor: pointer;
  }

  .pagination_buttons {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }

.radio_div {

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; 
    gap: 0.4rem;
    padding: 1rem 0;
    width: 100%;
    height: fit-content;
}

  /* Bouton radios */
  input[type="radio"] {
    -webkit-appearance: none;
  }

  label.label-radio {
    height: 60px;
    width: 90px;
    border-radius: var(--border-radius);
    border: 2px solid var(--hover-info);
    position: relative;
    text-align: center;
    transition: 0.5s;
    cursor: pointer;
  }

small {
    display: inline-flex;
    width: 120px;
    text-align: center;
}
  .sun, .moon {
    position: absolute !important;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -30%);
    width: 40px !important;
    height: auto;
    /* background-color: red !important; */
  }

  input[type="radio"]:checked + label.label-radio {
	background-color: var(--hover-info);
	color: var(--public-light);
	box-shadow: 0 15px 45px rgb(24,249,141,0.2);
}

  </style>
  