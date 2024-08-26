<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run()
    {
        // Insert districts directly using DB facade
        DB::table('districts')->insert([
            ['name' => 'Central Jakarta', 'city_id' => 1],
            ['name' => 'South Bandung', 'city_id' => 2],
            ['name' => 'East Semarang', 'city_id' => 3],
            ['name' => 'West Surabaya', 'city_id' => 4],
        ]);
    }
}
