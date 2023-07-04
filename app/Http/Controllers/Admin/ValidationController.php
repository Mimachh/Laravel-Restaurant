<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Validation;
use App\Models\Jour;
use App\Models\Fermeture;
use Illuminate\Validation\Rule;
class ValidationController extends Controller
{
    public function index() {
        $validation = Validation::first();
        $lundi = Jour::find(1);
        $mardi = Jour::find(2);
        $mercredi = Jour::find(3);
        $jeudi = Jour::find(4);
        $vendredi = Jour::find(5);
        $samedi = Jour::find(6);
        $dimanche = Jour::find(7);
        return view('admin.reservation.options.index', compact(
            'validation',
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi',
            'samedi',
            'dimanche',
        ));
    }

    public function edit() {
        $validation = Validation::first();
        $fermeture = Fermeture::first();

        $lundi = Jour::find(1);
        $mardi = Jour::find(2);
        $mercredi = Jour::find(3);
        $jeudi = Jour::find(4);
        $vendredi = Jour::find(5);
        $samedi = Jour::find(6);
        $dimanche = Jour::find(7);

        return view('admin.reservation.options.edit', compact(
            'validation', 
            'fermeture',
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi',
            'samedi',
            'dimanche',
        ));
    }

    public function update(Request $request) {
        // return view('admin.reservation.options.index');

        $lundi = Jour::find(1);
        $mardi = Jour::find(2);
        $mercredi = Jour::find(3);
        $jeudi = Jour::find(4);
        $vendredi = Jour::find(5);
        $samedi = Jour::find(6);
        $dimanche = Jour::find(7);

        $validation = Validation::first();

        $data = $request->validate([
            'is_online_booking' => 'nullable|numeric',
            'is_booking_when_close' => 'nullable|numeric',
            'is_contact_when_close' => 'nullable|numeric',
            'is_email_confirmation' => 'nullable|numeric',
            'is_automatic_validation' => 'nullable|numeric',
            'is_add_manual_validation' => 'nullable|numeric',
            'manual_limit_validation' => 'nullable|required_if:is_add_manual_validation,1|numeric',
        
            'lundi_couverts_midi' => Rule::requiredIf(function () use ($lundi, $request) {
                return $lundi && $lundi->is_open_midi == 1 && $request->is_online_booking == 1;
            }),
            'lundi_couverts_soir' => Rule::requiredIf(function () use ($lundi, $request) {
                return $lundi && $lundi->is_open_soir == 1 && $request->is_online_booking == 1;
            }),

            'mardi_couverts_midi' => Rule::requiredIf(function () use ($mardi, $request) {
                return $mardi && $mardi->is_open_midi == 1 && $request->is_online_booking == 1;
            }),
            'mardi_couverts_soir' => Rule::requiredIf(function () use ($mardi, $request) {
                return $mardi && $mardi->is_open_soir == 1 && $request->is_online_booking == 1;
            }),

            'mercredi_couverts_midi' => Rule::requiredIf(function () use ($mercredi, $request) {
                return $mercredi && $mercredi->is_open_midi == 1 && $request->is_online_booking == 1;
            }),
            'mercredi_couverts_soir' => Rule::requiredIf(function () use ($mercredi, $request) {
                return $mercredi && $mercredi->is_open_soir == 1 && $request->is_online_booking == 1;
            }),

            'jeudi_couverts_midi' => Rule::requiredIf(function () use ($jeudi, $request) {
                return $jeudi && $jeudi->is_open_midi == 1 && $request->is_online_booking == 1;
            }),
            'jeudi_couverts_soir' => Rule::requiredIf(function () use ($jeudi, $request) {
                return $jeudi && $jeudi->is_open_soir == 1 && $request->is_online_booking == 1;
            }),

            'vendredi_couverts_midi' => Rule::requiredIf(function () use ($vendredi, $request) {
                return $vendredi && $vendredi->is_open_midi == 1 && $request->is_online_booking == 1;
            }),
            'vendredi_couverts_soir' => Rule::requiredIf(function () use ($vendredi, $request) {
                return $vendredi && $vendredi->is_open_soir == 1 && $request->is_online_booking == 1;
            }),

            'samedi_couverts_midi' => Rule::requiredIf(function () use ($samedi, $request) {
                return $samedi && $samedi->is_open_midi == 1 && $request->is_online_booking == 1;
            }),
            'samedi_couverts_soir' => Rule::requiredIf(function () use ($samedi, $request) {
                return $samedi && $samedi->is_open_soir == 1 && $request->is_online_booking == 1;
            }),

            'dimanche_couverts_midi' => Rule::requiredIf(function () use ($dimanche, $request) {
                return $dimanche && $dimanche->is_open_midi == 1 && $request->is_online_booking == 1;
            }),
            'dimanche_couverts_soir' => Rule::requiredIf(function () use ($dimanche, $request) {
                return $dimanche && $dimanche->is_open_soir == 1 && $request->is_online_booking == 1;
            }),
            
        
        ]);

        $validation->is_online_booking = $request->is_online_booking;
        $validation->is_booking_when_close = $request->is_booking_when_close;
        $validation->is_contact_when_close = $request->is_contact_when_close;
        $validation->is_email_confirmation = $request->is_email_confirmation;
        $validation->is_automatic_validation = $request->is_automatic_validation;
        $validation->is_add_manual_validation = $request->is_add_manual_validation;
        $validation->manual_limit_validation = $request->manual_limit_validation;

        $validation->save();

        $lundi->couverts_midi = $request->lundi_couverts_midi;
        $lundi->couverts_soir = $request->lundi_couverts_soir;
        $lundi->save();

        $mardi->couverts_midi = $request->mardi_couverts_midi;
        $mardi->couverts_soir = $request->mardi_couverts_soir;
        $mardi->save();

        $mercredi->couverts_midi = $request->mercredi_couverts_midi;
        $mercredi->couverts_soir = $request->mercredi_couverts_soir;
        $mercredi->save();

        $jeudi->couverts_midi = $request->jeudi_couverts_midi;
        $jeudi->couverts_soir = $request->jeudi_couverts_soir;
        $jeudi->save();

        $vendredi->couverts_midi = $request->vendredi_couverts_midi;
        $vendredi->couverts_soir = $request->vendredi_couverts_soir;
        $vendredi->save();

        $samedi->couverts_midi = $request->samedi_couverts_midi;
        $samedi->couverts_soir = $request->samedi_couverts_soir;
        $samedi->save();

        $dimanche->couverts_midi = $request->dimanche_couverts_midi;
        $dimanche->couverts_soir = $request->dimanche_couverts_soir;
        $dimanche->save();
        

        return redirect()->route('admin.options_reservation.index')->with('success', 'Les options ont été modifiées avec succès.');

    }
}
