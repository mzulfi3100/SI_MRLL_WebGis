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
        Schema::create('kemacetans', function (Blueprint $table) {
            $table->id();
            $table->float('volumeLaluLintas');
            $table->string('waktuLaluLintas');
            $table->float('tingkatPelayananJalan');
            $table->foreignId('idJalan')->references('id')->on('jalans');
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
        Schema::dropIfExists('kemacetans');
    }
};
