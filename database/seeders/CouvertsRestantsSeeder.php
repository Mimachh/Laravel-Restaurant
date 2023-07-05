<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Couvertsrestants;
class CouvertsRestantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Couvertsrestants::create([
            'nom' => 'PM+06-07-2023',
            'couverts_restants' => 5,
        ]);
    }
}
