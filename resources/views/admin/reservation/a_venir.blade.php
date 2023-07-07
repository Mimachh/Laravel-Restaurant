

@extends('layout.admin')

@section('content')
<h1>Réservations pour la date {{ $date }} {{ $service }}</h1>

@if ($reservations->isEmpty())
    <p>Aucune réservation pour cette date.</p>
@else
    <ul>
        @foreach ($reservations as $reservation)
            <li>{{ $reservation->nom }} {{ $reservation->prenom }}</li>
            {{ $reservation->status}}
        @endforeach
    </ul>
@endif

@endsection

@section('scripts')

@endsection