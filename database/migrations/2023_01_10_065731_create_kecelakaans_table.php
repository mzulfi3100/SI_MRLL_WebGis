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
        Schema::create('kecelakaans', function (Blueprint $table) {
            $table->id();
            $table->string('tahunKecelakaan')->nullable();
            $table->string('vatalitasKecelakaan', 50)->nullable();
            $table->string('penyebabKecelakaan', 150)->nullable();
            $table->integer('jumlahKecelakaan')->nullable();
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
        Schema::dropIfExists('kecelakaans');
    }
};
