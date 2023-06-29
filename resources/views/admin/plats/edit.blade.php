@extends('layout.admin')

@section('content')
<section class="admin-form-container">
    <h1>Modifier un plat</h1>

    <form action="{{ route('admin.plats.update', $plat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required value="{{ old('nom', $plat->nom) }}">
            @error('nom')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="photo">Photo :</label>
            <div>
                @if($plat->photo_portrait)
                    <img src="{{ asset('storage/plats/portraits/' . $plat->photo_portrait) }}" alt="Preview" id="preview" style="display: block; width: 300px; height: auto; margin-bottom: 10px;">
                @else
                    <img src="{{ asset('storage/plats/thumbnails/placeholder.png') }}" alt="Preview" id="preview" style="display: none; width: 300px; height: auto; margin-bottom: 10px;">
                @endif
                <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)">
            </div>
            @error('photo')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="supprimer_photo">Supprimer l'image :</label>
            <input type="checkbox" name="supprimer_photo" id="supprimer_photo">
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $plat->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label>Allergènes</label> <br>
            <div>
                @foreach($allergenes as $allergene)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="allergenes[]" id="allergene{{ $allergene->id }}" value="{{ $allergene->id }}" {{ in_array($allergene->id, $platAllergenes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="allergene{{ $allergene->id }}">{{ $allergene->nom }}</label>
                    </div>
                @endforeach
            </div>
            @error('allergenes')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="prix">Prix :</label>
            <input type="number" step="0.01" name="prix" id="prix" required value="{{ old('prix', $plat->prix) }}">
            @error('prix')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="info_supp">Informations supplémentaires :</label>
            <input type="text" name="info_supp" id="info_supp" required value="{{ old('info_supp', $plat->info_supp) }}">
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