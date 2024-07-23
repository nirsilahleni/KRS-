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
        Schema::create('kepala_keluarga_anggota', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kepala_keluarga_id')->constrained('kepala_keluarga')->restrictOnDelete();
            $table->foreignId('status_hubungan_id')->constrained('ref_status_hubungan');
            $table->string('nik', 16);
            $table->string('nama_lengkap', 200);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->foreignId('jenjang_pendidikan_id')->nullable(true)->constrained('ref_jenjang_pendidikan');
            $table->string('pekerjaan', 100)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
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
        Schema::dropIfExists('kepala_keluarga_anggota');
    }
};
