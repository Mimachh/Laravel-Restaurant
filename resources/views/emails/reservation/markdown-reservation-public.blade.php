@component('mail::message')
# Votre réservation

Bonjour {{ $data['prenom'] }} {{ $data['nom'] }},

@if($data['status'] == 1)
Nous avons le plaisir de vous confirmer votre réservation du {{ $data['date'] }} à {{ $data['creneau'] }}
pour un total de {{ $data['convives'] }} personne(s).

En cas de problème n'hésitez pas à nous contacter via le formulaire de contact de notre site en cliquant sur le bouton ci-dessous :

@component('mail::button', ['url' => ''])
Contactez-nous
@endcomponent

Ou en nous contactant au {{ $telephoneResto }}.
@else 
Nous avons reçu votre demande de réservation pour le {{ $data['date'] }} à {{ $data['creneau'] }}
pour un total de {{ $data['convives'] }} personne(s).

Nous revenons vers vous au plus vite pour vous tenir informer.
@endif

Toute l'équipe de {{ config('app.name') }} vous remercie, <br>
A bientôt,
@endcomponent
