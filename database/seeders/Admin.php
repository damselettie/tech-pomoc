<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // <--- tutaj import modelu User

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('twoje_haslo'),
            'is_admin' => true, // jeśli masz takie pole
        ]);
    }
}
