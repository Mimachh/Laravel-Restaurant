

@extends('layout.admin')

@section('content')
<h1>Réservations en attente</h1>
@if ($paginatedGroupedReservations->isEmpty())
    <p>Aucune réservation.</p>
@else

<ul class="reservations-list">
  @foreach ($paginatedGroupedReservations as $date => $groupedServices)
      <li class="reservations-item">
        <h2 class="reservations-date">{{ $date }}</h2>
        <ul class="services-list">
          @foreach ($groupedServices->sortKeys() as $service => $reservations)
            <li class="service-item service-item-{{$service}}">
              <a href="{{ route('admin.attente.byDate', ['date' => $date, 'service' => $service]) }}" class="service-link">
                {{ $service }}

              </a> :
              <div class="my-4">
                @php
                  $totalConvives = $reservations->where('status', 1)->sum('convives');
                @endphp
                  <p class="pill-places-restantes">Total des places réservées : {{ $totalConvives }}</p>
                  <p class="pill-couverts-restants">Nombre de couverts restants {{ getCouvertsRestants($reservations, $service, $date) }}</p>
              </div>
              <ul class="reservation-info">
                <li class="info-item info-item-total">
                  <span class="info-text-total">{{ count($reservations) }} réservation(s) en attente 
                    @if(count($reservations) > 0 )
                    <a class="info-link" href="{{ route('admin.attente.byDate', ['date' => $date, 'service' => $service]) }}">Voir</a>
                    @endif
                  </span>
                </li>
              </ul>
            </li>
          @endforeach
        </ul>
      </li>
  @endforeach
</ul>

{{ $paginatedGroupedReservations->links() }}
 
@endif



@endsection


@section('scripts')

@endsection
