@extends('layout.admin')

@section('content')
    <h1>Liste des heures d'ouverture</h1>

    <div>
        <form action="{{ route('admin.creneaux.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="">
                <div>
                    <div class="my-4 fermeture-div">
                        <p class="label-fermeture">Fermer le restaurant ?</p>
                        <div class="switch">
                            <input id="status" name="switch_fermeture" type="checkbox" value="1"  {{ $fermeture->status == 1 ? 'checked' : '' }}>
                            <label for="status"></label>
                        </div>
                    </div>
                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <section class="admin-form-container" id="form-section" @if ($fermeture->status == '1') style="display: none" @endif>
                    <div>
                        <label class="label" for="date_fermeture">Plage de dates :</label>
                        <input type="text" id="date-range" placeholder="Sélectionnez une plage de dates" name="plage_fermeture"
                        value="{{ $plageFermetureVacances }}"
                        >
                        @error('plage_fermeture')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>


                    <div>
                        <label class="label" for="raison">Raison de la fermeture (uniquement si vous souhaitez afficher la raison à vos clients)</label>
                        <input type="text" name="raison" value="{{ $fermeture->raison }}">
                    </div>
                    
                </section>
            </div>

            <table class="user-table" @if ($fermeture->status != '1') style="display: none" @endif>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jour</th>
                        <th>Ouvert le midi ?</th>
                        <th>Ouvert le soir ?</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Lundi -->
                    <tr>
                        <td>1</td>
                        <td>Lundi</td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_lundi_midi_ouverture" name="switch_lundi_midi_ouverture" type="checkbox" value="1"
                                {{ $lundi->is_open_midi == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_lundi_midi_ouverture"></label>
                            </div>
                            @error('switch_lundi_midi_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="lundi_midi_div time_div flex-row-td-inner" id="lundi_midi_div">
                                <label for="horaire_lundi_midi_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_lundi_midi_ouverture" value="{{ $lundi->ouverture_midi }}">
                                <label for="horaire_lundi_midi_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_lundi_midi_fermeture" value="{{ $lundi->fermeture_midi }}">
                            </div>
                        </td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_lundi_soir_ouverture" name="switch_lundi_soir_ouverture" type="checkbox" value="1"
                                {{ $lundi->is_open_soir == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_lundi_soir_ouverture"></label>
                            </div>
                            @error('switch_lundi_soir_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="lundi_soir_div time_div" id="lundi_soir_div">
                                <label for="horaire_lundi_soir_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_lundi_soir_ouverture" value="{{ $lundi->ouverture_soir }}">
                                <label for="horaire_lundi_soir_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_lundi_soir_fermeture" value="{{ $lundi->fermeture_soir }}">
                            </div>
                        </td>
                    </tr>

                    <!-- Mardi -->
                    <tr>
                        <td>2</td>
                        <td>Mardi</td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_mardi_midi_ouverture" name="switch_mardi_midi_ouverture" type="checkbox" value="1"
                                {{ $mardi->is_open_midi == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_mardi_midi_ouverture"></label>
                            </div>
                            @error('switch_mardi_midi_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="mardi_midi_div time_div" id="mardi_midi_div">
                                <label for="horaire_mardi_midi_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mardi_midi_ouverture"
                                value="{{ $mardi->ouverture_midi }}"
                                >
                                <label for="horaire_mardi_midi_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mardi_midi_fermeture"
                                value="{{ $mardi->fermeture_midi }}"
                                >
                            </div>
                        </td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_mardi_soir_ouverture" name="switch_mardi_soir_ouverture" type="checkbox" value="1"
                                {{ $mardi->is_open_soir == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_mardi_soir_ouverture"></label>
                            </div>
                            @error('switch_mardi_soir_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="mardi_soir_div time_div" id="mardi_soir_div">
                                <label for="horaire_mardi_soir_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mardi_soir_ouverture"
                                value="{{ $mardi->ouverture_soir }}"
                                >
                                <label for="horaire_mardi_soir_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mardi_soir_fermeture"
                                value="{{ $mardi->fermeture_soir }}"
                                >
                            </div>
                        </td>
                    </tr>

                    <!-- Mercredi -->
                    <tr>
                        <td>3</td>
                        <td>Mercredi</td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_mercredi_midi_ouverture" name="switch_mercredi_midi_ouverture" type="checkbox" value="1"
                                {{ $mercredi->is_open_midi == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_mercredi_midi_ouverture"></label>
                            </div>
                            @error('switch_mercredi_midi_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="mercredi_midi_div time_div" id="mercredi_midi_div">
                                <label for="horaire_mercredi_midi_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mercredi_midi_ouverture"
                                value="{{ $mercredi->ouverture_midi }}"
                                >
                                <label for="horaire_mercredi_midi_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mercredi_midi_fermeture"
                                value="{{ $mercredi->fermeture_midi }}"
                                >
                            </div>
                        </td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_mercredi_soir_ouverture" name="switch_mercredi_soir_ouverture" type="checkbox" value="1"
                                {{ $mercredi->is_open_soir == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_mercredi_soir_ouverture"></label>
                            </div>
                            @error('switch_mercredi_soir_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="mercredi_soir_div time_div" id="mercredi_soir_div">
                                <label for="horaire_mercredi_soir_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mercredi_soir_ouverture"
                                value="{{ $mercredi->ouverture_soir }}"
                                >
                                <label for="horaire_mercredi_soir_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_mercredi_soir_fermeture"
                                value="{{ $mercredi->fermeture_soir }}"
                                >
                            </div>
                        </td>
                    </tr>

                    <!-- Jeudi -->
                    <tr>
                        <td>4</td>
                        <td>Jeudi</td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_jeudi_midi_ouverture" name="switch_jeudi_midi_ouverture" type="checkbox" value="1"
                                {{ $jeudi->is_open_midi == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_jeudi_midi_ouverture"></label>
                            </div>
                            @error('switch_jeudi_midi_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="jeudi_midi_div time_div" id="jeudi_midi_div">
                                <label for="horaire_jeudi_midi_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_jeudi_midi_ouverture"
                                value="{{ $jeudi->ouverture_midi }}"
                                >
                                <label for="horaire_jeudi_midi_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_jeudi_midi_fermeture"
                                value="{{ $jeudi->fermeture_midi }}"
                                >
                            </div>
                        </td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_jeudi_soir_ouverture" name="switch_jeudi_soir_ouverture" type="checkbox" value="1"
                                {{ $jeudi->is_open_soir == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_jeudi_soir_ouverture"></label>
                            </div>
                            @error('switch_jeudi_soir_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="jeudi_soir_div time_div" id="jeudi_soir_div">
                                <label for="horaire_jeudi_soir_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_jeudi_soir_ouverture"
                                value="{{ $jeudi->ouverture_soir }}"
                                >
                                <label for="horaire_jeudi_soir_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_jeudi_soir_fermeture"
                                value="{{ $jeudi->fermeture_soir }}"
                                >
                            </div>
                        </td>
                    </tr>

                    <!-- Vendredi -->
                    <tr>
                        <td>5</td>
                        <td>Vendredi</td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_vendredi_midi_ouverture" name="switch_vendredi_midi_ouverture" type="checkbox" value="1"
                                {{ $vendredi->is_open_midi == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_vendredi_midi_ouverture"></label>
                            </div>
                            @error('switch_vendredi_midi_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="vendredi_midi_div time_div" id="vendredi_midi_div">
                                <label for="horaire_vendredi_midi_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_vendredi_midi_ouverture"
                                value="{{ $vendredi->ouverture_midi }}"
                                >
                                <label for="horaire_vendredi_midi_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_vendredi_midi_fermeture"
                                value="{{ $vendredi->fermeture_midi }}"
                                >
                            </div>
                        </td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_vendredi_soir_ouverture" name="switch_vendredi_soir_ouverture" type="checkbox" value="1"
                                {{ $vendredi->is_open_soir == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_vendredi_soir_ouverture"></label>
                            </div>
                            @error('switch_vendredi_soir_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="vendredi_soir_div time_div" id="vendredi_soir_div">
                                <label for="horaire_vendredi_soir_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_vendredi_soir_ouverture"
                                value="{{ $vendredi->ouverture_soir }}"
                                >
                                <label for="horaire_vendredi_soir_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_vendredi_soir_fermeture"
                                value="{{ $vendredi->fermeture_soir }}"
                                >
                            </div>
                        </td>
                    </tr>

                    <!-- Samedi -->
                    <tr>
                        <td>6</td>
                        <td>Samedi</td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_samedi_midi_ouverture" name="switch_samedi_midi_ouverture" type="checkbox" value="1"
                                {{ $samedi->is_open_midi == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_samedi_midi_ouverture"></label>
                            </div>
                            @error('switch_samedi_midi_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="samedi_midi_div time_div" id="samedi_midi_div">
                                <label for="horaire_samedi_midi_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_samedi_midi_ouverture"
                                value="{{ $samedi->ouverture_midi }}"
                                >
                                <label for="horaire_samedi_midi_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_samedi_midi_fermeture"
                                value="{{ $samedi->fermeture_midi }}"
                                >
                            </div>
                        </td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_samedi_soir_ouverture" name="switch_samedi_soir_ouverture" type="checkbox" value="1"
                                {{ $samedi->is_open_soir == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_samedi_soir_ouverture"></label>
                            </div>
                            @error('switch_samedi_soir_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="samedi_soir_div time_div" id="samedi_soir_div">
                                <label for="horaire_samedi_soir_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_samedi_soir_ouverture"
                                value="{{ $samedi->ouverture_soir }}"
                                >
                                <label for="horaire_samedi_soir_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_samedi_soir_fermeture"
                                value="{{ $samedi->fermeture_soir }}"
                                >
                            </div>
                        </td>
                    </tr>

                    <!-- Dimanche -->
                    <tr>
                        <td>7</td>
                        <td>Dimanche</td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_dimanche_midi_ouverture" name="switch_dimanche_midi_ouverture" type="checkbox" value="1"
                                {{ $dimanche->is_open_midi == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_dimanche_midi_ouverture"></label>
                            </div>
                            @error('switch_dimanche_midi_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="dimanche_midi_div time_div" id="dimanche_midi_div">
                                <label for="horaire_dimanche_midi_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_dimanche_midi_ouverture"
                                value="{{ $dimanche->ouverture_midi }}"
                                >
                                <label for="horaire_dimanche_midi_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_dimanche_midi_fermeture"
                                value="{{ $dimanche->fermeture_midi }}"
                                >
                            </div>
                        </td>
                        <td class="flex-row-td">
                            <div class="switch">
                                <input id="switch_dimanche_soir_ouverture" name="switch_dimanche_soir_ouverture" type="checkbox" value="1"
                                {{ $dimanche->is_open_soir == 1 ? 'checked' : '' }}
                                >
                                <label for="switch_dimanche_soir_ouverture"></label>
                            </div>
                            @error('switch_dimanche_soir_ouverture')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <div class="dimanche_soir_div time_div" id="dimanche_soir_div">
                                <label for="horaire_dimanche_soir_ouverture">De</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_dimanche_soir_ouverture"
                                value="{{ $dimanche->ouverture_soir }}"
                                >
                                <label for="horaire_dimanche_soir_fermeture">à</label>
                                <input type="time" class="timepicker-creneau-horaire" name="horaire_dimanche_soir_fermeture"
                                value="{{ $dimanche->fermeture_soir }}"
                                >
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="admin-form-container">
               <button type="submit">Enregistrer</button>
            </div>
            
        </form>
    </div>





@endsection

@section('scripts')
<script src="{{ asset('js/admin/jourHoraireToggle.js') }}" defer></script>
<script src="{{ asset('js/admin/timePicker.js') }}" defer></script>
@endsection