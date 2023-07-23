<!-- Navigation.vue -->
<template>
    <div>
      <!-- Utilisation du composant de catégorie dans le composant de navigation -->
      <button @click="selectionnerCategorie('entrees')">Entrée</button>
      <button @click="selectionnerCategorie('plats')">Plat</button>
      <button @click="selectionnerCategorie('desserts')">Desserts</button>
      <!-- ... Ajoutez des boutons pour d'autres catégories ici ... -->

      
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        categorieSelectionnee: 'entrees' // Catégorie par défaut affichée lors du chargement de la page
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
  /* Styles pour le composant de navigation */
  </style>