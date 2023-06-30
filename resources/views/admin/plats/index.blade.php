@extends('layout.admin')

@section('content')
    <h1>Liste des plats</h1>



    <div class="table-toolbar">
        
        <a href="{{ route('admin.plats.create') }}" class="btn-create">Créer un nouveau plat</a>
        <button class="btn-delete">Supprimer la sélection</button>
        <a href="{{ route('admin.plats.trash') }}" class="btn-trash">Voir la corbeille ({{ $trashedPlats->count() }})</a>
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
            @foreach($plats as $plat)
                <tr>
                    <td>{{ $plat->id }}</td>
                    <td>{{ $plat->nom }}</td>
                    <td>{{ $plat->allAllergenesNames }}</td>
                    <td>{{ $plat->prix }}</td>
                    <td>
                        @if($plat->status)
                            En ligne
                        @else 
                            Hors-ligne
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.plats.edit', $plat->id) }}" class="btn-edit">Éditer</a>
                    </td>
                    <td class="checkbox-column">
                        <input type="checkbox" name="selected_plats[]" value="{{ $plat->id }}" class="plat-checkbox">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form id="deleteSelectedForm" action="{{ route('admin.plats.destroy-multiple') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selectedPlats" id="selectedPlatsInput">
    </form>


@endsection

@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const platCheckboxes = document.querySelectorAll('.plat-checkbox');
            const deleteSelectedForm = document.getElementById('deleteSelectedForm');
            const selectedPlatsInput = document.getElementById('selectedPlatsInput');

            // Écouteur d'événement pour la case à cocher "Tout sélectionner"
            selectAllCheckbox.addEventListener('change', function () {
                const isChecked = selectAllCheckbox.checked;

                platCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Écouteur d'événement pour le bouton de suppression
            document.querySelector('.btn-delete').addEventListener('click', function(event) {
                event.preventDefault();

                const selectedPlats = Array.from(document.querySelectorAll('.plat-checkbox:checked')).map(checkbox => checkbox.value);

                // Vérification si des utilisateurs sont sélectionnés
                if (selectedPlats.length > 0) {
                    // Mettre à jour la valeur de l'input caché avec les utilisateurs sélectionnés
                    selectedPlatsInput.value = JSON.stringify(selectedPlats);

                    // Soumettre le formulaire de suppression
                    deleteSelectedForm.submit();
                }
            });
        });
    </script>
@endsection