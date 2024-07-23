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
        Schema::create('pendataan_kia', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kepala_keluarga_id')->constrained('kepala_keluarga')->restrictOnDelete();
            $table->foreignUuid('kepala_keluarga_anggota_id')->constrained('kepala_keluarga_anggota')->restrictOnDelete();
            $table->foreignId('periode_id')->constrained('ref_periode')->restrictOnDelete();
            $table->string('nomor_kia', 16)->unique();
            $table->date('tanggal_perkiraan_lahir');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pendataan_kia');
    }
};
