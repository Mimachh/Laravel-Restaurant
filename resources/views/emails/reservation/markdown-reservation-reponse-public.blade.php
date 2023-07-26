<x-mail::message>
@if($scenario === "Accepté")
# Confirmation de votre réservation
@else
# Information concernant votre réservation
@endif


Bonjour,
@if($scenario === "Accepté")
Nous avons le plaisir de vous informer que votre réservation du {{ $reservation->date }} à {{ $reservation->creneau}} a été accepté.

Nous avons hâte de vous retrouver.

En cas d'indisponibilité n'hésitez pas à nous contacter au <a href="tel:{{ $telephoneResto }}">{{ $telephoneResto }}</a>.

@elseif($scenario === "En attente")

Votre réservation à dû être mise en attente suite à des soucis de notre côté.
Nous nous excusons pour le désagrément et faisons au plus vite pour vous envoyer une nouvelle confirmation.

Pour toute question n'hésitez pas à nous contacter au <a href="tel:{{ $telephoneResto }}">{{ $telephoneResto }}</a>.

@elseif($scenario === "Annulé")

Nous ne pouvons malheureusement accepté votre réservation.

N'hésitez pas à nous contacter au <a href="tel:{{ $telephoneResto }}">{{ $telephoneResto }}</a> pour toute question relative à cette annulation.

@endif
A bientôt !<br>
Toute l'équipe de {{ config('app.name') }}
</x-mail::message>
