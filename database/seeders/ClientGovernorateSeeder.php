<?php

namespace Database\Seeders;

use App\Models\ClientGovernorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientGovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ClientGovernorates = [
            ['client_id' => 1, 'governorate_id' => 1],
            ['client_id' => 1, 'governorate_id' => 2],
            ['client_id' => 2, 'governorate_id' => 3],
            ['client_id' => 2, 'governorate_id' => 4],
            ['client_id' => 3, 'governorate_id' => 1],
            ['client_id' => 3, 'governorate_id' => 3],
            ['client_id' => 4, 'governorate_id' => 2],
            ['client_id' => 4, 'governorate_id' => 4],
        ];

        foreach($ClientGovernorates as $ClientGovernorate){
            ClientGovernorate::create($ClientGovernorate);
        }
    }
}
