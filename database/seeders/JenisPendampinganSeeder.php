<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPendampinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendampingan = file_get_contents(public_path('json/jenis_pendampingan.json'));
        $pendampingan = json_decode($pendampingan, true);

        foreach ($pendampingan as $data) {
            \App\Models\Master\JenisPendampingan::create($data);
        }
    }
}
