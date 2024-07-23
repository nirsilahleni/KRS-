<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SumberAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sumber_air = file_get_contents(public_path('json/sumber_air.json'));
        $sumber_air = json_decode($sumber_air, true);

        foreach ($sumber_air as $data) {
            \App\Models\Master\SumberAir::create($data);
        }
    }
}
