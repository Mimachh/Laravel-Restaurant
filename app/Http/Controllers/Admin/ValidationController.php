<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Validation;
use App\Models\Jour;
use App\Models\Fermeture;

class ValidationController extends Controller
{
    public function index() {
        return view('admin.reservation.options.index');
    }

    public function edit() {
        $validation = Validation::first();
        $fermeture = Fermeture::first();
        return view('admin.reservation.options.edit', compact('validation', 'fermeture'));
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
        ]);

        $validation->is_online_booking = $request->is_online_booking;
        $validation->is_booking_when_close = $request->is_booking_when_close;
        $validation->is_contact_when_close = $request->is_contact_when_close;
        $validation->is_email_confirmation = $request->is_email_confirmation;
        $validation->is_automatic_validation = $request->is_automatic_validation;
        $validation->is_add_manual_validation = $request->is_add_manual_validation;
        $validation->manual_limit_validation = $request->manual_limit_validation;

        $validation->save();

        return redirect()->route('admin.options_reservation.index')->with('success', 'Les options ont été modifiées avec succès.');

    }
}
