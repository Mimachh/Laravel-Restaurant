<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jour;

class JourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jours = Jour::all();

        return response()->json($jours);
    }

    public function getOpeningHours($id)
    {
        $jour = Jour::find($id);

        // Vérifiez si le jour existe dans la table "jours"
        if ($jour) {
            // Renvoyez les informations d'ouverture du restaurant pour le jour spécifié
            return response()->json([
                'is_open_midi' => $jour->is_open_midi,
                'is_open_soir' => $jour->is_open_soir,
                'couverts_midi' => $jour->couverts_midi,
                'couverts_soir' => $jour->couverts_soir,
            ]);
        }

        // Si le jour n'existe pas, renvoyez une réponse appropriée (par exemple, 404 Not Found)
        return response()->json(['error' => 'Jour not found'], 404);
    }

    public function getCreneaux($id, $service) {
        $jour = Jour::find($id);

        if($jour && $service === 'midi') {
            return response()->json([
                'ouverture' => $jour->ouverture_midi,
                'fermeture' => $jour->fermeture_midi,
            ]);
        } else if ($jour && $service === 'soir') {
            return response()->json([
                'ouverture' => $jour->ouverture_soir,
                'fermeture' => $jour->fermeture_soir,
            ]);
        }


        // Si le jour n'existe pas, renvoyez une réponse appropriée (par exemple, 404 Not Found)
        return response()->json(['error' => 'Jour not found'], 404);
    }

    public function calcGuestWithCouverts($id, $service) {
        $jour = Jour::find($id);

        if($jour && $service === 'midi') {
            return response()->json([
                'couverts' => $jour->couverts_midi,
            ]);
        } else if ($jour && $service === 'soir') {
            return response()->json([
                'couverts' => $jour->couverts_soir,
            ]);
        }


        // Si le jour n'existe pas, renvoyez une réponse appropriée (par exemple, 404 Not Found)
        return response()->json(['error' => 'Jour not found'], 404);
    }

}
