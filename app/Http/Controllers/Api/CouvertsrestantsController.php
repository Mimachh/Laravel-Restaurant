<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Couvertsrestants;

class CouvertsrestantsController extends Controller
{
    public function couvertsRestants($nom) {
        $data = CouvertsRestants::where('nom', $nom)->first();


        // Vérifiez si le jour existe dans la table "jours"
        if ($data) {
            // Renvoyez les informations d'ouverture du restaurant pour le jour spécifié
            return response()->json([
                'couverts_restants' => $data->couverts_restants,
            ]);
        }

        // Si le jour n'existe pas, renvoyez une réponse appropriée (par exemple, 404 Not Found)
        return response()->json(['message' => 'no exist']);
    }
}
