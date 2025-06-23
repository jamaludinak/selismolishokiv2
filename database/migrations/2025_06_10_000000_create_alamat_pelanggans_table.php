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
        Schema::create('alamat_pelanggans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_pelanggan_id');
            $table->text('alamat');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamps();

            $table->foreign('data_pelanggan_id')->references('id')->on('data_pelanggans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat_pelanggans');
    }
}; 