<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Staff IT User
        User::create([
            'name' => 'Admin IT',
            'email' => 'admin@company.com',
            'password' => Hash::make('password'),
            'role' => 'staff_it',
            'email_verified_at' => now(),
        ]);

        // Create Principal User
        User::create([
            'name' => 'Principal Manager',
            'email' => 'principal@company.com',
            'password' => Hash::make('password'),
            'role' => 'principal',
            'email_verified_at' => now(),
        ]);

        // Create Regular Users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@company.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@company.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Bob Wilson',
            'email' => 'bob@company.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
