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
        Schema::table('kader', function (Blueprint $table) {
            $table->foreignUuid('posyandu_id')->constrained('posyandu')->onUpdate('cascade')->onDelete('restrict')->after('kelurahan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kader', function (Blueprint $table) {
            $table->dropForeign(['posyandu_id']);
            $table->dropColumn('posyandu_id');
        });
    }
};
