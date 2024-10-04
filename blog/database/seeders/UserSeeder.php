<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Kreiraj nekoliko korisnika sa jedinstvenim email adresama
        User::factory()->count(10)->create(); // Kreira 10 lažnih korisnika

        // Dodaj jednog specifičnog korisnika
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => fake()->unique()->safeEmail(), // Generiše jedinstvenu email adresu
        //     'password' => bcrypt('password'), // Šifruj lozinku
        // ]);
    }
}
