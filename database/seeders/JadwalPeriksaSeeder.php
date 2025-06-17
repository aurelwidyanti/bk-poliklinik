<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokters = User::where('role', 'dokter')->get();

        $jadwals = [
            [
                'id_dokter' => $dokters->where('email', 'budi.santoso@klinik.com')->first()->id,
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'status' => false,
            ],
            [
                'id_dokter' => $dokters->where('email', 'budi.santoso@klinik.com')->first()->id,
                'hari' => 'Rabu',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokters->where('email', 'siti.rahayu@klinik.com')->first()->id,
                'hari' => 'Selasa',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '13:00:00',
                'status' => false,
            ],
            [
                'id_dokter' => $dokters->where('email', 'siti.rahayu@klinik.com')->first()->id,
                'hari' => 'Kamis',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '13:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokters->where('email', 'ahmad.wijaya@klinik.com')->first()->id,
                'hari' => 'Senin',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'status' => false,
            ],
            [
                'id_dokter' => $dokters->where('email', 'ahmad.wijaya@klinik.com')->first()->id,
                'hari' => 'Jumat',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokters->where('email', 'rina.putri@klinik.com')->first()->id,
                'hari' => 'Rabu',
                'jam_mulai' => '14:00:00',
                'jam_selesai' => '18:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokters->where('email', 'rina.putri@klinik.com')->first()->id,
                'hari' => 'Sabtu',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '13:00:00',
                'status' => false,
            ],
            [
                'id_dokter' => $dokters->where('email', 'doni.pratama@klinik.com')->first()->id,
                'hari' => 'Selasa',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokters->where('email', 'doni.pratama@klinik.com')->first()->id,
                'hari' => 'Kamis',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'status' => false,
            ],
        ];

        foreach ($jadwals as $jadwal) {
            JadwalPeriksa::create($jadwal);
        }
    }
}
