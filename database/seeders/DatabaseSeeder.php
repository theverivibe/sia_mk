<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed all data in proper order
        $this->call([
            UserSeeder::class,           // Users dengan roles
            AssetCategorySeeder::class,  // Asset categories
            AssetSeeder::class,          // Assets dengan assignments
            ComplaintSeeder::class,      // Complaints dengan realistic data
        ]);
    }
}
