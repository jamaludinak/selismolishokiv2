<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeAlamatLengkapNullableOnReservasis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('alamatLengkap')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('alamatLengkap')->nullable(false)->change();
        });
    }
}
