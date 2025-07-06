<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
        }
        

     if (!User::where('email', 'supervisor@example.com')->exists()) {
            User::create([
                'name' => 'Supervisor',
                'email' => 'supervisor@example.com',
                'password' => Hash::make('password'),
                'role' => 'supervisor'
            ]);
        }

    }
}
