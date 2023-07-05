<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::create([
            'date' => 'date',
            'service' => 'midi',
            'creneau' => '12:30',
            'convives' => 2,
            'nom' => 'Muller',
            'prenom' => 'Karl',
            'email' => 'karl.mullr@gmail.com',
            'telephone' => '06 79 29 68 89',
            'informations' => 'Allergique au lactose',
            'regles' => '1',
            'status' => 2
        ]);
    }
}
