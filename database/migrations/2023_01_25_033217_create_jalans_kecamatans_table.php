<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jalans_kecamatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jalanId')->references('id')->on('jalans');
            $table->foreignId('kecamatanId')->references('id')->on('kecamatans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jalans_kecamatans');
    }
};
