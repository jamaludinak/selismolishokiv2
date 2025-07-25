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
        Schema::table('kendaraans', function (Blueprint $table) {
            // Drop the existing status_garansi column
            $table->dropColumn('status_garansi');
            
            // Add the new tanggal_berakhir_garansi column
            $table->date('tanggal_berakhir_garansi')->nullable()->after('tahun_pembelian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kendaraans', function (Blueprint $table) {
            // Drop the new column
            $table->dropColumn('tanggal_berakhir_garansi');
            
            // Add back the old column
            $table->enum('status_garansi', ['aktif', 'tidak_aktif'])->default('tidak_aktif')->after('tahun_pembelian');
        });
    }
};
