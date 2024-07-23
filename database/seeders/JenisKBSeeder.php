<?php

namespace Database\Seeders;

use App\Models\JenisKB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payloads = [
            [
                "jenis" => "Pil KB",
                "keterangan" => "Mengkonsumsi pil KB",
                "created_by" => 1
            ],
            [
                "jenis" => "Suntik KB",
                "keterangan" => "Menggunakan suntik KB",
                "created_by" => 1
            ],
            [
                "jenis" => "Kondom",
                "keterangan" => "Menggunakan kondom sebagai alat kontrasepsi",
                "created_by" => 1
            ],
            [
                "jenis" => "Implan KB",
                "keterangan" => "Menggunakan implan KB",
                "created_by" => 1
            ],
            [
                "jenis" => "IUD",
                "keterangan" => "Jenis KB yang kontrasepsi berbahan plastik yang memiliki bentuk seperti huruf 'T' dan dipasang di dalam rahim untuk mencegah kehamilan",
                "created_by" => 1
            ],
            [
                "jenis" => "vasektomi / MOP",
                "keterangan" => "Metode KB yang aman bagi pria yang tidak ingin lagi mempunyai anak dengan cara operasi kecil sehingga air mani tidak lagi mengandung sperma",
                "created_by" => 1
            ],
            [
                "jenis" => "tubektomi /MOW",
                "keterangan" => "Metode KB metode yang bersifat sukarela bagi seorang wanita bila tidak ingin hamil lagi dengan cara mengoklusi tuba falupii (mengikat dan memotong atau memasang cincin), sehingga sperma tidak dapat bertemu dengan ovum",
                "created_by" => 1
            ],
            [
                "jenis" => "tradisional",
                "keterangan" => "Metode KB yang dilakukan dengan cara tradisional",
                "created_by" => 1
            ],
            [
                "nama" => "Belum diketahui",
                "layak" => "belum ditentukan",
                "created_by" => 1
            ]
        ];

        JenisKB::insert($payloads);
    }
}
