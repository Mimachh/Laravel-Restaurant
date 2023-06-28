@extends('layout.admin')

@section('content')
<section class="admin-form-container">
    <h1>Modifier un plat</h1>

    <form action="{{ route('admin.plats.update', $plat->id) }}" method="POST">
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
            <label for="description">Description :</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $plat->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
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