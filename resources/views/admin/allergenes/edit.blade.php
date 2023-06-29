@extends('layout.admin')

@section('content')
<section class="admin-form-container">
    <h1>Modifier un allergène</h1>

    <form action="{{ route('admin.allergenes.update', $allergene->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required value="{{ old('nom', $allergene->nom) }}">
            @error('nom')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Modifier</button>
    </form>
</section>
@endsection