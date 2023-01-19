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
        Schema::create('jalans', function (Blueprint $table) {
            $table->id();
            $table->string('namaJalan');
            $table->string('tipeJalan', 50)->nullable();
            $table->double('panjangJalan', 10, 2)->nullable();
            $table->double('lebarJalan', 10, 2)->nullable();
            $table->double('kapasitasJalan', 10, 2)->nullable();
            $table->string('hambatanSamping', 15)->nullable(); 
            $table->string('kondisiJalan', 10)->nullable();
            $table->char('tingkatPelayananJalan', 1)->nullable();
            $table->text('geoJsonJalan')->nullable();
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
        Schema::dropIfExists('jalans');
    }
};
