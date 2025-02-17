<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PekerjaanSeeder::class,
            ProvinceSeeder::class,
            RekeningSeeder::class,
            VillageSeeder::class,
            DistrictSeeder::class,
            CitySeeder::class,
        ]);
    }
}
