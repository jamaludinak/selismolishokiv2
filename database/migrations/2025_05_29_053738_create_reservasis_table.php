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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('servis');
            $table->string('namaLengkap');
            $table->text('alamatLengkap');
            $table->string('noTelp');
            $table->foreignId('idJenisKerusakan')->constrained('jenis_kerusakans')->onDelete('cascade');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('video')->nullable();
            $table->string('noResi')->unique();
            $table->string('status')->default('pending');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->unsignedBigInteger('total_harga')->nullable();
            $table->unsignedBigInteger('biaya_perjalanan')->nullable();
            $table->date('tanggal_berakhir_garansi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
