@extends('layout.admin')

@section('content')
<section class="admin-form-container">
        <h1>Créer un nouveau menu</h1>

        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
            
            @csrf
           
            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required value="{{ old('nom') }}">
                @error('nom')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>


            <div>
                <label for="description">Description :</label>
                <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
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

