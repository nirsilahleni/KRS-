<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusKeluarga = file_get_contents(public_path('json/status_keluarga.json'));
        $statusKeluarga = json_decode($statusKeluarga, true);

        foreach ($statusKeluarga as $data) {
            \App\Models\Master\StatusKeluarga::create($data);
        }
    }
}
