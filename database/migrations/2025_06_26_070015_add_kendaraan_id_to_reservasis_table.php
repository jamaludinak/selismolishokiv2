<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->unsignedBigInteger('kendaraan_id')->nullable()->after('latitude');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropForeign(['kendaraan_id']);
            $table->dropColumn('kendaraan_id');
        });
    }
};
