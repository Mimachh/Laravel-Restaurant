<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alcool;
class AlcoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alcool::create([
            'nom' => 'Alcool 1',
            'prix' => 12.99,
            'info_supp' => 'Informations supplémentaires du Alcool 1',
        ]);

        Alcool::create([
            'nom' => 'Alcool 2',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Alcool 2',
        ]);

        Alcool::create([
            'nom' => 'Alcool 3',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Alcool 3',
        ]);

        Alcool::create([
            'nom' => 'Alcool 4',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Alcool 4',
        ]);
    }

}
