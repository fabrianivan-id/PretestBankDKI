<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pekerjaan')->insert([
            ['nama_pekerjaan' => 'Pegawai Negeri'],
            ['nama_pekerjaan' => 'Wiraswasta'],
            ['nama_pekerjaan' => 'Pelajar'],
            ['nama_pekerjaan' => 'Ibu Rumah Tangga'],
            ['nama_pekerjaan' => 'Lainnya'],
        ]);
    }
}
