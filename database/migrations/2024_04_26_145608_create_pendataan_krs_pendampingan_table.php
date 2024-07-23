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
        Schema::create('pendataan_krs_pendampingan', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('pendataan_krs_id')->constrained('pendataan_krs')->restrictOnDelete();
            $table->foreignId('jenis_pendampingan_id')->constrained('ref_jenis_pendampingan')->restrictOnDelete();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendataan_krs_pendampingan');
    }
};
