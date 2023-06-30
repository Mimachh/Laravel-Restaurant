@extends('layout.admin')

@section('content')
<section class="admin-form-container">
        <h1>Créer une nouvelle formule</h1>

        <form action="{{ route('admin.formules.store') }}" method="POST" enctype="multipart/form-data">
            
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

            <div>
                <label for="prix">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" required value="{{ old('prix') }}">
                @error('prix')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- MENUS -->
            <div>
                <span class="label toggleLabel"
                id="menusToggle" 
                onclick="toggleCheckboxList(
                'menusCheckboxList', 
                'toggleSpan',
                'toggleSpanPlusMenu',
                'toggleSpanMinusMenu'
                )"
                >   <span>Menus de la formule</span>
                    <span class="toggleSpan"> 
                        <span class="toggleSpanPlus" id="toggleSpanPlusMenu">+</span>
                        <span class="toggleSpanMinus hidden" id="toggleSpanMinusMenu">-</span> 
                    </span>
                </span><br>
                <div id="menusCheckboxList" style="display: none;">
                    @foreach($menus as $menu)
                        <label>
                            <input type="checkbox" name="menus[]" value="{{ $menu->id }}" {{ in_array($menu->id, old('menus', [])) ? 'checked' : '' }}>
                            {{ $menu->nom }}
                        </label><br>
                    @endforeach
                </div>
                <hr>
                @error('menus')
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
    <script src="{{ asset('js/admin/toggleList.js') }}" defer></script>
@endsection
