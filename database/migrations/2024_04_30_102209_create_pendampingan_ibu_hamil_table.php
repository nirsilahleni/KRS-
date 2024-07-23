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
        Schema::create('pendampingan_ibu_hamil', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('posyandu_id')->constrained('posyandu')->restrictOnDelete();
            $table->foreignId('periode_id')->constrained('ref_periode')->restrictOnDelete();
            $table->date('tanggal_pendampingan');
            $table->string('usia_kehamilan', 100)->nullable()->comment('Usia kehamilan dalam satuan bulan');
            $table->enum('status_kehamilan', ['N', 'Risti', 'KEK'])->nullable()->comment('N = Normal, Risti = Resiko Tinggi, KEK = Kekurangan Energi Kronis');
            $table->enum('pemeriksaan_kehamilan', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->enum('pemeriksaan_nifas', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->enum('konsumsi_pil_fe', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->enum('konseling_gizi', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->enum('kunjungan_rumah', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->enum('akses_air_bersih', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->enum('ada_jamban', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->enum('jaminan_kesehatan', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
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
        Schema::dropIfExists('pendampingan_ibu_hamil');
    }
};
