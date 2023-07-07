

@extends('layout.admin')

@section('content')
<h1>Réservation de {{ $reservation->userName() }}</h1>

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
            <span class="reservation-card-value">{{ $reservation->getStatus() }}</span>
        </div>
    </div>
    <div class="reservation-card-footer">
        <a href="{{ route('admin.reservations.a_venir.edit', $reservation->id) }}" class="btn-edit">Changer le statut</a>
    </div>
</div>




@endsection

@section('scripts')

@endsection