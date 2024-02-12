<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Mohamed Kamel', 
                'phone' => '01092210040', 
                'email' => 'mokammel0000@gmail.com', 
                'password' => bcrypt('123'), 
                'api_token' => Str::random(60), 
                'd_o_b' => '2002-06-15',
                'last_donation_date' => '2022/06/15',
                'city_id' => '1', 
                'blood_type_id' => 1
            ],
            [
                'name' => 'Mona Gebril', 
                'phone' => '01026714053', 
                'email' => 'mona@gmail.com', 
                'password' => bcrypt('123'), 
                'api_token' => Str::random(60), 
                'd_o_b' => '2000-12-01',
                'last_donation_date' => '2000/03/09',
                'city_id' => '2', 
                'blood_type_id' => 3
            ],
            [
                'name' => 'Heba Albadrdawy', 
                'phone' => '01081814040', 
                'email' => 'heba@gmail.com', 
                'password' => bcrypt('123'), 
                'api_token' => Str::random(60), 
                'd_o_b' => '1994-05-29',
                'last_donation_date' => '2023/10/12',
                'city_id' => '3', 
                'blood_type_id' => 5
            ], 
            [
                'name' => 'Emad Magdy', 
                'phone' => '01093959520', 
                'email' => 'emadmagdy60629355@gmail.com', 
                'password' => bcrypt('123'), 
                'api_token' => Str::random(60), 
                'd_o_b' => '2002-08-10',
                'last_donation_date' => '2022/08/10',
                'city_id' => '4', 
                'blood_type_id' => 7
            ]
        ];
        
        foreach($clients as $client){
            Client::create($client);
        }
    }
}
