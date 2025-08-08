<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use App\Models\MeetingSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Teams
        $teams = [
            ['name' => 'Tim Kerja Penanggulangan Kemiskinan', 'code' => 'tim_1', 'description' => 'Tim Kerja Penanggulangan Kemiskinan'],
            ['name' => 'Tim Kerja Kawasan Industri & PSN', 'code' => 'tim_2', 'description' => 'Tim Kerja Kawasan Industri & PSN (Proyek Strategis Nasional)'],
            ['name' => 'Tim Kerja Peluang Investasi', 'code' => 'tim_3', 'description' => 'Tim Kerja Peluang Investasi'],
            ['name' => 'Tim Kerja CSR/TJSL', 'code' => 'tim_4', 'description' => 'Tim Kerja CSR/TJSL (Corporate Social Responsibility / Tanggung Jawab Sosial dan Lingkungan)'],
            ['name' => 'Tim Kerja DBH Perkebunan', 'code' => 'tim_5', 'description' => 'Tim Kerja DBH (Dana Bagi Hasil) Perkebunan'],
        ];

        foreach ($teams as $teamData) {
            Team::create($teamData);
        }

        // Create Users
        $users = [
            [
                'name' => 'Kepala Bidang',
                'email' => 'kabid@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'kabid',
                'team_id' => null,
            ],
            [
                'name' => 'Konsultan Individu',
                'email' => 'ki@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'KI',
                'team_id' => null,
            ],
            [
                'name' => 'Anggota Tim 1',
                'email' => 'tim1@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_1',
                'team_id' => 1,
            ],
            [
                'name' => 'Anggota Tim 2',
                'email' => 'tim2@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_2',
                'team_id' => 2,
            ],
            [
                'name' => 'Anggota Tim 3',
                'email' => 'tim3@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_3',
                'team_id' => 3,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Create some sample meeting schedules
        MeetingSchedule::create([
            'title' => 'Rapat Koordinasi Bulanan',
            'agenda' => 'Pembahasan progres proyek dan evaluasi',
            'description' => 'Rapat koordinasi rutin untuk membahas progres semua tim kerja',
            'meeting_date' => now()->addDays(7)->setTime(9, 0),
            'location' => 'Ruang Rapat Utama',
            'status' => 'scheduled',
            'created_by' => 2, // KI user
        ]);

        MeetingSchedule::create([
            'title' => 'Rapat Evaluasi Triwulan',
            'agenda' => 'Evaluasi pencapaian target triwulan',
            'description' => 'Rapat evaluasi kinerja triwulan semua divisi',
            'meeting_date' => now()->addDays(14)->setTime(14, 0),
            'location' => 'Ruang Auditorium',
            'status' => 'scheduled',
            'created_by' => 2, // KI user
        ]);
    }
}
