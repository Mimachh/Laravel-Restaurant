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


        <!-- ENTREES -->
        <div>
            <span class="label toggleLabel"
            id="entreesToggle" onclick="toggleCheckboxList(
                'entreesCheckboxList', 
                'toggleSpan',
                'toggleSpanPlusEntree',
                'toggleSpanMinusEntree'
                )"
            >   <span>Entrées du Menu</span>
                <span class="toggleSpan"> 
                    <span class="toggleSpanPlusEntree" id="toggleSpanPlusEntree">+</span>
                    <span class="toggleSpanMinusEntree hidden" id="toggleSpanMinusEntree">-</span> 
                </span>
            </span><br>
            <div id="entreesCheckboxList" style="display: none;">
                @foreach($entrees as $entree)
                    <label>
                        <input type="checkbox" name="entrees[]" id="entree{{ $entree->id }}" value="{{ $entree->id }}" {{ in_array($entree->id, $menuEntrees) ? 'checked' : '' }}>
                        {{ $entree->nom }}
                    </label><br>
                @endforeach
            </div>
            <hr>
            @error('entrees')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- PLATS -->
        <div>
            <span class="label toggleLabel"
            id="platsToggle" onclick="toggleCheckboxList(
                'platsCheckboxList', 
                'toggleSpan',
                'toggleSpanPlusPlat',
                'toggleSpanMinusPlat'
                )"
            >   <span>Plats du Menu</span>
                <span class="toggleSpan"> 
                    <span class="toggleSpanPlusPlat" id="toggleSpanPlusPlat">+</span>
                    <span class="toggleSpanMinusPlat hidden" id="toggleSpanMinusPlat">-</span> 
                </span>
            </span><br>
            <div id="platsCheckboxList" style="display: none;">
                @foreach($plats as $plat)
                    <label>
                        <input type="checkbox" name="plats[]" id="plat{{ $plat->id }}" value="{{ $plat->id }}" {{ in_array($plat->id, $menuPlats) ? 'checked' : '' }}>
                        {{ $plat->nom }}
                    </label><br>
                @endforeach
            </div>
            <hr>
            @error('plats')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- DESSERTS -->
        <div>
            <span class="label toggleLabel"
            id="dessertsToggle" onclick="toggleCheckboxList(
                'dessertsCheckboxList', 
                'toggleSpan',
                'toggleSpanPlusDessert',
                'toggleSpanMinusDessert'
                )"
            >   <span>Desserts du Menu</span>
                <span class="toggleSpan"> 
                    <span class="toggleSpanPlusDessert" id="toggleSpanPlusDessert">+</span>
                    <span class="toggleSpanMinusDessert hidden" id="toggleSpanMinusDessert">-</span> 
                </span>
            </span><br>
            <div id="dessertsCheckboxList" style="display: none;">
                @foreach($desserts as $dessert)
                    <label>
                        <input type="checkbox" name="desserts[]" id="dessert{{ $dessert->id }}" value="{{ $dessert->id }}" {{ in_array($dessert->id, $menuDesserts) ? 'checked' : '' }}>
                        {{ $dessert->nom }}
                    </label><br>
                @endforeach
            </div>
            <hr>
            @error('desserts')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- VINS -->
        <div>
            <span class="label toggleLabel"
            id="vinsToggle" onclick="toggleCheckboxList(
                'vinsCheckboxList', 
                'toggleSpan',
                'toggleSpanPlusVin',
                'toggleSpanMinusVin'
                )"
            >   <span>Vins du Menu</span>
                <span class="toggleSpan"> 
                    <span class="toggleSpanPlusVin" id="toggleSpanPlusVin">+</span>
                    <span class="toggleSpanMinusVin hidden" id="toggleSpanMinusVin">-</span> 
                </span>
            </span><br>
            <div id="vinsCheckboxList" style="display: none;">
                @foreach($vins as $vin)
                    <label>
                        <input type="checkbox" name="vins[]" id="vin{{ $vin->id }}" value="{{ $vin->id }}" {{ in_array($vin->id, $menuVins) ? 'checked' : '' }}>
                        {{ $vin->nom }}
                    </label><br>
                @endforeach
            </div>
            <hr>
            @error('vins')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- SOFTS -->
        <div>
            <span class="label toggleLabel"
            id="softsToggle" onclick="toggleCheckboxList(
                'softsCheckboxList', 
                'toggleSpan',
                'toggleSpanPlusSoft',
                'toggleSpanMinusSoft'
                )"
            >   <span>Boissons non alcolisées du Menu</span>
                <span class="toggleSpan"> 
                    <span class="toggleSpanPlusSoft" id="toggleSpanPlusSoft">+</span>
                    <span class="toggleSpanMinusSoft hidden" id="toggleSpanMinusSoft">-</span> 
                </span>
            </span><br>
            <div id="softsCheckboxList" style="display: none;">
                @foreach($softs as $soft)
                    <label>
                        <input type="checkbox" name="softs[]" id="soft{{ $soft->id }}" value="{{ $soft->id }}" {{ in_array($soft->id, $menuSofts) ? 'checked' : '' }}>
                        {{ $soft->nom }}
                    </label><br>
                @endforeach
            </div>
            <hr>
            @error('softs')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- ALCOOLS -->
        <div>
            <span class="label toggleLabel"
            id="alcoolsToggle" onclick="toggleCheckboxList(
                'alcoolsCheckboxList', 
                'toggleSpan',
                'toggleSpanPlusAlcool',
                'toggleSpanMinusAlcool'
                )"
            >   <span>Boissons alcolisées du Menu</span>
                <span class="toggleSpan"> 
                    <span class="toggleSpanPlusAlcool" id="toggleSpanPlusAlcool">+</span>
                    <span class="toggleSpanMinusAlcool hidden" id="toggleSpanMinusAlcool">-</span> 
                </span>
            </span><br>
            <div id="alcoolsCheckboxList" style="display: none;">
                @foreach($alcools as $alcool)
                    <label>
                        <input type="checkbox" name="alcools[]" id="alcool{{ $alcool->id }}" value="{{ $alcool->id }}" {{ in_array($alcool->id, $menuAlcools) ? 'checked' : '' }}>
                        {{ $alcool->nom }}
                    </label><br>
                @endforeach
            </div>
            <hr>
            @error('alcools')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <x-switch-button
            label="Mettre le menu en ligne ?"
            :checked="$statusChecked"
        />

        <button type="submit">Modifier</button>
    </form>
</section>


@endsection
@section('scripts')
    <script src="{{ asset('js/admin/toggleList.js') }}" defer></script>
@endsection