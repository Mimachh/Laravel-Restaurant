

@extends('layout.admin')

@section('content')
<h1>Modifier la réservation de {{ $reservation->userName() }}</h1>
<div class="my-4">
    @php
        $totalConvives = $reservations->where('status', 1)->sum('convives');
    @endphp
    <p class="pill-places-restantes">Total des places réservées : {{ $totalConvives }}</p>
    <p class="pill-couverts-restants">Nombre de couverts restants {{ getCouvertsRestants($reservations, $reservation->service, $reservation->date) }}</p>
</div>

<form action="{{ route('admin.reservations.update', $reservation->id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="previous_url" value="{{ URL::previous() }}">
<div class="reservation-card">
    <div class="reservation-card-header">
        Réservation # {{ $reservation->id }}
    </div>
    <div class="reservation-card-body">
        <div class="reservation-card-row">
            <span class="reservation-card-label">Nom/Prénom:</span>
            <span class="reservation-card-value">{{ $reservation->userName() }}</span>
        </div>
        <div class="reservation-card-row">
            <span class="reservation-card-label">Date</span>
            <span class="reservation-card-value">{{ $reservation->date }}</span>
        </div>
        <div class="reservation-card-row">
            <span class="reservation-card-label">Heure</span>
            <span class="reservation-card-value">{{ $reservation->creneau }}</span>
        </div>
        <div class="reservation-card-row">
            <span class="reservation-card-label">Email:</span>
            <span class="reservation-card-value">{{ $reservation->email }}</span>
        </div>
        <div class="reservation-card-row">
            <span class="reservation-card-label">Convives:</span>
            <span class="reservation-card-value">{{ $reservation->convives }}</span>
        </div>
        <div class="reservation-card-row">
            <span class="reservation-card-label">Téléphone:</span>
            <span class="reservation-card-value">{{ $reservation->telephone }}</span>
        </div>
        <div class="reservation-card-row">
            <span class="reservation-card-label">Informations:</span>
            <span class="reservation-card-value">{{ $reservation->informations }}</span>
        </div>
        <div class="reservation-card-row">
            <span class="reservation-card-label">Statut:</span>
            <select name="status" id="status">
                <option value="1" @if($reservation->status == 1) selected @endif>Valider</option>
                <option value="2" @if($reservation->status == 2) selected @endif>En attente</option>
                <option value="3" @if($reservation->status == 3) selected @endif>Refuser</option>
            </select>
        </div>
    </div>
    <div class="reservation-card-footer">
        <button type="submit" href="" class="btn-create">Enregistrer</button>
    </div>
</div>
</form>



@endsection

@section('scripts')

@endsection