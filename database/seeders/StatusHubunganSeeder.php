<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusHubunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_hubungan = file_get_contents(public_path('json/status_hubungan.json'));
        $status_hubungan = json_decode($status_hubungan, true);

        foreach ($status_hubungan as $data) {
            \App\Models\Master\StatusHubungan::create($data);
        }
    }
}
