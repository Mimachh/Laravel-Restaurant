<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fermeture;
class FermetureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fermeture::create([
            'date_debut' => '2023-07-01',
            'date_fin' => '2023-07-05',
            'raison' => 'Fermeture pour rénovation',
            'status' => 1,
        ]);
    }
}
