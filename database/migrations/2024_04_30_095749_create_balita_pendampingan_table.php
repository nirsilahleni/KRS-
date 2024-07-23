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
        Schema::create('pendampingan_balita', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('balita_id')->constrained('balita')->restrictOnDelete();
            $table->foreignId('periode_id')->constrained('ref_periode')->restrictOnDelete();
            $table->enum('jenis_pendampingan', ['KMS', 'KIA', 'ASI'])->nullable()->comment('KMS: Kartu Menuju Sehat, KIA: Kartu Ibu Anak, ASI: Air Susu Ibu');
            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])->nullable();
            // $table->foreignId('interpretasi_id')->constrained('ref_interpretasi')->restrictOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_pendampingan')->nullable();
            $table->decimal('berat_badan', 5, 2)->comment('Berat badan dalam kg');
            $table->decimal('tinggi_badan', 5, 2)->comment('Tinggi badan dalam cm');
            $table->integer('usia')->comment('Usia dalam minggu (usia per tanggal ketika pendampingan dilakukan)');
            $table->string('status_berat_badan')->nullable();
            $table->string('status_tinggi_badan')->nullable();
            $table->string('keterangan', 200)->nullable();
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
        Schema::dropIfExists('pendampingan_balita');
    }
};
