<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pekerjaan')->insert([
            ['name' => 'Pegawai Negeri'],
            ['name' => 'Wiraswasta'],
            ['name' => 'Pelajar'],
            ['name' => 'Ibu Rumah Tangga'],
            ['name' => 'Lainnya'],
        ]);
    }
}
