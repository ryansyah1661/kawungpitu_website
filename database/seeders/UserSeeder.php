<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Kawungpitu',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Kontributor
        User::updateOrCreate(
            ['email' => 'kontributor@gmail.com'],
            [
                'name' => 'Kontributor Kawungpitu',
                'password' => Hash::make('password123'),
                'role' => 'contributor',
            ]
        );
    }
}
