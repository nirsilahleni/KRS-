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
        Schema::create('kader', function (Blueprint $table) {
            // $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->uuid('id')->primary();
            $table->string('nama_lengkap', 100);
            $table->string('nik', 16)->unique();
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->enum("jenis_kelamin", ["L", "P"]);
            $table->string('nomor_hp', 15);
            $table->string('email', 100)->unique();
            $table->foreignId('kecamatan_id')->constrained('ref_kecamatan')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('kelurahan_id')->constrained('ref_kelurahan')->onUpdate('cascade')->onDelete('restrict');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('alamat', 255);
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
        Schema::dropIfExists('kader');
    }
};
