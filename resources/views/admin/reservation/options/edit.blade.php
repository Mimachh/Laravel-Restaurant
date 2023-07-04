@extends('layout.admin')

@section('content')
    <h1>Options de réservation</h1>

        <!-- Error Validation -->
        <div>
            @error('lundi_couverts_midi')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('lundi_couverts_soir')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('mardi_couverts_midi')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('mardi_couverts_soir')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('mercredi_couverts_midi')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('mercredi_couverts_soir')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('jeudi_couverts_midi')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('jeudi_couverts_soir')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('vendredi_couverts_midi')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('vendredi_couverts_soir')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('samedi_couverts_midi')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('samedi_couverts_soir')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('dimanche_couverts_midi')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('dimanche_couverts_soir')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

    <div class="">
    <form action="{{ route('admin.options_reservation.update') }}" method="POST">
        @csrf
        @method('PUT')
    <div class="form-table">
        <!-- Online Booking -->
        <div class="form-row">
            <div class="form-label">
                <p class="label">Ouvrir les réservations en ligne ?</p>
            </div>
            <div class="form-field">
                <div class="switch">
                    <input id="is_online_booking" name="is_online_booking" type="checkbox" value="1"  {{ $validation->is_online_booking == 1 ? 'checked' : '' }}>
                    <label for="is_online_booking"></label>
                </div>
                @error('is_online_booking')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        @if($fermeture->status == 1)
            <p class="label-interligne">Nombre de couverts par service :</p>
            <!-- JOUR COUVERT -->
                <!-- Lundi -->
                @if($lundi->is_open_midi == 1 || $lundi->is_open_soir == 1)
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Lundi</p>
                    </div>
                    <div class="form-field">
                        <!-- Midi -->
                        @if($lundi->is_open_midi == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="lundi_couverts_midi">Midi</label>
                                <input id="lundi_couverts_midi" name="lundi_couverts_midi" type="number" value="{{ $lundi->couverts_midi }}">
                            </div>
                            @error('lundi_couverts_midi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <!-- Soir -->
                        @if($lundi->is_open_soir == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="lundi_couverts_soir">Soir</label>
                                <input id="lundi_couverts_soir" name="lundi_couverts_soir" type="number" value="{{ $lundi->couverts_soir }}">    
                            </div>
                            @error('lundi_couverts_soir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <!-- Mardi -->
                @if($mardi->is_open_midi == 1 || $mardi->is_open_soir == 1)
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Mardi</p>
                    </div>
                    <div class="form-field">
                        <!-- Midi -->
                        @if($mardi->is_open_midi == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="mardi_couverts_midi">Midi</label>
                                <input id="mardi_couverts_midi" name="mardi_couverts_midi" type="number" value="{{ $mardi->couverts_midi }}">
                            </div>
                            @error('mardi_couverts_midi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <!-- Soir -->
                        @if($mardi->is_open_soir == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="mardi_couverts_soir">Soir</label>
                                <input id="mardi_couverts_soir" name="mardi_couverts_soir" type="number" value="{{ $mardi->couverts_soir }}">    
                            </div>
                            @error('mardi_couverts_soir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <!-- Mercredi -->
                @if($mercredi->is_open_midi == 1 || $mercredi->is_open_soir == 1)
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Mercredi</p>
                    </div>
                    <div class="form-field">
                        <!-- Midi -->
                        @if($mercredi->is_open_midi == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="mercredi_couverts_midi">Midi</label>
                                <input id="mercredi_couverts_midi" name="mercredi_couverts_midi" type="number" value="{{ $mercredi->couverts_midi }}">
                            </div>
                            @error('mercredi_couverts_midi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <!-- Soir -->
                        @if($mercredi->is_open_soir == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="mercredi_couverts_soir">Soir</label>
                                <input id="mercredi_couverts_soir" name="mercredi_couverts_soir" type="number" value="{{ $mercredi->couverts_soir }}">    
                            </div>
                            @error('mercredi_couverts_soir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <!-- Jeudi -->
                @if($jeudi->is_open_midi == 1 || $jeudi->is_open_soir == 1)
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Jeudi</p>
                    </div>
                    <div class="form-field">
                        <!-- Midi -->
                        @if($jeudi->is_open_midi == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="jeudi_couverts_midi">Midi</label>
                                <input id="jeudi_couverts_midi" name="jeudi_couverts_midi" type="number" value="{{ $jeudi->couverts_midi }}">
                            </div>
                            @error('jeudi_couverts_midi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <!-- Soir -->
                        @if($jeudi->is_open_soir == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="jeudi_couverts_soir">Soir</label>
                                <input id="jeudi_couverts_soir" name="jeudi_couverts_soir" type="number" value="{{ $jeudi->couverts_soir }}">    
                            </div>
                            @error('jeudi_couverts_soir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <!-- Vendredi -->
                @if($vendredi->is_open_midi == 1 || $vendredi->is_open_soir == 1)
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Vendredi</p>
                    </div>
                    <div class="form-field">
                        <!-- Midi -->
                        @if($vendredi->is_open_midi == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="vendredi_couverts_midi">Midi</label>
                                <input id="vendredi_couverts_midi" name="vendredi_couverts_midi" type="number" value="{{ $vendredi->couverts_midi }}">
                            </div>
                            @error('vendredi_couverts_midi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <!-- Soir -->
                        @if($vendredi->is_open_soir == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="vendredi_couverts_soir">Soir</label>
                                <input id="vendredi_couverts_soir" name="vendredi_couverts_soir" type="number" value="{{ $vendredi->couverts_soir }}">    
                            </div>
                            @error('vendredi_couverts_soir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <!-- Samedi -->
                @if($samedi->is_open_midi == 1 || $samedi->is_open_soir == 1)
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Samedi</p>
                    </div>
                    <div class="form-field">
                        <!-- Midi -->
                        @if($samedi->is_open_midi == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="samedi_couverts_midi">Midi</label>
                                <input id="samedi_couverts_midi" name="samedi_couverts_midi" type="number" value="{{ $samedi->couverts_midi }}">
                            </div>
                            @error('samedi_couverts_midi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <!-- Soir -->
                        @if($samedi->is_open_soir == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="samedi_couverts_soir">Soir</label>
                                <input id="samedi_couverts_soir" name="samedi_couverts_soir" type="number" value="{{ $samedi->couverts_soir }}">    
                            </div>
                            @error('samedi_couverts_soir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <!-- Dimanche -->
                @if($dimanche->is_open_midi == 1 || $dimanche->is_open_soir == 1)
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Dimanche</p>
                    </div>
                    <div class="form-field">
                        <!-- Midi -->
                        @if($dimanche->is_open_midi == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="dimanche_couverts_midi">Midi</label>
                                <input id="dimanche_couverts_midi" name="dimanche_couverts_midi" type="number" value="{{ $dimanche->couverts_midi }}">
                            </div>
                            @error('dimanche_couverts_midi')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        <!-- Soir -->
                        @if($dimanche->is_open_soir == 1)
                        <div>
                            <div class="flex align-center">
                                <label for="dimanche_couverts_soir">Soir</label>
                                <input id="dimanche_couverts_soir" name="dimanche_couverts_soir" type="number" value="{{ $dimanche->couverts_soir }}">    
                            </div>
                            @error('dimanche_couverts_soir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                <br>
            <!-- Closed Web Booking -->
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Garder les réservations accessibles pendant la fermeture du restaurant ?</p>
                    </div>
                    <div class="form-field">
                        <div class="switch">
                            <input id="is_booking_when_close" name="is_booking_when_close" type="checkbox" value="1"  {{ $validation->is_booking_when_close == 1 ? 'checked' : '' }}>
                            <label for="is_booking_when_close"></label>
                        </div>
                        @error('is_booking_when_close')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            <!-- Closed contact fermeture -->
                <div class="form-row options_if_resa_online_is_open">
                    <div class="form-label">
                        <p class="label">Garder le formulaire de contact ouvert pendant les périodes de fermeture ?</p>
                    </div>
                    <div class="form-field">
                        <div class="switch">
                            <input id="is_contact_when_close" name="is_contact_when_close" type="checkbox" value="1"  {{ $validation->is_contact_when_close == 1 ? 'checked' : '' }}>
                            <label for="is_contact_when_close"></label>
                        </div>
                        @error('is_contact_when_close')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
        @endif
    
        <p class="label-interligne">Confirmation de réservation</p>

        <!-- Confirmation Mail -->
        <div class="form-row options_if_resa_online_is_open">
            <div class="form-label">
                <p class="label">Envoyer un mail de confirmation de réservation ?</p>
            </div>
            <div class="form-field">
                <div class="switch">
                    <input id="is_email_confirmation" name="is_email_confirmation" type="checkbox" value="1"  {{ $validation->is_email_confirmation == 1 ? 'checked' : '' }}>
                    <label for="is_email_confirmation"></label>
                </div>
                @error('is_email_confirmation')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <p class="label-interligne">Validation de réservation</p>
        <!-- Confirmation Auto -->
        <div class="form-row options_if_resa_online_is_open">
            <div class="form-label">
                <p class="label">Validation automatique des réservations en ligne ?</p>
            </div>
            <div class="form-field">
                <div class="switch">
                    <input id="is_automatic_validation" name="is_automatic_validation" type="checkbox" value="1"  {{ $validation->is_automatic_validation == 1 ? 'checked' : '' }}>
                    <label for="is_automatic_validation"></label>
                </div>
                @error('is_automatic_validation')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Add limit -->
        <div class="form-row  options_if_validation_auto_is_open">
            <div class="form-label">
                <p class="label">Accepter manuellement à partir d'une certaine limite ?</p>
            </div>
            <div class="form-field">
                <div class="switch">
                    <input id="is_add_manual_validation" name="is_add_manual_validation" type="checkbox" value="1"  {{ $validation->is_add_manual_validation == 1 ? 'checked' : '' }}>
                    <label for="is_add_manual_validation"></label>
                </div>
                @error('is_add_manual_validation')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row  options_if_add_limit_is_open">
            <div class="form-label">
                <label for="manual_limit_validation" class="label">A partir de quel nombre de couvert voulez vous reprendre la main ?</label>
            </div>
            <div class="form-field">
                <input id="manual_limit_validation" name="manual_limit_validation" type="number" value="{{ $validation->manual_limit_validation }}">
            </div>
            @error('manual_limit_validation')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
    </div>
    <button type="submit" class="submit-options">Modifier</button>

</form>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/optionsResa.js') }}" defer></script>

@endsection
