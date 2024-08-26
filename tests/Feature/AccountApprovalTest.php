<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormSubmissionTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testFormSubmission()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/rekening/create')
                    ->type('nama_ktp', 'John Doe')
                    ->type('tempat_lahir', 'Jakarta')
                    ->type('tanggal_lahir', '1990-01-01')
                    ->select('jenis_kelamin', 'Laki-laki')
                    ->select('pekerjaan_id', 1)
                    ->select('province_id', 1)
                    ->select('city_id', 1)
                    ->select('district_id', 1)
                    ->select('village_id', 1)
                    ->type('nama_jalan', 'Jl. Merdeka')
                    ->type('rt', '01')
                    ->type('rw', '02')
                    ->type('nominal_setor', '1000000')
                    ->press('Simpan')
                    ->assertSee('Pengajuan rekening berhasil disimpan');
        });
    }
}
