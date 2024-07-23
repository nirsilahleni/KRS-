<?php

namespace Database\Seeders;

use App\Models\Cms\FAQs;
use App\Models\User;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faqsData = [
            [
                'question' => 'Apa itu KRS?',
                'answer' => 'KRS (Keluarga Resiko Stunting) adalah program yang bertujuan untuk mengidentifikasi dan memberikan bantuan kepada keluarga yang memiliki resiko stunting pada balita di Kabupaten Blitar. 
                            Program ini dilakukan dengan cara melakukan penilaian status gizi balita dan memberikan bantuan berupa pendampingan dan edukasi kepada keluarga yang memiliki balita dengan resiko stunting.',
                'is_active' => '1',
                'created_by' => User::get()->first()->id,
                'updated_by' => User::get()->first()->id,
            ],
        ];

        foreach ($faqsData as $data) {
            FAQs::create($data);
        }
    }
}
