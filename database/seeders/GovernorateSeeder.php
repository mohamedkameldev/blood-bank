<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Using the Eleqouent ORM:
        // Governorate::create([
        //     'name' => 'Mansoura',
        //     // In this way, we added values using Model, then timestamps will be added automatically...
        // ]);
        //------------------------------------------------------------------------------------------------------

        // Using Query Builder: 
        // Governorates: 
        DB::table('governorates')->insert([
            'name' => 'Cairo'
        ]);
        DB::table('governorates')->insert([
            'name' => 'Giza'
        ]);
        DB::table('governorates')->insert([
            'name' => 'Alex'
        ]);
        DB::table('governorates')->insert([
            'name' => 'Mansoura'
        ]);
    }
}
