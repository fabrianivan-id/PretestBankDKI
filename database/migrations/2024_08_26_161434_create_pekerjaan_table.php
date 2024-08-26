<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjaanTable extends Migration
{
    public function up()
    {
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama_pekerjaan'); // Name of the job
            $table->timestamps(); // created_at and updated_at fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('pekerjaan');
    }
}
