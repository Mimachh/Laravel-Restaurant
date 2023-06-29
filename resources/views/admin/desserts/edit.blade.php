@extends('layout.admin')

@section('content')
<section class="admin-form-container">
    <h1>Modifier un dessert</h1>

    <form action="{{ route('admin.desserts.update', $dessert->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nom" class="label">Nom :</label>
            <input type="text" name="nom" id="nom" required value="{{ old('nom', $dessert->nom) }}">
            @error('nom')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="photo" class="label">Photo :</label>
            <div>
                @if($dessert->photo_portrait)
                    <img src="{{ asset('storage/desserts/portraits/' . $dessert->photo_portrait) }}" alt="Preview" id="preview" style="display: block; width: 300px; height: auto; margin-bottom: 10px;">
                @else
                    <img src="{{ asset('storage/desserts/thumbnails/placeholder.png') }}" alt="Preview" id="preview" style="display: none; width: 300px; height: auto; margin-bottom: 10px;">
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
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $dessert->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="label">Allergènes</label> <br>
            <div>
                @foreach($allergenes as $allergene)
                    <div class="form-check checkbox-row">
                        <input class="form-check-input" type="checkbox" name="allergenes[]" id="allergene{{ $allergene->id }}" value="{{ $allergene->id }}" {{ in_array($allergene->id, $dessertAllergenes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="allergene{{ $allergene->id }}">{{ $allergene->nom }}</label>
                    </div>
                @endforeach
            </div>
            @error('allergenes')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="prix" class="label">Prix :</label>
            <input type="number" step="0.01" name="prix" id="prix" required value="{{ old('prix', $dessert->prix) }}">
            @error('prix')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="info_supp" class="label">Informations supplémentaires :</label>
            <input type="text" name="info_supp" id="info_supp" required value="{{ old('info_supp', $dessert->info_supp) }}">
            @error('info_supp')
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