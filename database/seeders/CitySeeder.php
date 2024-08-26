<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        // Assuming Province IDs are 1 for 'DKI Jakarta' and 2 for 'Jawa Barat'
        City::create(['name' => 'Jakarta', 'province_id' => 1]);
        City::create(['name' => 'Bandung', 'province_id' => 2]);
        City::create(['name' => 'Semarang', 'province_id' => 3]);
        City::create(['name' => 'Surabaya', 'province_id' => 4]);
    }
}
