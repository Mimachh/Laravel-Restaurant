@extends('layout.admin')

@section('content')
    <h1>Liste des desserts</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.desserts.create') }}" class="btn-create">Créer un nouveau dessert</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.desserts.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedDesserts->count() }})</a>
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
            @foreach($desserts as $dessert)
                <tr>
                    <td>{{ $dessert->id }}</td>
                    <td>{{ $dessert->nom }}</td>
                    <td>{{ $dessert->allAllergenesNames }}</td>
                    <td>{{ $dessert->prix }}</td>
                    <td>{{ $dessert->isOnline() }}</td>
                    <td>
                        <a href="{{ route('admin.desserts.edit', $dessert->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_desserts[]" value="{{ $dessert->id }}" class="dessert-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.desserts.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedDesserts" id="selectedDessertsInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const dessertCheckboxes = document.querySelectorAll('.dessert-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedDessertInput = document.getElementById('selectedDessertInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                dessertCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedDesserts = Array.from(document.querySelectorAll('.dessert-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedDesserts.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedDessertsInput.value = JSON.stringify(selectedDesserts);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection