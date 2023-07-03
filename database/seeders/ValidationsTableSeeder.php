<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Validation;

class ValidationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Validation::create([
            'is_online_booking' => 1,
            'is_booking_when_close' => 1,
            'is_contact_when_close' => 1,
            'is_email_confirmation' => 1,
            'is_automatic_validation' => 1,
            'is_add_manual_validation' => 1,
            'manual_limit_validation' => 6,
        ]);
    }
}
