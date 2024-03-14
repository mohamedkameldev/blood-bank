<?php

namespace Database\Seeders;

use App\Models\BloodTypeClient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodTypeClients = [
            ['client_id' => 1, 'blood_type_id' => 1],
            ['client_id' => 1, 'blood_type_id' => 2],
            ['client_id' => 2, 'blood_type_id' => 3],
            ['client_id' => 2, 'blood_type_id' => 4],
            ['client_id' => 3, 'blood_type_id' => 5],
            ['client_id' => 3, 'blood_type_id' => 6],
            ['client_id' => 4, 'blood_type_id' => 7],
            ['client_id' => 4, 'blood_type_id' => 8],
        ];


        foreach($bloodTypeClients as $bloodTypeClient){
            BloodTypeClient::create($bloodTypeClient);
        }
    }
}
