<template>
    <div class="pt-4 pb-24">
        <div class="md:flex gap-2 bg-light w-[90%] md:w-fit mx-auto rounded-md md:rounded-full space-y-2 md:space-y-0">
            <div>
                <button class="px-6 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'entrees' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('entrees')">Entrée</button>
            </div>

            <div>
                <button class="px-6 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'plats' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('plats')">Plat</button>
            </div>

            <div>
                <button class="px-6 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'accompagnements' ? 'bg-primary text-light' : ''" 
                @click="selectionnerCategorie('accompagnements')">Accompagnements</button>
            </div>

            <div>
                <button class="px-6 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in" 
                :class="categorieSelectionnee === 'desserts' ? 'bg-primary text-light' : ''" 
                @click="selectionnerCategorie('desserts')">Desserts</button>
            </div>

            <div>
                <button class="px-6 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in" 
                :class="categorieSelectionnee === 'vins' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('vins')">Vins</button>
            </div>

            <div>
                <button class="px-6 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in" 
                :class="categorieSelectionnee === 'alcools' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('alcools')">Alcools</button>
            </div>

            <div>
                <button class="px-6 py-3 w-full rounded-md md:rounded-full hover:bg-primary hover:text-light transition-colors duration-200 ease-in"
                :class="categorieSelectionnee === 'softs' ? 'bg-primary text-light' : ''"
                @click="selectionnerCategorie('softs')">Boissons non alcolisées</button>
            </div>

        </div>


        <div v-if="loading" class="flex justify-center py-16">
          <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
          <!-- <p>Loading...</p> -->
        </div>
        <Layout 
        :data="data"
        :cat="categorieSelectionnee"
        />
   
    </div>
  </template>
  
  <script>
  import Layout from './carte/LayoutCarte.vue'; 

  import axios from 'axios';


  export default {

    components: {
        Layout,
       
    },
    data() {
      return {
        categorieSelectionnee: 'entrees',
        data: [],
        loading: false,
      };
    },
    created() {
      // Au chargement de la page, appeler getData avec "entrees" comme valeur par défaut
      this.getData(this.categorieSelectionnee);
    },
    methods: {
      selectionnerCategorie(categorie) {
        this.categorieSelectionnee = categorie;
        this.getData(categorie);
      },
      async getData(d) {
        this.loading = true;
        this.data = [];
        try {
          const response = await axios.get(`api/${d}`);
          console.log(response.data);
          this.data = response.data;
        } catch (error) {
          console.error(error);
        }

        this.loading = false;
      }
    }
  }
  </script>
  
  <style>
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
  