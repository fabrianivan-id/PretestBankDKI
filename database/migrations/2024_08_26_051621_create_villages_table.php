<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('villages');
    }
}
