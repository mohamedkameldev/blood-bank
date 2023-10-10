<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Blood Types: 
        DB::table('blood_types')->insert([
            'name' => 'A+'
        ]);
        DB::table('blood_types')->insert([
            'name' => 'A-'
        ]);
        DB::table('blood_types')->insert([
            'name' => 'B+'
        ]);
        DB::table('blood_types')->insert([
            'name' => 'B+-'
        ]);
        DB::table('blood_types')->insert([
            'name' => 'O+'
        ]);
        DB::table('blood_types')->insert([
            'name' => 'O+-'
        ]);
        DB::table('blood_types')->insert([
            'name' => 'AB+'
        ]);
        DB::table('blood_types')->insert([
            'name' => 'AB-'
        ]);
    }
}
