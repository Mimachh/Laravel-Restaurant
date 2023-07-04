<p class="test">coucou</p>

<p>Ce paragraphe ne doit etre affiché que si fermeture->status == 1</p>
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

        if (response.data.status == 1) {
            // Afficher le paragraphe lorsque le statut est égal à 1
            document.querySelector('.test').style.display = 'block';
        } else {
            // Masquer le paragraphe lorsque le statut est différent de 1
            document.querySelector('.test').style.display = 'none';
        }
    })
    .catch(function(error) {
        console.error('Erreur lors de la récupération des données de l\'API des jours', error);
    });
});





</script>