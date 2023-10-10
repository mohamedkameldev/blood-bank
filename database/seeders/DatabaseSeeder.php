<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // In seeder, you can add values:  
            // 1- manually(using Model or query string),
            // 2- you can use factory(inside the Database Seeder or in specific class)
        $this->call([
            GovernorateSeeder::class, 
            CitySeeder::class, 
            BloodTypeSeeder::class,
            ClientSeeder::class, 
            CategorySeeder::class, 
            PostSeeder::class,
            SettingSeeder::class
        ]);
         

    }
}
