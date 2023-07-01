@extends('layout.admin')

@section('content')
    <h1>Liste des heures d'ouverture</h1>

    
    <div class="table-toolbar">
        
        <a href="{{ route('admin.creneaux.edit') }}" class="btn-create">Modifier</a>
    </div>


    @if($fermeture->status == 1)
    <section id="form-section">
        <p>Le restaurant est actuellement fermé</p>
        <p>La raison que vous avez fourni : {{ $fermeture->raison }}</p>
    </section>
    @elseif($fermeture->status != 1)
    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Jour</th>
                <th>Midi</th>
                <th>Soir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jours as $jour)
                <tr>
                    <td>{{ $jour->id }}</td>
                    <td>{{ $jour->nom }}</td>
                    <td>{{ $jour->horaire_midi() }}</td>
                    <td>{{ $jour->horaire_soir() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection

@section('scripts')

@endsection