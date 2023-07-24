<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jour extends Model
{
    use HasFactory;

    public function creneauHoraires()
    {
        return $this->belongsToMany(CreneauHoraire::class, 'jour_creneauhoraire');
    }

    public function horaire_midi() {
        if($this->is_open_midi == 1) {
            $horaire_debut = list($heures_debut, $minutes_debut, $secondes_debut) = explode(':', $this->ouverture_midi);
            $heureFormattee_debut = $heures_debut . 'h' . $minutes_debut;
            $horaire_fin = list($heures_fin, $minutes_fin, $secondes_fin) = explode(':', $this->fermeture_midi);
            $heureFormattee_fin = $heures_fin . 'h' . $minutes_fin;

            $horaire = $heureFormattee_debut . '/' . $heureFormattee_fin;
        } else {
            $horaire= "Fermé";
        }

        return $horaire;
    }

    public function horaire_soir() {
        if($this->is_open_soir == 1) {
            $horaire = $this->ouverture_soir . 'h' . $this->fermeture_soir;

            $horaire_debut = list($heures_debut, $minutes_debut, $secondes_debut) = explode(':', $this->ouverture_soir);
            $heureFormattee_debut = $heures_debut . 'h' . $minutes_debut;
            $horaire_fin = list($heures_fin, $minutes_fin, $secondes_fin) = explode(':', $this->fermeture_soir);
            $heureFormattee_fin = $heures_fin . 'h' . $minutes_fin;

            $horaire = $heureFormattee_debut . '/' . $heureFormattee_fin;
        } else {
            $horaire= "Fermé";
        }

        return $horaire;
    }

}
