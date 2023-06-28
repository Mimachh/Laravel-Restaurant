<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user1 = User::create([
            'name' => 'Karl',
            'email' => 'karl.mullr@gmail.com',
            // 'password' => bcrypt('password'),
            'password' => 'Karl1991!'
        ]);
        $user2 = User::create([
            'name' => 'Kaqsdrlqs',
            'email' => 'karl.muldqsdlr@gmail.com',
            // 'password' => bcrypt('password'),
            'password' => 'Karl1991!'
        ]);
        $user3 = User::create([
            'name' => 'qdsqdsd',
            'email' => 'karl.muddsllr@gmail.com',
            // 'password' => bcrypt('password'),
            'password' => 'Karl1991!'
        ]);


        // Récupérer les rôles avec les ID 1 et 2
        $roles = Role::whereIn('id', [1, 2])->get();

        // Attacher les rôles à l'utilisateur dans la table pivot
        $user1->roles()->attach(1);



        // php artisan db:seed --class=UsersTableSeeder
    }
}
