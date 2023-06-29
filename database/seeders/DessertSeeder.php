<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dessert;
class DessertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dessert::create([
            'nom' => 'Dessert 1',
            'description' => 'Description du Dessert 1',
            'prix' => 12.99,
            'info_supp' => 'Informations supplémentaires du Dessert 1',
        ]);

        Dessert::create([
            'nom' => 'Dessert 2',
            'description' => 'Description du Dessert 2',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Dessert 2',
        ]);

        Dessert::create([
            'nom' => 'Dessert 3',
            'description' => 'Description du Dessert 3',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Dessert 3',
        ]);

        Dessert::create([
            'nom' => 'Dessert 4',
            'description' => 'Description du Dessert 4',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Dessert 4',
        ]);
    }
}
