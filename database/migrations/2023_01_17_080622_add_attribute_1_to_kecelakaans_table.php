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
        Schema::table('kecelakaans', function (Blueprint $table) {
            $table->char('vatalitasKecelakaan', 10)->after('tahunKecelakaan');
            $table->string('penyebabKecelakaan', 20)->after('tahunKecelakaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kecelakaans', function (Blueprint $table) {
            //
        });
    }
};
