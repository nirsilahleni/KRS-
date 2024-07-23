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
        Schema::create('monitoring_krs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // constraint
            $table->foreignUuid('kepala_keluarga_id')->constrained('kepala_keluarga')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('tempat_buang_air_id')->constrained('ref_tempat_buang_air')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('sumber_air_minum_id')->constrained('ref_sumber_air')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('kb_modern_id')->constrained('ref_jenis_kb')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('periode_id')->constrained('ref_periode')->restrictOnDelete()->cascadeOnUpdate();

            $table->enum('punya_baduta', ['ya', 'tidak', 'belum-ditentukan'])->default('belum-ditentukan');
            $table->enum('asi_eksklusif', ['ya', 'tidak', 'belum-ditentukan'])->default('belum-ditentukan');
            $table->enum('punya_balita', ['ya', 'tidak', 'belum-ditentukan'])->default('belum-ditentukan');
            $table->enum('status_pasangan_usia_subur', ['ya', 'tidak', 'belum-ditentukan'])->default('belum-ditentukan')->comment('kategori pasangan usia subur dari usia 15 ke 49');
            $table->enum('pus_hamil', ['ya', 'tidak', 'belum-ditentukan'])->default('belum-ditentukan');
            $table->enum('ada_ibu_hamil', ['ya', 'tidak', 'belum-ditentukan'])->default('belum-ditentukan');
            $table->integer("tingkat_kesejahteraan")->nullable();
            $table->enum('terlalu_muda', ['ya', 'tidak', 'tidak-berlaku', 'belum-ditentukan'])->default('belum-ditentukan')->comment('find anggota keluarga type istri usia < 20');
            $table->enum('terlalu_tua', ['ya', 'tidak', 'tidak-berlaku', 'belum-ditentukan'])->default('belum-ditentukan')->comment('istri 35-40 tahun');
            $table->enum('terlalu_dekat', ['ya', 'tidak', 'tidak-berlaku', 'belum-ditentukan'])->default('belum-ditentukan')->comment('usia suami istri selisih < 2 tahun');
            $table->enum('terlalu_banyak_anak', ['ya', 'tidak', 'tidak-berlaku', 'belum-ditentukan'])->default('belum-ditentukan')->comment('anak >= 8');
            $table->enum('ada_anggota_keluarga_menikah_tahun_ini', ['ya', 'tidak', 'belum-ditentukan'])->default('belum-ditentukan');
            $table->enum('status_krs', ['beresiko', 'tidak beresiko', 'belum-ditentukan'])->default('belum-ditentukan');
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
        Schema::dropIfExists('monitoring_krs');
    }
};
