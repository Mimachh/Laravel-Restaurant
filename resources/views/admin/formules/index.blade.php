@extends('layout.admin')

@section('content')
    <h1>Liste des formules</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.formules.create') }}" class="btn-create">Créer une nouvelle formule</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.formules.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedFormules->count() }})</a>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Menus</th>
                <th>Statut</th>
                <th>Action</th>
                <th class="checkbox-column"><input type="checkbox" id="select-all"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($formules as $formule)
                <tr>
                    <td>{{ $formule->id }}</td>
                    <td>{{ $formule->nom }}</td>
                    <td>{{ $formule->prix }}</td>
                    <td>{{ $formule->allMenusNames }}</td>
                    <td>{{ $formule->isOnline() }}</td>
                    <td>
                        <a href="{{ route('admin.formules.edit', $formule->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_formules[]" value="{{ $formule->id }}" class="formule-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.formules.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedFormules" id="selectedFormulesInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const formuleCheckboxes = document.querySelectorAll('.formule-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedFormulesInput = document.getElementById('selectedFormulesInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                formuleCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedFormules = Array.from(document.querySelectorAll('.formule-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedFormules.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedFormulesInput.value = JSON.stringify(selectedFormules);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection