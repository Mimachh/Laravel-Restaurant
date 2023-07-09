

@extends('layout.admin')

@section('content')
  <h1 class="reservations-title">Réservations passées</h1>

  <ul class="reservations-list">
    @foreach ($paginatedGroupedReservations as $date => $groupedServices)
    @php
        $dateObj = DateTime::createFromFormat('d-m-Y', $date);
        $timestamp = $dateObj->getTimestamp();

        $today = new DateTime();
        $todayTimestamp = $today->getTimestamp();
    @endphp

      @if ($timestamp < $todayTimestamp)

        <li class="reservations-item">
          <h2 class="reservations-date">{{ $date }}</h2>
          <ul class="services-list">
            @foreach ($groupedServices->sortKeys() as $service => $reservations)
              <li class="service-item service-item-{{$service}}">
                <a href="{{ route('admin.historique.showByDate', ['date' => $date, 'service' => $service]) }}" class="service-link">
                  {{ $service }}

                </a> :
                <ul class="reservation-info">
                  <li class="info-item info-item-total">
                    <span class="info-text-total">{{ count($reservations) }} réservation(s) 
                      @if(count($reservations) > 0 )
                      <a class="info-link" href="{{ route('admin.historique.showByDate', ['date' => $date, 'service' => $service]) }}">Voir</a>
                      @endif
                    </span>
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