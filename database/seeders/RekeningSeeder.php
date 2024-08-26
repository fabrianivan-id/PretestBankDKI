<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekeningSeeder extends Seeder
{
    public function run()
    {
        DB::table('rekening')->insert([
            [
                'nama_ktp' => 'John Doe',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'pekerjaan_id' => 1, // Assuming 1 is the ID for 'Pegawai Negeri Sipil'
                'province_id' => 1,  // Assuming 1 is the ID for 'DKI Jakarta'
                'city_id' => 1,   // Assuming 1 is the ID for a regency in DKI Jakarta
                'district_id' => 1,  // Assuming 1 is the ID for a district in DKI Jakarta
                'village_id' => 1,   // Assuming 1 is the ID for a village in DKI Jakarta
                'nama_jalan' => 'Jl. Merdeka',
                'rt' => '01',
                'rw' => '02',
                'nominal_setor' => 1000000,
                'status' => 'Menunggu Approval',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_ktp' => 'Jane Smith',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1992-05-15',
                'jenis_kelamin' => 'Wanita',
                'pekerjaan_id' => 2, // Assuming 2 is the ID for 'Wiraswasta'
                'province_id' => 2,  // Assuming 2 is the ID for 'Jawa Barat'
                'city_id' => 2,   // Assuming 2 is the ID for a regency in Jawa Barat
                'district_id' => 2,  // Assuming 2 is the ID for a district in Jawa Barat
                'village_id' => 2,   // Assuming 2 is the ID for a village in Jawa Barat
                'nama_jalan' => 'Jl. Soekarno-Hatta',
                'rt' => '03',
                'rw' => '04',
                'nominal_setor' => 2000000,
                'status' => 'Menunggu Approval',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
