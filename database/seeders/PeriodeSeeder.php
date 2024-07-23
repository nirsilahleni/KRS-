<?php

namespace Database\Seeders;

use App\Models\Master\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periode::insert([
            [
                'tahun' => '2024',
                'tanggal_mulai' => '2024-01-01', // YYYY-MM-DD format
                'tanggal_selesai' => '2024-12-31', // YYYY-MM-DD format
                'is_active' => '1'
            ],
            [
                'tahun' => '2023',
                'tanggal_mulai' => '2023-01-01',
                'tanggal_selesai' => '2023-12-31',
                'is_active' => '0'
            ]
        ]);
    }
}
