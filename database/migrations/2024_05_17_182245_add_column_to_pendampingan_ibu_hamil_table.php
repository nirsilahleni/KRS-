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
        Schema::table('pendampingan_ibu_hamil', function (Blueprint $table) {
            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])->after('usia_kehamilan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendampingan_ibu_hamil', function (Blueprint $table) {
            $table->dropColumn('bulan');
        });
    }
};
