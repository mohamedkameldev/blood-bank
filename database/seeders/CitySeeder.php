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
        $cities = [
            [ 'name' => 'Mansoura', 'governorate_id' => '4'],
            [ 'name' => 'Tagamo3 5', 'governorate_id' => '1'],
            [ 'name' => 'Bahari', 'governorate_id' => '3'],
            [ 'name' => 'alHaram', 'governorate_id' => '2'],
        ];
        
        foreach($cities as $city)
        {
            DB::table('cities')->insert($city);
        }
    }
}
