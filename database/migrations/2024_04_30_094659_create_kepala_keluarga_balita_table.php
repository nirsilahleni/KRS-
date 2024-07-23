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
        Schema::create('balita', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kepala_keluarga_id')->constrained('kepala_keluarga')->restrictOnDelete();
            $table->string('nik', 16)->unique()->nullable();
            $table->string('nama_lengkap', 200);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir')->nullable();
            $table->integer('usia')->comment('Usia dalam minggu');
            $table->foreignId('periode_id')->constrained('ref_periode')->restrictOnDelete()->cascadeOnUpdate();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->decimal('berat_badan', 5, 2)->comment('Berat badan dalam kg');
            $table->decimal('tinggi_badan', 5, 2)->comment('Tinggi badan dalam cm');
            $table->enum('perlu_pendampingan', ['Y', 'N'])->default('N')->comment('Y: Ya, N: Tidak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balita');
    }
};
