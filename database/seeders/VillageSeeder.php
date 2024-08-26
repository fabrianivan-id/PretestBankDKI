<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    public function run()
    {
        // Assuming District IDs are 1 for 'Central Jakarta' and 2 for 'South Bandung'
        Village::create(['name' => 'Kebon Kacang', 'district_id' => 1]);
        Village::create(['name' => 'Cihampelas', 'district_id' => 2]);
        Village::create(['name' => 'Gajahmungkur', 'district_id' => 3]);
        Village::create(['name' => 'Rungkut', 'district_id' => 4]);
    }
}
