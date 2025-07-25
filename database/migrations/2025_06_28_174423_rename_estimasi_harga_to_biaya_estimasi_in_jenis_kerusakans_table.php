<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jenis_kerusakans', function (Blueprint $table) {
            $table->renameColumn('estimasi_harga', 'biaya_estimasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_kerusakans', function (Blueprint $table) {
            $table->renameColumn('biaya_estimasi', 'estimasi_harga');
        });
    }
};
