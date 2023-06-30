@extends('layout.admin')

@section('content')
    <h1>Liste des boissons non-alcoolisées</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.softs.create') }}" class="btn-create">Créer une nouvelle boisson non-alcoolisée</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.softs.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedSofts->count() }})</a>
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
            @foreach($softs as $soft)
                <tr>
                    <td>{{ $soft->id }}</td>
                    <td>{{ $soft->nom }}</td>
                    <td>{{ $soft->allAllergenesNames }}</td>
                    <td>{{ $soft->prix }}</td>
                    <td>{{ $soft->isOnline() }}</td>
                    <td>
                        <a href="{{ route('admin.softs.edit', $soft->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_softs[]" value="{{ $soft->id }}" class="soft-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.softs.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedSofts" id="selectedSoftsInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const softCheckboxes = document.querySelectorAll('.soft-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedSoftInput = document.getElementById('selectedSoftInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                softCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedSofts = Array.from(document.querySelectorAll('.soft-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedSofts.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedSoftsInput.value = JSON.stringify(selectedSofts);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection