<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempatBuangAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tempat_buang_air = file_get_contents(public_path('json/tempat_buang_air.json'));
        $tempat_buang_air = json_decode($tempat_buang_air, true);

        foreach ($tempat_buang_air as $data) {
            \App\Models\Master\TempatBuangAir::create($data);
        }
    }
}
