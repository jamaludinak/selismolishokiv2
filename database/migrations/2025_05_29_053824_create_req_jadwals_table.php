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
        Schema::create('req_jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idReservasi')->constrained('reservasis')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktuMulai');
            $table->time('waktuSelesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('req_jadwals');
    }
};
