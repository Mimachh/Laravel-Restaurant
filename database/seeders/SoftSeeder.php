<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Soft;
class SoftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Soft::create([
            'nom' => 'Soft 1',
            'prix' => 12.99,
            'info_supp' => 'Informations supplémentaires du Soft 1',
            'status' => '1',
        ]);

        Soft::create([
            'nom' => 'Soft 2',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Soft 2',
            'status' => '1',
        ]);

        Soft::create([
            'nom' => 'Soft 3',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Soft 3',
        ]);

        Soft::create([
            'nom' => 'Soft 4',
            'prix' => 15.99,
            'info_supp' => 'Informations supplémentaires du Soft 4',
        ]);
    }
}
