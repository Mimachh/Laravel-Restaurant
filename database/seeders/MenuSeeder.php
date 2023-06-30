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
            'nom' => 'menu 1',
            'description' => 'Description du menu 1',
            'info_supp' => 'Informations supplémentaires du menu 1',
            'status' => '1',
        ]);

        Menu::create([
            'nom' => 'menu 2',
            'description' => 'Description du menu 2',
            'info_supp' => 'Informations supplémentaires du menu 2',
        ]);

        Menu::create([
            'nom' => 'menu 3',
            'description' => 'Description du menu 3',
            'info_supp' => 'Informations supplémentaires du menu 3',
            'status' => '1',
        ]);

        Menu::create([
            'nom' => 'menu 4',
            'description' => 'Description du menu 4',
            'info_supp' => 'Informations supplémentaires du menu 4',
        ]);
    }
}
