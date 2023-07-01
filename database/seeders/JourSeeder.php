<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jour;
class JourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jour::create([
            'nom' => 'Lundi',
            'ouverture_midi'=> '9:00',
            'fermeture_midi' => '12:00',
            'is_open_midi' => 1,
            'is_open_soir' => 1,
            'ouverture_soir' => '18:00',
            'fermeture_soir' => '23:00'
        ]);

        Jour::create([
            'nom' => 'Mardi',
            'ouverture_midi'=> '9:00',
            'fermeture_midi' => '12:00',
            'is_open_midi' => 1,
            'is_open_soir' => 1,
            'ouverture_soir' => '18:00',
            'fermeture_soir' => '23:00'
        ]);

        Jour::create([
            'nom' => 'Mercredi',
            'ouverture_midi'=> '9:00',
            'fermeture_midi' => '12:00',
            'is_open_midi' => 1,
            'is_open_soir' => 1,
            'ouverture_soir' => '18:00',
            'fermeture_soir' => '23:00'
        ]);

        Jour::create([
            'nom' => 'Jeudi',
            'ouverture_midi'=> '9:00',
            'fermeture_midi' => '12:00',
            'is_open_midi' => 1,
            'is_open_soir' => 1,
            'ouverture_soir' => '18:00',
            'fermeture_soir' => '23:00'
        ]);

        Jour::create([
            'nom' => 'Vendredi',
            'ouverture_midi'=> '9:00',
            'fermeture_midi' => '12:00',
            'is_open_midi' => 1,
            'is_open_soir' => 1,
            'ouverture_soir' => '18:00',
            'fermeture_soir' => '23:00'
        ]);

        Jour::create([
            'nom' => 'Samedi',
            'is_open_midi' => 0,
            'is_open_soir' => 0,
        ]);

        Jour::create([
            'nom' => 'Dimanche',
            'is_open_midi' => 0,
            'is_open_soir' => 0,
        ]);
    }
}
