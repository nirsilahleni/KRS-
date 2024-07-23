<?php

namespace Database\Seeders;

use App\Models\TingkatKesejahteraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatKesejahteraanKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payloads = [
            [
                "tingkat_kesejahteraan" => "Sangat Miskin",
                "keterangan" => "Tidak Memiliki Rumah dan Tanah",
                "created_by" => "1"
            ],
            [
                "tingkat_kesejahteraan" => "Miskin",
                "keterangan" => "Memiliki Rumah dan Tanah namun tidak layak huni",
                "created_by" => "1"
            ],
            [
                "tingkat_kesejahteraan" => "Sedang",
                "keterangan" => "Memiliki Rumah dan Tanah layak huni, namun tidak memiliki aset lainnya",
                "created_by" => "1"
            ],
            [
                "tingkat_kesejahteraan" => "Kaya",
                "keterangan" => "Memiliki Rumah dan Tanah layak huni dan memiliki aset lainnya",
                "created_by" => "1"
            ],
            [
                "tingkat_kesejahteraan" => "Sangat Kaya",
                "keterangan" => "Memiliki Rumah dan Tanah layak huni dan memiliki aset lainnya",
                "created_by" => "1"
            ]
        ];

        TingkatKesejahteraan::insert($payloads);

    }
}
