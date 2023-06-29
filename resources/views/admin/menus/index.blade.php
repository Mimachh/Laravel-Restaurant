@extends('layout.admin')

@section('content')
    <h1>Liste des menus</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.menus.create') }}" class="btn-create">Créer un nouveau menu</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.menus.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedMenus->count() }})</a>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Formules</th>
                <th>Action</th>
                <th class="checkbox-column"><input type="checkbox" id="select-all"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td>{{ $menu->nom }}</td>
                    <td>a mettre</td>
                    <td>
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_menus[]" value="{{ $menu->id }}" class="menu-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.menus.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedMenus" id="selectedMenusInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const menuCheckboxes = document.querySelectorAll('.menu-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedMenusInput = document.getElementById('selectedMenusInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                menuCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedMenus = Array.from(document.querySelectorAll('.menu-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedMenus.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedMenusInput.value = JSON.stringify(selectedMenus);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection