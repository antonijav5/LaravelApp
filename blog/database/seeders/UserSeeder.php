<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Kreiraj nekoliko korisnika sa jedinstvenim email adresama
//        User::factory()->count(10)->create(); // Kreira 10 lažnih korisnika
$users = [
    [
        'name' => 'Marko Marković',
        'email' => 'marko@example.com',
        'password' => bcrypt('password1'), // koristite bcrypt za enkripciju
    ],
    [
        'name' => 'Ana Anić',
        'email' => 'ana@example.com',
        'password' => bcrypt('password2'),
    ],
    [
        'name' => 'Petar Petrović',
        'email' => 'petar@example.com',
        'password' => bcrypt('password3'),
    ],
    [
        'name' => 'Jelena Janković',
        'email' => 'jelena@example.com',
        'password' => bcrypt('password4'),
    ],
    [
        'name' => 'Milica Milić',
        'email' => 'milica@example.com',
        'password' => bcrypt('password5'),
    ],
    [
        'name' => 'Stefan Stefanović',
        'email' => 'stefan@example.com',
        'password' => bcrypt('password6'),
    ],
    [
        'name' => 'Marija Marković',
        'email' => 'marija@example.com',
        'password' => bcrypt('password7'),
    ],
    [
        'name' => 'Vladimir Vasiljević',
        'email' => 'vladimir@example.com',
        'password' => bcrypt('password8'),
    ],
    [
        'name' => 'Tanja Tanović',
        'email' => 'tanja@example.com',
        'password' => bcrypt('password9'),
    ],
    [
        'name' => 'Igor Ilić',
        'email' => 'igor@example.com',
        'password' => bcrypt('password10'),
    ],
];

foreach ($users as $user) {
    User::create($user);
}
    }
}
