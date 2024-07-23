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
        Schema::create('kepala_keluarga', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_kk', 50);
            $table->string('nik', 16);
            $table->string('nama_lengkap', 200);
            $table->string('provinsi', 100)->default('JAWA TIMUR');
            $table->string('kabupaten', 100)->default('BLITAR');
            $table->foreignId('kecamatan_id')->constrained('ref_kecamatan');
            $table->foreignId('kelurahan_id')->constrained('ref_kelurahan');
            $table->foreignId('status_keluarga_id')->constrained('ref_status_keluarga');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('alamat', 200);
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
        Schema::dropIfExists('kepala_keluarga');
    }
};
