<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'nom' => 'Plat 1',
            'description' => 'Description du plat 1',
            'info_supp' => 'Informations supplémentaires du plat 1',
        ]);

        Menu::create([
            'nom' => 'Plat 2',
            'description' => 'Description du plat 2',
            'info_supp' => 'Informations supplémentaires du plat 2',
        ]);

        Menu::create([
            'nom' => 'Plat 3',
            'description' => 'Description du plat 3',
            'info_supp' => 'Informations supplémentaires du plat 3',
        ]);

        Menu::create([
            'nom' => 'Plat 4',
            'description' => 'Description du plat 4',
            'info_supp' => 'Informations supplémentaires du plat 4',
        ]);
    }
}
