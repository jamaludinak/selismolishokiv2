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
        Schema::table('reservasis', function (Blueprint $table) {
            // Cek apakah kolom tanggal_berakhir_garansi sudah ada
            if (!Schema::hasColumn('reservasis', 'tanggal_berakhir_garansi')) {
                $table->date('tanggal_berakhir_garansi')->nullable()->after('biaya_perjalanan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            // Hapus kolom tanggal_berakhir_garansi jika ada
            if (Schema::hasColumn('reservasis', 'tanggal_berakhir_garansi')) {
                $table->dropColumn('tanggal_berakhir_garansi');
            }
        });
    }
};
