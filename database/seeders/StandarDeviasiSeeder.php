<?php

namespace Database\Seeders;

use App\Models\StandarDeviasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SplFileObject;

class StandarDeviasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indexing_bayi_lk = new SplFileObject(public_path('docs/csv/indexing bayi lk.csv'));
        $indexing_bayi_lk->setFlags(SplFileObject::READ_CSV);

        $indexing_bayi_pr = new SplFileObject(public_path('docs/csv/indexing bayi pr.csv'));
        $indexing_bayi_pr->setFlags(SplFileObject::READ_CSV);

        $seeds = collect();

        foreach ($indexing_bayi_lk as $i => $row) {
            if ($i <= 2) continue;
            if($row[0] == null) break;

            $seeds->push([
                'umur' => $row[0],
                '-3sd' => $row[1],
                '-2sd' => $row[2],
                '-1sd' => $row[3],
                'median' => $row[4],
                '1sd' => $row[5],
                '2sd' => $row[6],
                '3sd' => $row[7],
                'type' => 'BB',
                'jenis_kelamin' => 'L'
            ]);
            $seeds->push([
                'umur' => $row[9],
                '-3sd' => $row[10],
                '-2sd' => $row[11],
                '-1sd' => $row[12],
                'median' => $row[13],
                '1sd' => $row[14],
                '2sd' => $row[15],
                '3sd' => $row[16],
                'type' => 'TB',
                'jenis_kelamin' => 'L'
            ]);

        }
        foreach ($indexing_bayi_pr as $i => $row) {
            if ($i <= 2) continue;
            if($row[0] == null) break;
            $seeds->push([
                'umur' => $row[0],
                '-3sd' => $row[1],
                '-2sd' => $row[2],
                '-1sd' => $row[3],
                'median' => $row[4],
                '1sd' => $row[5],
                '2sd' => $row[6],
                '3sd' => $row[7],
                'type' => 'BB',
                'jenis_kelamin' => 'P'
            ]);
            $seeds->push([
                'umur' => $row[9],
                '-3sd' => $row[10],
                '-2sd' => $row[11],
                '-1sd' => $row[12],
                'median' => $row[13],
                '1sd' => $row[14],
                '2sd' => $row[15],
                '3sd' => $row[16],
                'type' => 'TB',
                'jenis_kelamin' => 'P'
            ]);
        }

        $seeds->split(1000)->each(function ($chunk) {
            StandarDeviasi::insert($chunk->toArray());
        });


    }
}
