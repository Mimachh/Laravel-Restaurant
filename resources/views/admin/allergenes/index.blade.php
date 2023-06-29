@extends('layout.admin')

@section('content')
    <h1>Liste des allergènes</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.allergenes.create') }}" class="btn-create">Créer un nouvel allergène</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.allergenes.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedAllergenes->count() }})</a>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Action</th>
                <th class="checkbox-column"><input type="checkbox" id="select-all"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($allergenes as $allergene)
                <tr>
                    <td>{{ $allergene->id }}</td>
                    <td>{{ $allergene->nom }}</td>
                    <td>{{ $allergene->prix }}</td>
                    <td>
                        <a href="{{ route('admin.allergenes.edit', $allergene->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_allergenes[]" value="{{ $allergene->id }}" class="allergene-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.allergenes.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedAllergenes" id="selectedAllergenesInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const allergeneCheckboxes = document.querySelectorAll('.allergene-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedAllergenesInput = document.getElementById('selectedAllergenesInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                allergeneCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedAllergenes = Array.from(document.querySelectorAll('.allergene-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedAllergenes.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedAllergenesInput.value = JSON.stringify(selectedAllergenes);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection