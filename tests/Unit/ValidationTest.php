<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testValidInput()
    {
        $response = $this->post('/rekening', [
            'nama_ktp' => 'John Doe',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan_id' => 1,
            'province_id' => 1,
            'city_id' => 1,
            'district_id' => 1,
            'village_id' => 1,
            'nama_jalan' => 'Jl. Merdeka',
            'rt' => '01',
            'rw' => '02',
            'nominal_setor' => 1000000,
        ]);

        $response->assertStatus(302); // Redirect after success
        $this->assertDatabaseHas('rekening', [
            'nama_ktp' => 'John Doe',
            'tempat_lahir' => 'Jakarta',
        ]);
    }

    public function testInvalidInput()
    {
        $response = $this->post('/rekening', [
            'nama_ktp' => 'John123',
            'tanggal_lahir' => 'invalid-date',
            'nominal_setor' => 'invalid-amount',
        ]);

        $response->assertSessionHasErrors([
            'nama_ktp' => 'The nama ktp format is invalid.',
            'tanggal_lahir' => 'The tanggal lahir is not a valid date.',
            'nominal_setor' => 'The nominal setor must be a number.',
        ]);
    }
}
