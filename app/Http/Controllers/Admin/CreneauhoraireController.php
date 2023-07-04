<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jour;
use App\Models\Fermeture;

class CreneauhoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jours = Jour::all();
        $fermeture = Fermeture::first();
        return view('admin.creneaux.index', compact('jours', 'fermeture'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $jours = Jour::all();
        $fermeture = Fermeture::first();
      
        if(isset($fermeture->date_debut) && isset($fermeture->date_fin)) {
          $plageFermetureVacances = $fermeture->date_debut . ' to ' . $fermeture->date_fin;  
        } else {
            $plageFermetureVacances = "";
        }

        // dd($plageFermetureVacances);

        $lundi = Jour::find(1);
        $mardi = Jour::find(2);
        $mercredi = Jour::find(3);
        $jeudi = Jour::find(4);
        $vendredi = Jour::find(5);
        $samedi = Jour::find(6);
        $dimanche = Jour::find(7);

        return view('admin.creneaux.edit', compact(
            'jours', 
            'fermeture', 
            'lundi',
            'mardi',
            'mercredi',
            'jeudi',
            'vendredi',
            'samedi',
            'dimanche',
            'plageFermetureVacances'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request);


        $fermeture = Fermeture::first();
        $lundi = Jour::find(1);
        $mardi = Jour::find(2);
        $mercredi = Jour::find(3);
        $jeudi = Jour::find(4);
        $vendredi = Jour::find(5);
        $samedi = Jour::find(6);
        $dimanche = Jour::find(7);

        $data = $request->validate([
            'switch_fermeture' => 'nullable|numeric',
            'plage_fermeture' => 'nullable|required_if:switch_fermeture,1|string',
            'raison' => 'nullable|string',

            'switch_lundi_midi_ouverture' => 'nullable|numeric',
            'horaire_lundi_midi_ouverture' => 'nullable|required_if:switch_lundi_midi_ouverture,1|date_format:H:i',
            'horaire_lundi_midi_fermeture' => 'nullable|required_if:switch_lundi_midi_ouverture,1|date_format:H:i',

            'switch_lundi_soir_ouverture' => 'nullable|numeric',
            'horaire_lundi_soir_ouverture' => 'nullable|required_if:switch_lundi_soir_ouverture,1|date_format:H:i',
            'horaire_lundi_soir_fermeture' => 'nullable|required_if:switch_lundi_soir_ouverture,1|date_format:H:i',


            'switch_mardi_midi_ouverture' => 'nullable|numeric',
            'horaire_mardi_midi_ouverture' => 'nullable|required_if:switch_mardi_midi_ouverture,1|date_format:H:i',
            'horaire_mardi_midi_fermeture' => 'nullable|required_if:switch_mardi_midi_ouverture,1|date_format:H:i',

            'switch_mardi_soir_ouverture' => 'nullable|numeric',
            'horaire_mardi_soir_ouverture' => 'nullable|required_if:switch_mardi_soir_ouverture,1|date_format:H:i',
            'horaire_mardi_soir_fermeture' => 'nullable|required_if:switch_mardi_soir_ouverture,1|date_format:H:i',

            'switch_mercredi_midi_ouverture' => 'nullable|numeric',
            'horaire_mercredi_midi_ouverture' => 'nullable|required_if:switch_mercredi_midi_ouverture,1|date_format:H:i',
            'horaire_mercredi_midi_fermeture' => 'nullable|required_if:switch_mercredi_midi_ouverture,1|date_format:H:i',

            'switch_mercredi_soir_ouverture' => 'nullable|numeric',
            'horaire_mercredi_soir_ouverture' => 'nullable|required_if:switch_mercredi_soir_ouverture,1|date_format:H:i',
            'horaire_mercredi_soir_fermeture' => 'nullable|required_if:switch_mercredi_soir_ouverture,1|date_format:H:i',


            'switch_jeudi_midi_ouverture' => 'nullable|numeric',
            'horaire_jeudi_midi_ouverture' => 'nullable|required_if:switch_jeudi_midi_ouverture,1|date_format:H:i',
            'horaire_jeudi_midi_fermeture' => 'nullable|required_if:switch_jeudi_midi_ouverture,1|date_format:H:i',

            'switch_jeudi_soir_ouverture' => 'nullable|numeric',
            'horaire_jeudi_soir_ouverture' => 'nullable|required_if:switch_jeudi_soir_ouverture,1|date_format:H:i',
            'horaire_jeudi_soir_fermeture' => 'nullable|required_if:switch_jeudi_soir_ouverture,1|date_format:H:i',

            'switch_vendredi_midi_ouverture' => 'nullable|numeric',
            'horaire_vendredi_midi_ouverture' => 'nullable|required_if:switch_vendredi_midi_ouverture,1|date_format:H:i',
            'horaire_vendredi_midi_fermeture' => 'nullable|required_if:switch_vendredi_midi_ouverture,1|date_format:H:i',

            'switch_vendredi_soir_ouverture' => 'nullable|numeric',
            'horaire_vendredi_soir_ouverture' => 'nullable|required_if:switch_vendredi_soir_ouverture,1|date_format:H:i',
            'horaire_vendredi_soir_fermeture' => 'nullable|required_if:switch_vendredi_soir_ouverture,1|date_format:H:i',

            'switch_samedi_midi_ouverture' => 'nullable|numeric',
            'horaire_samedi_midi_ouverture' => 'nullable|required_if:switch_samedi_midi_ouverture,1|date_format:H:i',
            'horaire_samedi_midi_fermeture' => 'nullable|required_if:switch_samedi_midi_ouverture,1|date_format:H:i',

            'switch_samedi_soir_ouverture' => 'nullable|numeric',
            'horaire_samedi_soir_ouverture' => 'nullable|required_if:switch_samedi_soir_ouverture,1|date_format:H:i',
            'horaire_samedi_soir_fermeture' => 'nullable|required_if:switch_samedi_soir_ouverture,1|date_format:H:i',

            'switch_dimanche_midi_ouverture' => 'nullable|numeric',
            'horaire_dimanche_midi_ouverture' => 'nullable|required_if:switch_dimanche_midi_ouverture,1|date_format:H:i',
            'horaire_dimanche_midi_fermeture' => 'nullable|required_if:switch_dimanche_midi_ouverture,1|date_format:H:i',

            'switch_dimanche_soir_ouverture' => 'nullable|numeric',
            'horaire_dimanche_soir_ouverture' => 'nullable|required_if:switch_dimanche_soir_ouverture,1|date_format:H:i',
            'horaire_dimanche_soir_fermeture' => 'nullable|required_if:switch_dimanche_soir_ouverture,1|date_format:H:i',

        ]);



        // TABLE FERMETURE
        // $debut_fermeture_vacances = null;
        // $fin_fermeture_vacances = null;

        if(isset($request->plage_fermeture)) {
            $plage_fermeture = $request->plage_fermeture;

            if (strpos($plage_fermeture, ' to ') !== false) {
            list($debut_fermeture_vacances, $fin_fermeture_vacances) = explode(" to ", $request->plage_fermeture);

            $startDateTimestamp = strtotime($debut_fermeture_vacances);
            $endDateTimestamp = strtotime($fin_fermeture_vacances);

            // Formater les timestamps en dates au format désiré
            $debut_fermeture_vacances = date('d-m-Y', $startDateTimestamp);
            $fin_fermeture_vacances = date('d-m-Y', $endDateTimestamp);
            } else {
                $startDateTimestamp = strtotime($plage_fermeture);
   
    
                // Formater les timestamps en dates au format désiré
                $debut_fermeture_vacances = date('d-m-Y', $startDateTimestamp);
                $fin_fermeture_vacances = null;
            }

        } else {
            $debut_fermeture_vacances = null;
            $fin_fermeture_vacances = null;
        }
        
        

        $fermeture->status = $request->switch_fermeture;
        $fermeture->date_debut = $debut_fermeture_vacances;
        $fermeture->date_fin = $fin_fermeture_vacances;
        $fermeture->raison = $request->raison;
        $fermeture->save();

        // TABLE JOUR
        // Lundi
        $lundi->is_open_midi = $request->switch_lundi_midi_ouverture;
        $lundi->ouverture_midi = $request->horaire_lundi_midi_ouverture;
        $lundi->fermeture_midi = $request->horaire_lundi_midi_fermeture;

        $lundi->is_open_soir = $request->switch_lundi_soir_ouverture;
        $lundi->ouverture_soir = $request->horaire_lundi_soir_ouverture;
        $lundi->fermeture_soir = $request->horaire_lundi_soir_fermeture;

        $lundi->save();

        // Mardi
        $mardi->is_open_midi = $request->switch_mardi_midi_ouverture;
        $mardi->ouverture_midi = $request->horaire_mardi_midi_ouverture;
        $mardi->fermeture_midi = $request->horaire_mardi_midi_fermeture;

        $mardi->is_open_soir = $request->switch_mardi_soir_ouverture;
        $mardi->ouverture_soir = $request->horaire_mardi_soir_ouverture;
        $mardi->fermeture_soir = $request->horaire_mardi_soir_fermeture;

        $mardi->save();

        // Mercredi
        $mercredi->is_open_midi = $request->switch_mercredi_midi_ouverture;
        $mercredi->ouverture_midi = $request->horaire_mercredi_midi_ouverture;
        $mercredi->fermeture_midi = $request->horaire_mercredi_midi_fermeture;

        $mercredi->is_open_soir = $request->switch_mercredi_soir_ouverture;
        $mercredi->ouverture_soir = $request->horaire_mercredi_soir_ouverture;
        $mercredi->fermeture_soir = $request->horaire_mercredi_soir_fermeture;

        $mercredi->save();

        // Jeudi
        $jeudi->is_open_midi = $request->switch_jeudi_midi_ouverture;
        $jeudi->ouverture_midi = $request->horaire_jeudi_midi_ouverture;
        $jeudi->fermeture_midi = $request->horaire_jeudi_midi_fermeture;

        $jeudi->is_open_soir = $request->switch_jeudi_soir_ouverture;
        $jeudi->ouverture_soir = $request->horaire_jeudi_soir_ouverture;
        $jeudi->fermeture_soir = $request->horaire_jeudi_soir_fermeture;

        $jeudi->save();

        // Vendredi
        $vendredi->is_open_midi = $request->switch_vendredi_midi_ouverture;
        $vendredi->ouverture_midi = $request->horaire_vendredi_midi_ouverture;
        $vendredi->fermeture_midi = $request->horaire_vendredi_midi_fermeture;

        $vendredi->is_open_soir = $request->switch_vendredi_soir_ouverture;
        $vendredi->ouverture_soir = $request->horaire_vendredi_soir_ouverture;
        $vendredi->fermeture_soir = $request->horaire_vendredi_soir_fermeture;

        $vendredi->save();

        // Samedi
        $samedi->is_open_midi = $request->switch_samedi_midi_ouverture;
        $samedi->ouverture_midi = $request->horaire_samedi_midi_ouverture;
        $samedi->fermeture_midi = $request->horaire_samedi_midi_fermeture;

        $samedi->is_open_soir = $request->switch_samedi_soir_ouverture;
        $samedi->ouverture_soir = $request->horaire_samedi_soir_ouverture;
        $samedi->fermeture_soir = $request->horaire_samedi_soir_fermeture;

        $samedi->save();

        // Dimanche
        $dimanche->is_open_midi = $request->switch_dimanche_midi_ouverture;
        $dimanche->ouverture_midi = $request->horaire_dimanche_midi_ouverture;
        $dimanche->fermeture_midi = $request->horaire_dimanche_midi_fermeture;

        $dimanche->is_open_soir = $request->switch_dimanche_soir_ouverture;
        $dimanche->ouverture_soir = $request->horaire_dimanche_soir_ouverture;
        $dimanche->fermeture_soir = $request->horaire_dimanche_soir_fermeture;

        $dimanche->save();

        return redirect()->route('admin.creneaux.index')->with('success', 'Les horaires ont été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
