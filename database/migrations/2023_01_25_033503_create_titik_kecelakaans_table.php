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
        Schema::create('titik_kecelakaans', function (Blueprint $table) {
            $table->id();
            $table->string('lokasiKecelakaan', 100);
            $table->string('geoJsonKecelakaan', 100);
            $table->string('deskripsiKecelakaan', 100);
            $table->foreignId('jalanId')->references('jalanId')->on('jalans_kecamatans');
            $table->foreignId('kecamatanId')->references('kecamatanId')->on('jalans_kecamatans');
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
        Schema::dropIfExists('titik_kecelakaans');
    }
};
