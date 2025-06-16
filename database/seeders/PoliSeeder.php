<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama' => 'Gigi',
                'deskripsi' => 'Poli Gigi menangani masalah kesehatan gigi dan mulut, termasuk perawatan gigi, pencabutan, dan perawatan ortodontik.',
            ],
            [
                'nama' => 'Anak',
                'deskripsi' => 'Poli Anak menangani berbagai masalah kesehatan pada anak-anak, termasuk penyakit umum, imunisasi, dan pertumbuhan anak.',
            ],
            [
                'nama' => 'Penyakit Dalam',
                'deskripsi' => 'Poli Penyakit Dalam menangani berbagai penyakit internal, termasuk diabetes, hipertensi, dan gangguan sistem pencernaan.',
            ],

        ];

        foreach ($polis as $poli) {
            \App\Models\Poli::create($poli);
        }
    }
}
