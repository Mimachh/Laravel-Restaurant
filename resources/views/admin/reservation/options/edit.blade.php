@extends('layout.admin')

@section('content')
    <h1>Options de réservation</h1>

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
