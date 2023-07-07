

@extends('layout.admin')

@section('content')
<h1>Réservations du {{ $date }} {{ $service }}</h1>
@if ($reservations->isEmpty())
    <p>Aucune réservation pour cette date.</p>
@else

@if($status == 1)
    <div class="table-toolbar my-4">
        @php
            $totalConvives = $reservations->sum('convives');
        @endphp
            Total des places réservées : {{ $totalConvives }}

    </div>
@endif
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
                        <a href="{{ route('admin.reservations.a_venir.show', $reservation->id,) }}" class="btn-create">Voir</a>
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