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
            'date_debut' => '01-07-2023',
            'date_fin' => '09-07-2023',
            'raison' => 'Fermeture pour rénovation',
            'status' => 1,
        ]);
    }
}
