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
            // First, drop the existing status column
            $table->dropColumn('status');
        });

        Schema::table('reservasis', function (Blueprint $table) {
            // Add the new ENUM status column
            $table->enum('status', ['pending', 'confirmed', 'process', 'completed', 'cancelled'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            // Drop the ENUM column
            $table->dropColumn('status');
        });

        Schema::table('reservasis', function (Blueprint $table) {
            // Add back the original string column
            $table->string('status')->default('pending');
        });
    }
};
