<template>
    <div>
      <button @click="openModal">Ouvrir la fenêtre modale</button>
  
      <!-- Fenêtre modale -->
      <!-- <div v-if="showModal" class="modal" @click="closeModalOutside"> -->
        <div class="modal-content">
          <!-- Contenu de la fenêtre modale -->
          <h2>Réserver une table</h2>
          <p v-if="fermetureData.status == 1">
            Ce paragraphe ne doit être affiché que si fermeture->status == 1
          </p>
  
          <label for="reservationDate">Date de réservation :</label>
          <VueDatePicker
            v-model="date"
            :disabled-dates="disabledDates"
            :enable-time-picker="false"
          ></VueDatePicker>
  
          <p>Ceci est le contenu de la fenêtre modale.</p>
          <button @click="closeModal">Fermer</button>
        </div>
      </div>
    <!-- </div> -->
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
    const date = ref(null);
    const joursData = ref([]);
    const fermetureData = ref({});
    const disabledDates = ref([]);

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

    const getJoursData = () => {
      axios
        .get('api/jours')
        .then((response) => {
          joursData.value = response.data;
          generateDisabledDates();
        })
        .catch((error) => {
          console.error(
            "Erreur lors de la récupération des données de l'API des jours",
            error
          );
        });
    };

    const getFermetureData = () => {
      axios
        .get('api/fermeture')
        .then((response) => {
          fermetureData.value = response.data;
        })
        .catch((error) => {
          console.error(
            "Erreur lors de la récupération des données de l'API de fermeture",
            error
          );
        });
    };

    const generateDisabledDates = () => {
      const currentDate = dayjs();
      const startOfWeek = currentDate.startOf('week');
      const endOfWeek = currentDate.endOf('week');
      const disabledDatesArray = [];

      const idDayDisabled = [];
      if (Array.isArray(joursData.value)) {
        joursData.value.forEach((jour) => {

          if(jour.is_open_midi != 1 && jour.is_open_soir != 1) {
            idDayDisabled.push(jour.id);
          }

        });

       
      }

        // Remplacer 7 par 0 si présent dans idDayDisabled
        const index = idDayDisabled.indexOf(7);
        if (index !== -1) {
            idDayDisabled.splice(index, 1, 0);
        }
        console.log(idDayDisabled);
          // Parcourir toutes les semaines
      for (let i = 0; i < 52; i++) {
        // Parcourir tous les jours de la semaine
        for (let j = 0; j < 7; j++) {
          const targetDate = startOfWeek.add(i, 'weeks').add(j, 'days');
          // Vérifier si le jour est un mercredi
          if (idDayDisabled.includes(targetDate.day())) {
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
      date,
      joursData,
      fermetureData,
      disabledDates,
      openModal,
      closeModal,
      closeModalOutside,
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
    background-color: #fff;
    padding: 20px;
  }
  </style>
  