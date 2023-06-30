<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vin;
class VinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vin::create([
            'nom' => 'Vin 1',
            'description' => 'Description du vin 1',
            'prix' => 12.99,
            'annee' => '1996',
            'status' => '1',
        ]);

        Vin::create([
            'nom' => 'Vin 2',
            'description' => 'Description du vin 1',
            'prix' => 12.99,
            'annee' => '1996',
        ]);

        Vin::create([
            'nom' => 'Vin 3',
            'description' => 'Description du vin 1',
            'prix' => 12.99,
            'annee' => '1996',
            'status' => '1',
        ]);

        Vin::create([
            'nom' => 'Vin 4',
            'description' => 'Description du vin 1',
            'prix' => 12.99,
            'annee' => '1996',
        ]);
    }
}
