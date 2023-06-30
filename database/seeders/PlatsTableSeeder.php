<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plat;

class PlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plat::create([
            'nom' => 'Plat 1',
            'description' => 'Description du plat 1',
            'prix' => 12.99,
            'info_supp' => 'Informations supplémentaires du plat 1',
            'status' => '1',
        ]);

        Plat::create([
            'nom' => 'Plat 2',
            'description' => 'Description du plat 2',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du plat 2',
            'status' => '1',
        ]);

        Plat::create([
            'nom' => 'Plat 3',
            'description' => 'Description du plat 3',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du plat 3',
            'status' => '1',
        ]);

        Plat::create([
            'nom' => 'Plat 4',
            'description' => 'Description du plat 4',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du plat 4',
        ]);
    }
}
