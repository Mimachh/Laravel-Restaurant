@extends('layout.admin')

@section('content')
    <h1>Liste des boissons alcoolisées</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.alcools.create') }}" class="btn-create">Créer une nouvelle boisson alcoolisée</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.alcools.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedAlcools->count() }})</a>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Allergènes</th>
                <th>Prix</th>
                <th>Action</th>
                <th class="checkbox-column"><input type="checkbox" id="select-all"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($alcools as $alcool)
                <tr>
                    <td>{{ $alcool->id }}</td>
                    <td>{{ $alcool->nom }}</td>
                    <td>{{ $alcool->allAllergenesNames }}</td>
                    <td>{{ $alcool->prix }}</td>
                    <td>
                        <a href="{{ route('admin.alcools.edit', $alcool->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_alcools[]" value="{{ $alcool->id }}" class="alcool-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.alcools.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedAlcools" id="selectedAlcoolsInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const alcoolCheckboxes = document.querySelectorAll('.alcool-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedAlcoolInput = document.getElementById('selectedAlcoolInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                alcoolCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedAlcools = Array.from(document.querySelectorAll('.alcool-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedAlcools.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedAlcoolsInput.value = JSON.stringify(selectedAlcools);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection