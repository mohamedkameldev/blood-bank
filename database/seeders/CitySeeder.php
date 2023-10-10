<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cities:
        DB::table('cities')->insert([
            'name' => 'Mansoura',
            'governorate_id' => '4'
        ]);
        DB::table('cities')->insert([
            'name' => 'Tagamo3 5',
            'governorate_id' => '1'
        ]);
        DB::table('cities')->insert([
            'name' => 'Bahari',
            'governorate_id' => '3'
        ]);
        DB::table('cities')->insert([
            'name' => 'alHaram',
            'governorate_id' => '2'
        ]);
    }
}
