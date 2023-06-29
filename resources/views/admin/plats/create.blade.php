@extends('layout.admin')

@section('content')
<section class="admin-form-container">
        <h1>Créer un nouveau plat</h1>

        <form action="{{ route('admin.plats.store') }}" method="POST" enctype="multipart/form-data">
            
            @csrf
           
            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required value="{{ old('nom') }}">
                @error('nom')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="photo">Photo :</label>
                <input type="file" name="photo" id="photo" accept="image/*" onchange="previewImage(event)">
                @error('photo')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <img id="preview" src="" alt="Aperçu de l'image">
            </div>

            <div>
                <label for="description">Description :</label>
                <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label>Allergènes :</label><br>
                @foreach($allergenes as $allergene)
                    <label>
                        <input type="checkbox" name="allergenes[]" value="{{ $allergene->id }}" {{ in_array($allergene->id, old('allergenes', [])) ? 'checked' : '' }}>
                        {{ $allergene->nom }}
                    </label><br>
                @endforeach
                @error('allergenes')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="prix">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" required value="{{ old('prix') }}">
                @error('prix')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="info_supp">Informations supplémentaires :</label>
                <input type="text" name="info_supp" id="info_supp" required value="{{ old('info_supp') }}">
                @error('info_supp')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Créer</button>
        </form>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/previewPhoto.js') }}" defer></script>
@endsection
