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
        Schema::table('jalans', function (Blueprint $table) {
            $table->string('tipeJalan', 50)->after('namaJalan');;
            $table->float('panjangJalan', 4)->after('namaJalan');
            $table->float('lebarJalan', 4)->after('namaJalan');
            $table->float('volumeJalan', 4)->after('namaJalan');
            $table->string('hambatanSamping', 15)->after('kapasitasJalan'); 
            $table->char('kondisiJalan', 10)->after('kapasitasJalan');
            $table->char('tingkatPelayananJalan', 1)->after('kapasitasJalan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jalans', function (Blueprint $table) {
            //
        });
    }
};
