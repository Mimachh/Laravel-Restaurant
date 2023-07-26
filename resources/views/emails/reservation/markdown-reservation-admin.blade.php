@component('mail::message')
@if($data['status'] == 1)
# Nouvelle réservation
@else 
# Réservation en attente
@endif

Bonjour,

@if($data['status'] == 1)

Vous avez une nouvelle réservation pour le {{ $data['date'] }} à {{ $data['creneau'] }}
pour un total de {{ $data['convives'] }} personne(s).

@else 
Vous avez reçu une demande de réservation, en attente de validation pour le {{ $data['date'] }} à {{ $data['creneau'] }}
pour un total de {{ $data['convives'] }} personne(s).

@endif

@endcomponent