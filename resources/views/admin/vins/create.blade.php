@extends('layout.admin')

@section('content')
<section class="admin-form-container">
        <h1>Créer un nouveau vin</h1>

        <form action="{{ route('admin.vins.store') }}" method="POST" enctype="multipart/form-data">
            
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
                <label for="prix">Prix (au litre) :</label>
                <input type="number" step="0.01" name="prix" id="prix" required value="{{ old('prix') }}">
                @error('prix')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="annee">Année :</label>
                <input type="text" name="annee" id="annee" required value="{{ old('annee') }}">
                @error('annee')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <x-switch-button
                label="Mettre le menu en ligne ?"
                :checked="old('status')"
            />

            <button type="submit">Créer</button>
        </form>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/previewPhoto.js') }}" defer></script>
@endsection
