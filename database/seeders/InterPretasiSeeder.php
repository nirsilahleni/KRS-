<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterPretasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interpretasi = file_get_contents(public_path('json/interpretasi.json'));
        $interpretasi = json_decode($interpretasi, true);

        foreach ($interpretasi as $data) {
            \App\Models\Master\Interpretasi::create($data);
        }
    }
}
