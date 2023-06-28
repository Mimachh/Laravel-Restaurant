@extends('layout.admin')

@section('content')
    <h1>Corbeille</h1>



    <div class="table-toolbar">
        <button class="btn-restore">Restaurer la sélection</button>
        <button class="btn-delete">Supprimer la sélection</button>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Rôles</th>
                <th class="checkbox-column"><input type="checkbox" id="select-all"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($trashedUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->allRoleNames }}</td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_users[]" value="{{ $user->id }}" class="select-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="restoreSelectedForm" action="{{ route('admin.users.restore-multiple') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="selectedUsers" id="selectedRestoreCheckboxesInput">
    </form>

    <form id="deleteSelectedForm" action="{{ route('admin.users.force-destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedUsers" id="selectedDeleteCheckboxesInput">
    </form>


@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const restoreSelectedForm = document.getElementById('restoreSelectedForm');
        const deleteSelectedForm = document.getElementById('deleteSelectedForm');
        const selectedRestoreCheckboxesInput = document.getElementById('selectedRestoreCheckboxesInput');
        const selectedDeleteCheckboxesInput = document.getElementById('selectedDeleteCheckboxesInput');

        // Écouteur d'événement pour le bouton de restauration
        document.querySelector('.btn-restore').addEventListener('click', function(event) {
            event.preventDefault();

            const selectedCheckboxes = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(checkbox => checkbox.value);

            // Vérification si des utilisateurs sont sélectionnés
            if (selectedCheckboxes.length > 0) {
                // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                selectedRestoreCheckboxesInput.value = JSON.stringify(selectedCheckboxes);

                // Soumettre le formulaire de restauration
                restoreSelectedForm.submit();
            }
        });

        // SUPPRESSION
        const selectAllCheckbox = document.getElementById('select-all');
        const userCheckboxes = document.querySelectorAll('.select-checkbox');

        // Écouteur d'événement pour la case à cocher "Tout sélectionner"
        selectAllCheckbox.addEventListener('change', function () {
            const isChecked = selectAllCheckbox.checked;

            userCheckboxes.forEach(function (checkbox) {
                checkbox.checked = isChecked;
            });
        });

        // Écouteur d'événement pour le bouton de suppression
        document.querySelector('.btn-delete').addEventListener('click', function(event) {
            event.preventDefault();

            const selectedCheckboxes = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(checkbox => checkbox.value);

            // Vérification si des utilisateurs sont sélectionnés
            if (selectedCheckboxes.length > 0) {
                // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                selectedDeleteCheckboxesInput.value = JSON.stringify(selectedCheckboxes);

                // Soumettre le formulaire de suppression
                deleteSelectedForm.submit();
            }
        });
    });
</script>
@endsection