@extends('layout.admin')

@section('content')
    <h1>Liste des vins</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.vins.create') }}" class="btn-create">Créer un nouveau vin</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.vins.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedVins->count() }})</a>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Année</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Action</th>
                <th class="checkbox-column"><input type="checkbox" id="select-all"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($vins as $vin)
                <tr>
                    <td>{{ $vin->id }}</td>
                    <td>{{ $vin->nom }}</td>
                    <td>{{ $vin->annee }}</td>
                    <td>{{ $vin->prix }}</td>
                    <td>{{ $vin->isOnline() }} </td>
                    <td>
                        <a href="{{ route('admin.vins.edit', $vin->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_vins[]" value="{{ $vin->id }}" class="vin-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.vins.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedVins" id="selectedVinsInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const vinCheckboxes = document.querySelectorAll('.vin-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedVinsInput = document.getElementById('selectedVinsInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                vinCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedVins = Array.from(document.querySelectorAll('.vin-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedVins.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedVinsInput.value = JSON.stringify(selectedVins);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection