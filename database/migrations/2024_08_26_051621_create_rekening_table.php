<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekening', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ktp')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Wanita']);
            $table->foreignId('pekerjaan_id')->constrained('pekerjaan');
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('village_id')->constrained('villages');
            $table->text('nama_jalan');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->decimal('nominal_setor', 15, 2);
            $table->enum('status', ['Menunggu Approval', 'Disetujui'])->default('Menunggu Approval');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening');
    }
};
