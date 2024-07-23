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
            $table->foreignUuid('pendataan_kia_id')->constrained('pendataan_kia')->restrictOnDelete()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendampingan_ibu_hamil', function (Blueprint $table) {
            $table->dropForeign(['pendataan_kia_id']);
            $table->dropColumn('pendataan_kia_id');
        });
    }
};
