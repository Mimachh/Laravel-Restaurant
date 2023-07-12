

@extends('layout.admin')

@section('content')
<h1>Réservations du {{ $date }} {{ $service }}</h1>
@if ($reservations->isEmpty())
    <p>Aucune réservation pour cette date.</p>
@else

    <div class="my-4">
        @php
            $totalConvives = $reservations->where('status', 1)->sum('convives');
        @endphp
        <p class="pill-places-restantes">Total des places réservées : {{ $totalConvives }}</p>
        <p class="pill-couverts-restants">Nombre de couverts restants {{ getCouvertsRestants($reservations, $service, $date) }}</p>
    </div>

    <table class="user-table my-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom/Prénom</th>
                <th>Email</th>
                <th>Convives</th>
                <th>Téléphone</th>
                <th>Informations</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->userName() }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->convives }}</td>
                    <td>{{ $reservation->telephone }}</td>
                    <td>{{ $reservation->informations }}</td>
                    <td>{{ $reservation->getStatus() }}</td>
                    <td>
                        <a href="{{ route('admin.attente.show', $reservation->id,) }}" class="btn-create">Voir</a>
                        <a href="{{ route('admin.reservations.a_venir.edit', [$reservation->id, $date, $service]) }}" class="btn-edit">Changer le statut</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif




@endsection

@section('scripts')

@endsection