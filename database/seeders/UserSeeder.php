<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <--- TO DODAĆ
use Illuminate\Support\Facades\Hash; // <--- I TO

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jan Sprzątacz',
            'email' => 'sprzatacz@example.com',
            'password' => Hash::make('password'),
            'role' => 'sprzątacz',
        ]);

        User::create([
            'name' => 'Anna Dyrektor',
            'email' => 'dyrektor@example.com',
            'password' => Hash::make('password'),
            'role' => 'dyrektor',
        ]);

        User::create([
            'name' => 'Piotr Informatyk',
            'email' => 'informatyk@example.com',
            'password' => Hash::make('password'),
            'role' => 'informatyk',
        ]);
    }
}
