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
        Schema::create('lalulintas', function (Blueprint $table) {
            $table->id();
            $table->integer('volumeLaluLintas')->nullable();
            $table->integer('kecepatanLaluLintas')->nullable();
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
        Schema::dropIfExists('lalulintas');
    }
};
