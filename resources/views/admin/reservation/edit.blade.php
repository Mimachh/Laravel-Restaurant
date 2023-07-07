

@extends('layout.admin')

@section('content')
<h1>Réservation lolilol de {{ $reservation->userName() }}</h1>

<form action="{{ route('admin.reservations.update', [$reservation->id, $date, $service]) }}" method="post">
    @csrf
    @method('PUT')
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