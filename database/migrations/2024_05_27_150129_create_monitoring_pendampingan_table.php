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
        Schema::create('monitoring_pendampingan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('monitoring_id')->constrained('monitoring_krs')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('pendampingan_id')->constrained('ref_jenis_pendampingan')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_pendampingan');
    }
};
