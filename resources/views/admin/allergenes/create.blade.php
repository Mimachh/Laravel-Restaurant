@extends('layout.admin')

@section('content')
<section class="admin-form-container">
        <h1>Créer un nouvel allergene</h1>

        <form action="{{ route('admin.allergenes.store') }}" method="POST">
            @csrf

            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required value="{{ old('nom') }}">
                @error('nom')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Créer</button>
        </form>
    </section>
@endsection
=
