<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CouvertsRestants;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlatsTableSeeder::class);
        $this->call(AllergeneSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(FormuleSeeder::class);
        $this->call(VinSeeder::class);
        $this->call(EntreeSeeder::class);
        $this->call(DessertSeeder::class);
        $this->call(AlcoolSeeder::class);
        $this->call(SoftSeeder::class);
        $this->call(JourSeeder::class);
        $this->call(FermetureSeeder::class);
        $this->call(ValidationsTableSeeder::class);
        $this->call(CouvertsRestantsSeeder::class);
        $this->call(ReservationSeeder::class);
    }
}
