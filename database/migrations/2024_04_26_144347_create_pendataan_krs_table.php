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
        Schema::create('pendataan_krs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kepala_keluarga_id')->constrained('kepala_keluarga');
            $table->foreignId('periode_id')->constrained('ref_periode');
            $table->foreignId('sumber_air_id')->nullable()->constrained('ref_sumber_air');
            $table->foreignId('tempat_buang_air_id')->nullable()->constrained('ref_tempat_buang_air');
            $table->enum('ada_balita', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Jika ada, mengambil rekap data anggota keluarga yang berumur 0-5 tahun');
            $table->enum('ada_baduta', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Mengambil rekap data anggota keluarga yang berumur 0-23 bulan');
            $table->enum('ada_bumil', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak');
            $table->integer('usia_bumil')->nullable()->comment('Usia kehamilan dalam minggu, diisi jika ada bumil');
            $table->enum('ada_pus', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. PUS : Pasangan Usia Subur, mengambil rekap data anggota keluarga yang berumur 15-49 tahun');
            $table->enum('ada_pus_hamil', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. PUS : Pasangan Usia Subur Hamil, mengambil rekap data anggota keluarga yang berumur 15-49 tahun');
            $table->enum('asi_eksklusif', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Asi Eksklusif : Jika ya, maka mengambil rekap data anggota keluarga yang memiliki bayi berumur 0-6 bulan');
            $table->enum('terlalu_muda', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Jika ya, maka mengambil rekap data anggota keluarga yang berumur 10-24 tahun');
            $table->enum('terlalu_tua', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Jika ya, maka mengambil rekap data anggota keluarga yang berumur 60 tahun ke atas');
            $table->enum('terlalu_dekat', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Jika ya, maka mengambil rekap data anggota keluarga yang memiliki jarak usia antar anak keluarga kurang dari 2 tahun');
            $table->enum('terlalu_banyak', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Jika ya, maka mengambil rekap data anggota keluarga yang memiliki anak lebih dari 3 orang');
            $table->enum('ikut_kb_modern', ['Y', 'T'])->nullable()->comment('Y: Ya, T: Tidak. Jika ya, maka mengambil rekap data anggota keluarga yang menggunakan KB modern');
            $table->enum('status_krs', ['beresiko', 'tidak_beresiko'])->nullable()->comment('beresiko: Jika ada salah satu dari kriteria di atas, tidak_beresiko: Jika tidak ada satupun dari kriteria di atas');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pendataan_krs');
    }
};
