<?php

namespace Database\Seeders;

use App\Models\Krs\KepalaKeluarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepalaKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kepalaKeluarga = KepalaKeluarga::create([
            'nomor_kk' => '12345',
            'nik' => '123450',
            'nama_lengkap' => 'arman',
            'kecamatan_id' => 1,
            'kelurahan_id' => 1,
            'status_keluarga_id' => 1,
            'rt' =>  '10',
            'rw' =>  '11',
            'alamat' => 'Sabang subik',
            'periode_id' => 1
        ]);

        $kepalaKeluarga->kepala_keluarga_anggota()->create([
            'kepala_keluarga_id' => $kepalaKeluarga->id,
            'status_hubungan_id' => '1',
            'nik' => $kepalaKeluarga->nik,
            'pekerjaan' => '',
            'jenis_kelamin' => 'L',
            'nama_lengkap' => $kepalaKeluarga->nama_lengkap,
        ]);


    }
}
