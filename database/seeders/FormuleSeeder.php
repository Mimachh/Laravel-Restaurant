<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Formule;

class FormuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Formule::create([
            'nom' => 'formule 1',
            'description' => 'Description du formule 1',
            'prix' => 12.99,
            'info_supp' => 'Informations supplémentaires du formule 1',
        ]);

        Formule::create([
            'nom' => 'formule 2',
            'description' => 'Description du formule 2',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du formule 2',
        ]);

        Formule::create([
            'nom' => 'formule 3',
            'description' => 'Description du formule 3',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du formule 3',
        ]);

        Formule::create([
            'nom' => 'formule 4',
            'description' => 'Description du formule 4',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du formule 4',
        ]);
    }
}
