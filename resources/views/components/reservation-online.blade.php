<p class="test">coucou</p>

<div id="app">
    <Counter />
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Jours
    axios.get('api/jours') // URL de votre API des jours
    .then(function(response) {
        // Les données de l'API des jours sont disponibles dans la propriété "data" de la réponse
        console.log(response.data);
    })
    .catch(function(error) {
        console.error('Erreur lors de la récupération des données de l\'API des jours', error);
    });

    // Fermeture
    axios.get('api/fermeture')
    .then(function(response) {
        console.log(response.data);

    })
    .catch(function(error) {
        console.error('Erreur lors de la récupération des données de l\'API des jours', error);
    });
});





</script>