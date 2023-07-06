<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ReservationController extends Controller
{
    public function store(Request $request) {
    
        $validator = Validator::make($request->all(), [
            'date' => 'required|string|max:60',
            'service' => 'required|string|max:60',
            'creneau' => 'required|string|max:60',
            'convives' => 'required|integer|min:0',
            'nom' => 'required|string|max:2',
            'prenom' => 'required|string|max:2',
            'mail' => 'required|email|max:2',
            'telephone' => 'nullable|string|max:10',
            'informations' => 'nullable|string|max:255',
            'regles' => 'required|boolean',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        
        $cleanedData = $validator->clean();

        // Tous les champs dans reservation

        // Vérifier pour le mail
        // Vérifier si validation automatique ou non
        // Vérifier le nombre de convive
        // Date / Service / Convives doivent aller dans une table à part

        // ENREGISTREMENT RESERVATION
        $reservation = new Reservation();
        $reservation->date = $cleanedData['date'];
        $reservation->service = $cleanedData['service'];
        $reservation->creneau = $cleanedData['creneau'];
        $reservation->convives = $cleanedData['convives'];
        $reservation->nom = $cleanedData['nom'];
        $reservation->prenom = $cleanedData['prenom'];
        $reservation->email = $cleanedData['mail'];
        $reservation->telephone = $cleanedData['telephone'];
        $reservation->informations = $cleanedData['informations'];
        $reservation->regles = $cleanedData['regles'];
        $reservation->status = 2; // Valeur par défaut a modifier en fonction du choix et du nombre
        $reservation->save();
    }
}
