<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Allergene;
class AllergeneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Exemple de données d'allergènes
        $allergenes = [
            [
                'nom' => 'Gluten',
            ],
            [
                'nom' => 'Lactose',
            ],
            [
                'nom' => 'Arachides',
            ],
            [
                'nom' => 'Fruits à coque',
            ],
        ];

        // Création des allergènes dans la base de données
        foreach ($allergenes as $allergeneData) {
            Allergene::create($allergeneData);
        }
    }
}
