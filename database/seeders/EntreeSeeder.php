<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entree;

class EntreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entree::create([
            'nom' => 'Entree 1',
            'description' => 'Description du Entree 1',
            'prix' => 12.99,
            'info_supp' => 'Informations supplémentaires du Entree 1',
        ]);

        Entree::create([
            'nom' => 'Entree 2',
            'description' => 'Description du Entree 2',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Entree 2',
        ]);

        Entree::create([
            'nom' => 'Entree 3',
            'description' => 'Description du Entree 3',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Entree 3',
        ]);

        Entree::create([
            'nom' => 'Entree 4',
            'description' => 'Description du Entree 4',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Entree 4',
        ]);
    }
}
