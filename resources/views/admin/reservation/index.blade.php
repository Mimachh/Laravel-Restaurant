

@extends('layout.admin')

@section('content')
  <h1 class="reservations-title">Réservations à venir</h1>

  <ul class="reservations-list">
    @foreach ($paginatedGroupedReservations as $date => $groupedServices)
      @php
          $dateObj = DateTime::createFromFormat('d-m-Y', $date);
          $timestamp = $dateObj->getTimestamp();

          $today = new DateTime();
          $todayTimestamp = $today->getTimestamp();
      @endphp


      @if ($timestamp >= $todayTimestamp)

        <li class="reservations-item">
          <h2 class="reservations-date">{{ $date }}</h2>
          <ul class="services-list">
            @foreach ($groupedServices->sortKeys() as $service => $reservations)
              <li class="service-item service-item-{{$service}}">
                <a href="{{ route('admin.reservations.date.service', ['date' => $date, 'service' => $service]) }}" class="service-link">
                  {{ $service }}

                </a> :
                <ul class="reservation-info">
                  <li class="info-item info-item-total">
                    <span class="info-text-total">{{ count($reservations) }} réservation(s) au total 
                      @if(count($reservations) > 0 )
                      <a class="info-link" href="{{ route('admin.reservations.date.service', ['date' => $date, 'service' => $service]) }}">Voir</a>
                      @endif
                    </span>
                  </li>
                  <li class="info-item">
                    <span class="info-text">{{ $reservations->where('status', 1)->count() }} réservation(s) validée</span>
                    @if($reservations->where('status', 1)->count() > 0)
                    <a href="{{ route('admin.reservations.date.service.reservation.status', ['date' => $date, 'service' => $service, 'status' => '1']) }}" class="info-link">Voir</a>
                    @endif
                  </li>
                  <li class="info-item">
                    <span class="info-text">{{ $reservations->where('status', 2)->count() }} réservation(s) en attente de validation</span>
                    @if($reservations->where('status', 2)->count() > 0)
                    <a href="{{ route('admin.reservations.date.service.reservation.status', ['date' => $date, 'service' => $service, 'status' => '2']) }}" class="info-link">Voir</a>
                    @endif
                  </li>
                  <li class="info-item">
                    <span class="info-text">{{ $reservations->where('status', 3)->count() }} réservation(s) annulées</span>
                    @if($reservations->where('status', 3)->count() > 0)
                    <a href="{{ route('admin.reservations.date.service.reservation.status', ['date' => $date, 'service' => $service, 'status' => '3']) }}" class="info-link">Voir</a>
                    @endif
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