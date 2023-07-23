<!-- ComposantPrincipal.vue -->
<template>
    <div>
      <!-- Utilisation des sous-composants dans le composant principal -->
      <!-- <Navigation v-model="categorieSelectionnee"/> -->
        <div class="md:flex gap-2 bg-light w-[90%] md:w-fit mx-auto rounded-md md:rounded-full space-y-2 md:space-y-0">
            <div>
                <button class="px-5 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'entrees' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('entrees')">Entrée</button>
            </div>

            <div>
                <button class="px-5 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'plats' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('plats')">Plat</button>
            </div>

            <div>
                <button class="px-5 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'accompagnements' ? 'bg-primary text-light' : ''" 
                @click="selectionnerCategorie('accompagnements')">Accompagnements</button>
            </div>

            <div>
                <button class="px-5 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in" 
                :class="categorieSelectionnee === 'desserts' ? 'bg-primary text-light' : ''" 
                @click="selectionnerCategorie('desserts')">Desserts</button>
            </div>

            <div>
                <button class="px-5 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in" 
                :class="categorieSelectionnee === 'vins' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('vins')">Vins</button>
            </div>

            <div>
                <button class="px-5 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in" 
                :class="categorieSelectionnee === 'alcools' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('alcools')">Alcools</button>
            </div>

            <div>
                <button class="px-5 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'softs' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('softs')">Boissons non alcolisées</button>
            </div>

        </div>


        <Entrees v-if="categorieSelectionnee === 'entrees'" />
        <Plats v-if="categorieSelectionnee === 'plats'" />
        <Desserts v-if="categorieSelectionnee === 'desserts'" />
        <Accompagnements v-if="categorieSelectionnee === 'accompagnements'"/>
        <Softs v-if="categorieSelectionnee === 'softs'"/>
        <Alcools v-if="categorieSelectionnee === 'alcools'"/>
        <Vins v-if="categorieSelectionnee === 'vins'"/>

       
    </div>
  </template>
  
  <script>
  import Navigation from './carte/Navigation.vue';
  import Entrees from './carte/Entrees.vue';
  import Plats from './carte/Plats.vue';
  import Desserts from './carte/Desserts.vue';
  import Softs from './carte/Softs.vue';
  import Alcools from './carte/Alcools.vue';
  import Accompagnements from './carte/Accompagnements.vue';
  import Vins from './carte/Vins.vue'; 
  

  export default {
    
    components: {
        Navigation,
        Entrees,
        Plats,
        Desserts,
        Softs,
        Alcools, 
        Accompagnements,
        Vins,
        
    },
    data() {
      return {
        categorieSelectionnee: 'entrees' // Catégorie par défaut affichée lors du chargement de la page,
      };
    },
    methods: {
      selectionnerCategorie(categorie) {
        this.categorieSelectionnee = categorie;
      }
    }
  }
  </script>
  
  <style>
  /* Styles pour le composant principal */
  </style>
  