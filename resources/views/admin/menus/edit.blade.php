@extends('layout.admin')

@section('content')
<section class="admin-form-container">
    <h1>Modifier un menu</h1>

    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required value="{{ old('nom', $menu->nom) }}">
            @error('nom')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $menu->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="info_supp">Informations supplémentaires :</label>
            <input type="text" name="info_supp" id="info_supp" required value="{{ old('info_supp', $menu->info_supp) }}">
            @error('info_supp')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Modifier</button>
    </form>
</section>


@endsection
