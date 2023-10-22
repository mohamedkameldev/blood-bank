<?php

namespace Database\Seeders;

use App\Models\Governorate;
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
        $govs = [
            [ 'name' => 'Cairo'],
            [ 'name' => 'Giza'],
            [ 'name' => 'Alex'],
            [ 'name' => 'Mansoura'],
        ];

        foreach($govs as $gov){
            // Using Query Builder:
            // DB::table('governorates')->insert($gov);

            // Using the Eleqouent ORM:
            Governorate::create($gov);
        }
        
    }
}
