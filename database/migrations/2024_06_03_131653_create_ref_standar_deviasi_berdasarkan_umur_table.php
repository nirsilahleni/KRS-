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
        Schema::create('ref_standar_deviasi_berdasarkan_umur', function (Blueprint $table) {
            $table->id();
            $table->integer("umur")->comment("umur dalam bulan");
            $table->decimal("-3sd")->comment("nilai -3 standar deviasi");
            $table->decimal("-2sd")->comment("nilai -2 standar deviasi");
            $table->decimal("-1sd")->comment("nilai -1 standar deviasi");
            $table->decimal("median")->comment("nilai median");
            $table->decimal("1sd")->comment("nilai 1 standar deviasi");
            $table->decimal("2sd")->comment("nilai 2 standar deviasi");
            $table->decimal("3sd")->comment("nilai 3 standar deviasi");
            $table->enum("jenis_kelamin", ["L", "P"])->comment("jenis kelamin");
            $table->enum("type", ["BB", "TB"])->comment("jenis data");
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_standar_bb_berdasarkan_umur');
    }
};
