@extends('layout.admin')

@section('content')
    <h1>Options de réservation</h1>
    
    <div class="table-toolbar my-4">
        <a href="{{ route('admin.options_reservation.edit') }}" class="btn-create">Modifier</a>
    </div>
    
    <p>Souhaitez vous ouvrir les réservations en ligne ?</p>
<p>En cas de fermeture du restaurant, souhaitez-vous laisser les réservations ouvertes pour les dates de réouverture ou préfèrez stopper toute réservation ?</p>

<p>Souhaitez-vous automatiser les validations de réservations en ligne ? (l'autre option est la validation manuelle)</p>
<p>Si oui, ajouter une limite à partir de laquelle vous reprenez la main?</p>
<p>Si oui, laquelle  ?</p>
<p>Liste des jours de la semaine : ajout du nombre de couverts</p>

@endsection

@section('scripts')

@endsection