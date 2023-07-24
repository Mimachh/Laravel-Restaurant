
<template>
    <div class="grid md:grid-cols-2 mt-5">
     <div class="flex gap-2 md:px-6 px-8 items-center py-2" 
     v-for="item in data" :key="item.id" 
    >    
        <img v-if="item.photo_thumbnail" :src="getImageUrl(cat, item.photo_thumbnail)" :alt="'Photo ' + item.nom" 
        class="w-24 h-24 rounded-full transition duration-300 ease-out
        hover:scale-[115%] cursor-pointer
        "
        />
        <div class="w-full px-0 md:px-4 ">
            <div class="flex justify-between  separator">
                <h3 class="text-lg font-bold font-quicksand text-primary">{{ item.nom }}</h3>
                <p class="text-primaryDark font-bold text-lg font-quicksand">{{ item.prix }} €</p>
            </div>
            <p class="pt-2">{{ item.description }}</p>
        </div>
     </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
        data: {
        type: Array, 
        required: true,
        },
        cat: {
        type: String, 
        required: true,
        },
    },
    methods: {
        getImageUrl(category, photo) {
            // Construction du chemin de l'image en utilisant window.APP_URL et les paramètres cat et photo
            return `${window.APP_URL}/storage/${category}/thumbnails/${photo}`;
        },
    },
  }
  </script>
  
  <style>
.separator {
  border-bottom: 1px dashed #383848; 
  padding-bottom: 10px;
}
  </style>