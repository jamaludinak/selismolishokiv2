<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_pelanggan_id');
            $table->string('merk');
            $table->enum('jenis_kendaraan', ['sepeda_listrik', 'motor_listrik']);
            $table->string('tipe')->nullable();
            $table->string('nomor_rangka')->nullable();
            $table->year('tahun_pembelian');
            $table->timestamps();

            $table->foreign('data_pelanggan_id')->references('id')->on('data_pelanggans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
}; 