

@extends('layout.admin')

@section('content')
    <h1>Options de réservation</h1>

    



    @if($fermeture->status == 1)
        <p>Le restaurant est actuellement fermé</p>
        <div class="table-toolbar my-4">
            <a href="{{ route('admin.creneaux.edit') }}" class="btn-create">Modifier</a>
        </div>
    @else
        <div class="table-toolbar my-4">
            
            <a href="{{ route('admin.options_reservation.edit') }}" class="btn-create">Modifier</a>
        </div>
        <div class="form-table">
            <!-- Online Booking -->
            <div class="form-row">
                <div class="form-label">
                    <p class="label">Reservation en ligne</p>
                </div>
                <div class="form-field">
                    {!! booleanOptionState($validation->is_online_booking) !!}
                </div>
            </div>
            @if($validation->is_online_booking == 1)

                <p class="label-interligne">Nombre de couverts par service :</p>
                <!-- Jours -->
                @if($lundi->is_open_midi == 1 || $lundi->is_open_soir == 1)
                    <div class="form-row">
                        <div class="form-label">
                            <p class="label">Lundi</p>
                        </div>
                        <div class="form-field">
                            @if($lundi->is_open_midi == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="lundi_couverts_midi">Midi</label>
                                        <input id="lundi_couverts_midi" name="lundi_couverts_midi" type="number" value="{{ $lundi->couverts_midi }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <!-- Soir -->
                            @if($lundi->is_open_soir == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="lundi_couverts_soir">Soir</label>
                                        <input id="lundi_couverts_soir" name="lundi_couverts_soir" type="number" value="{{ $lundi->couverts_soir }}" readonly>    
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Mardi -->
                @if($mardi->is_open_midi == 1 || $mardi->is_open_soir == 1)
                    <div class="form-row">
                        <div class="form-label">
                            <p class="label">Mardi</p>
                        </div>
                        <div class="form-field">
                            @if($mardi->is_open_midi == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="mardi_couverts_midi">Midi</label>
                                        <input id="mardi_couverts_midi" name="mardi_couverts_midi" type="number" value="{{ $mardi->couverts_midi }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <!-- Soir -->
                            @if($mardi->is_open_soir == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="mardi_couverts_soir">Soir</label>
                                        <input id="mardi_couverts_soir" name="mardi_couverts_soir" type="number" value="{{ $mardi->couverts_soir }}" readonly>    
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Mercredi -->
                @if($mercredi->is_open_midi == 1 || $mercredi->is_open_soir == 1)
                    <div class="form-row">
                        <div class="form-label">
                            <p class="label">Mercredi</p>
                        </div>
                        <div class="form-field">
                            @if($mercredi->is_open_midi == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="mercredi_couverts_midi">Midi</label>
                                        <input id="mercredi_couverts_midi" name="mercredi_couverts_midi" type="number" value="{{ $mercredi->couverts_midi }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <!-- Soir -->
                            @if($mercredi->is_open_soir == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="mercredi_couverts_soir">Soir</label>
                                        <input id="mercredi_couverts_soir" name="mercredi_couverts_soir" type="number" value="{{ $mercredi->couverts_soir }}" readonly>    
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Jeudi -->
                @if($jeudi->is_open_midi == 1 || $jeudi->is_open_soir == 1)
                    <div class="form-row">
                        <div class="form-label">
                            <p class="label">Jeudi</p>
                        </div>
                        <div class="form-field">
                            @if($jeudi->is_open_midi == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="jeudi_couverts_midi">Midi</label>
                                        <input id="jeudi_couverts_midi" name="jeudi_couverts_midi" type="number" value="{{ $jeudi->couverts_midi }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <!-- Soir -->
                            @if($jeudi->is_open_soir == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="jeudi_couverts_soir">Soir</label>
                                        <input id="jeudi_couverts_soir" name="jeudi_couverts_soir" type="number" value="{{ $jeudi->couverts_soir }}" readonly>    
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Vendredi -->
                @if($vendredi->is_open_midi == 1 || $vendredi->is_open_soir == 1)
                    <div class="form-row">
                        <div class="form-label">
                            <p class="label">Vendredi</p>
                        </div>
                        <div class="form-field">
                            @if($vendredi->is_open_midi == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="vendredi_couverts_midi">Midi</label>
                                        <input id="vendredi_couverts_midi" name="vendredi_couverts_midi" type="number" value="{{ $vendredi->couverts_midi }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <!-- Soir -->
                            @if($vendredi->is_open_soir == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="vendredi_couverts_soir">Soir</label>
                                        <input id="vendredi_couverts_soir" name="vendredi_couverts_soir" type="number" value="{{ $vendredi->couverts_soir }}" readonly>    
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Samedi -->
                @if($samedi->is_open_midi == 1 || $samedi->is_open_soir == 1)
                    <div class="form-row">
                        <div class="form-label">
                            <p class="label">Samedi</p>
                        </div>
                        <div class="form-field">
                            @if($samedi->is_open_midi == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="samedi_couverts_midi">Midi</label>
                                        <input id="samedi_couverts_midi" name="samedi_couverts_midi" type="number" value="{{ $samedi->couverts_midi }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <!-- Soir -->
                            @if($samedi->is_open_soir == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="samedi_couverts_soir">Soir</label>
                                        <input id="samedi_couverts_soir" name="samedi_couverts_soir" type="number" value="{{ $samedi->couverts_soir }}" readonly>    
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Dimanche -->
                @if($dimanche->is_open_midi == 1 || $dimanche->is_open_soir == 1)
                    <div class="form-row">
                        <div class="form-label">
                            <p class="label">Dimanche</p>
                        </div>
                        <div class="form-field">
                            @if($dimanche->is_open_midi == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="dimanche_couverts_midi">Midi</label>
                                        <input id="dimanche_couverts_midi" name="dimanche_couverts_midi" type="number" value="{{ $dimanche->couverts_midi }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <!-- Soir -->
                            @if($dimanche->is_open_soir == 1)
                                <div>
                                    <div class="flex align-center">
                                        <label for="dimanche_couverts_soir">Soir</label>
                                        <input id="dimanche_couverts_soir" name="dimanche_couverts_soir" type="number" value="{{ $dimanche->couverts_soir }}" readonly>    
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <!-- Fin des jours  -->
                <br>
                <div class="form-row">
                    <div class="form-label">
                        <p class="label">Réservation en période de fermeture</p>
                    </div>
                    <div class="form-field">
                        {!! booleanOptionState($validation->is_booking_when_close) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label">
                        <p class="label">Formulaire de contact disponible en période de fermeture</p>
                    </div>
                    <div class="form-field">
                        {!! booleanOptionState($validation->is_contact_when_close) !!}
                    </div>
                </div>

                <p class="label-interligne">Confirmation de réservation</p>
                <div class="form-row">
                    <div class="form-label">
                        <p class="label">Confirmation des réservations par email</p>
                    </div>
                    <div class="form-field">
                        {!! booleanOptionState($validation->is_email_confirmation) !!}
                    </div>
                </div>
                <p class="label-interligne">Validation de réservation</p>
                <div class="form-row">
                    <div class="form-label">
                        <p class="label">Validation automatique des réservations</p>
                    </div>
                    <div class="form-field">
                        {!! booleanOptionState($validation->is_automatic_validation) !!}
                    </div>
                </div>
            @endif
            @if($validation->is_online_booking == 1 && $validation->is_automatic_validation == 1)
            <div class="form-row">
                <div class="form-label">
                    <p class="label">Validation manuelle à partir d'une certaine limite</p>
                </div>
                <div class="form-field">
                    {!! booleanOptionState($validation->is_add_manual_validation) !!}
                </div>
            </div>
            @endif
            @if($validation->is_online_booking == 1 && $validation->is_automatic_validation == 1 && $validation->is_add_manual_validation == 1)
            <div class="form-row">
                <div class="form-label">
                    <p class="label">Validation manuelle à partir de </p>
                </div>
                <div class="form-field">
                    {{ $validation->manual_limit_validation }} couverts
                </div>
            </div>
            @endif
        </div>
    @endif
@endsection

@section('scripts')

@endsection