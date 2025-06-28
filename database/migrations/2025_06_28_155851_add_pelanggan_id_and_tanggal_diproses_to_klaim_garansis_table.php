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
        Schema::table('klaim_garansis', function (Blueprint $table) {
            $table->foreignId('id_pelanggan')->nullable()->constrained('data_pelanggans')->onDelete('cascade');
            $table->timestamp('tanggal_diproses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klaim_garansis', function (Blueprint $table) {
            $table->dropForeign(['id_pelanggan']);
            $table->dropColumn(['id_pelanggan', 'tanggal_diproses']);
        });
    }
};
