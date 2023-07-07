

@extends('layout.admin')

@section('content')
  <h1 class="reservations-title">Réservations à venir</h1>

  <ul class="reservations-list">
    @foreach ($paginatedGroupedReservations as $date => $groupedServices)
      @php
        $dateObj = DateTime::createFromFormat('d-m-Y', $date);
        $today = new DateTime();
      @endphp

      @if ($dateObj >= $today)
        <li class="reservations-item">
          <h2 class="reservations-date">{{ $date }}</h2>
          <ul class="services-list">
            @foreach ($groupedServices->reverse() as $service => $reservations)
              <li class="service-item service-item-{{$service}}">
                <a href="{{ route('admin.reservations.date.service', ['date' => $date, 'service' => $service]) }}" class="service-link">
                  {{ $service }}
                </a> :
                <ul class="reservation-info">
                  <li class="info-item">
                    <span class="info-text-total">{{ count($reservations) }} réservation(s) au total <a class="info-link" href="{{ route('admin.reservations.date.service', ['date' => $date, 'service' => $service]) }}">Voir</a></span>
                  </li>
                  <li class="info-item">
                    <span class="info-text">{{ $reservations->where('status', 1)->count() }} réservation(s) validée</span>
                    <a href="{{ route('admin.reservations.date.service.reservation.status', ['date' => $date, 'service' => $service, 'status' => '1']) }}" class="info-link">Voir</a>
                  </li>
                  <li class="info-item">
                    <span class="info-text">{{ $reservations->where('status', 2)->count() }} réservation(s) en attente de validation</span>
                    <a href="{{ route('admin.reservations.date.service.reservation.status', ['date' => $date, 'service' => $service, 'status' => '2']) }}" class="info-link">Voir</a>
                  </li>
                  <li class="info-item">
                    <span class="info-text">{{ $reservations->where('status', 3)->count() }} réservation(s) annulées</span>
                    <a href="{{ route('admin.reservations.date.service.reservation.status', ['date' => $date, 'service' => $service, 'status' => '3']) }}" class="info-link">Voir</a>
                  </li>
                </ul>
              </li>
            @endforeach
          </ul>
        </li>
      @endif
    @endforeach
  </ul>

  {{ $paginatedGroupedReservations->links() }}
@endsection

@section('scripts')

@endsection