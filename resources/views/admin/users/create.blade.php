@extends('layout.admin')

@section('content')
<section class="admin-form-container">
        <h1>Créer un nouvel utilisateur</h1>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label>Rôles :</label><br>
                @foreach($roles as $role)
                    <label>
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                        {{ $role->name }}
                    </label><br>
                @endforeach
                @error('roles')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Créer</button>
        </form>
    </section>
@endsection