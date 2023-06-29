@extends('layout.admin')

@section('content')
<section class="admin-form-container">
    <h1>Modifier un vin</h1>

    <form action="{{ route('admin.vins.update', $vin->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" name="nom" id="nom" required value="{{ old('nom', $vin->nom) }}">
            @error('nom')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="photo" class="label">Photo :</label>
            <div>
                @if($vin->photo_portrait)
                    <img src="{{ asset('storage/vins/portraits/' . $vin->photo_portrait) }}" alt="Preview" id="preview" style="display: block; width: 300px; height: auto; margin-bottom: 10px;">
                @else
                    <img src="{{ asset('storage/vins/thumbnails/placeholder.png') }}" alt="Preview" id="preview" style="display: none; width: 300px; height: auto; margin-bottom: 10px;">
                @endif
                <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)">
            </div>
            @error('photo')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="checkbox-row">
            <label for="supprimer_photo" class="label">Supprimer l'image : (à ne cocher que si ne souhaitez plus afficher de photo)</label>
            <input type="checkbox" name="supprimer_photo" id="supprimer_photo">
        </div>

        <div>
            <label for="description" class="label">Description :</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $vin->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>


        <div>
            <label for="prix" class="label">Prix (au litre) :</label>
            <input type="number" step="0.01" name="prix" id="prix" required value="{{ old('prix', $vin->prix) }}">
            @error('prix')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="annee" class="label">Année :</label>
            <input type="text" name="annee" id="annee" required value="{{ old('annee', $vin->annee) }}">
            @error('annee')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Modifier</button>
    </form>
</section>


@endsection
@section('scripts')
    <script src="{{ asset('js/admin/previewPhoto.js') }}" defer></script>
@endsection