@extends('layout.admin')

@section('content')
    <h1>Liste des entrées</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.entrees.create') }}" class="btn-create">Créer une nouvelle entrée</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.entrees.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedEntrees->count() }})</a>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Allergènes</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Action</th>
                <th class="checkbox-column"><input type="checkbox" id="select-all"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($entrees as $entree)
                <tr>
                    <td>{{ $entree->id }}</td>
                    <td>{{ $entree->nom }}</td>
                    <td>{{ $entree->allAllergenesNames }}</td>
                    <td>{{ $entree->prix }}</td>
                    <td>{{ $entree->isOnline() }}</td>
                    <td>
                        <a href="{{ route('admin.entrees.edit', $entree->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_entrees[]" value="{{ $entree->id }}" class="entree-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.entrees.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedEntrees" id="selectedEntreesInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const entreeCheckboxes = document.querySelectorAll('.entree-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedEntreeInput = document.getElementById('selectedEntreeInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                entreeCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedEntrees = Array.from(document.querySelectorAll('.entree-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedEntrees.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedEntreesInput.value = JSON.stringify(selectedEntrees);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection