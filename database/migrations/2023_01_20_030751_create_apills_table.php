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
        Schema::create('apills', function (Blueprint $table) {
            $table->id();
            $table->string('namaSimpang', 100);
            $table->string('terkoneksiATCS', 15);
            $table->text('geoJsonApill');
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
        Schema::dropIfExists('apills');
    }
};
