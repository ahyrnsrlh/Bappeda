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
            ['name' => 'Tim Kerja Penanggulangan Kemiskinan', 'code' => 'tim_kemiskinan', 'description' => 'Tim Kerja Penanggulangan Kemiskinan'],
            ['name' => 'Tim Kerja Kawasan Industri & PSN', 'code' => 'tim_industri_psn', 'description' => 'Tim Kerja Kawasan Industri & PSN (Proyek Strategis Nasional)'],
            ['name' => 'Tim Kerja Peluang Investasi', 'code' => 'tim_investasi', 'description' => 'Tim Kerja Peluang Investasi'],
            ['name' => 'Tim Kerja CSR/TJSL', 'code' => 'tim_csr', 'description' => 'Tim Kerja CSR/TJSL (Corporate Social Responsibility / Tanggung Jawab Sosial dan Lingkungan)'],
            ['name' => 'Tim Kerja DBH Perkebunan', 'code' => 'tim_dbh', 'description' => 'Tim Kerja DBH (Dana Bagi Hasil) Perkebunan'],
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
                'is_approved' => true,
                'approved_at' => now(),
            ],
            [
                'name' => 'Konsultan Individu',
                'email' => 'ki@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'KI',
                'team_id' => null,
                'is_approved' => true,
                'approved_at' => now(),
            ],
            [
                'name' => 'Anggota Tim Kemiskinan',
                'email' => 'tim_kemiskinan@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_kemiskinan',
                'team_id' => 1,
                'is_approved' => true,
                'approved_at' => now(),
            ],
            [
                'name' => 'Anggota Tim Industri PSN',
                'email' => 'tim_industri_psn@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_industri_psn',
                'team_id' => 2,
                'is_approved' => true,
                'approved_at' => now(),
            ],
            [
                'name' => 'Anggota Tim Investasi',
                'email' => 'tim_investasi@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_investasi',
                'team_id' => 3,
                'is_approved' => true,
                'approved_at' => now(),
            ],
            [
                'name' => 'Anggota Tim CSR',
                'email' => 'tim_csr@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_csr',
                'team_id' => 4,
                'is_approved' => true,
                'approved_at' => now(),
            ],
            [
                'name' => 'Anggota Tim DBH',
                'email' => 'tim_dbh@bappeda.com',
                'password' => Hash::make('password'),
                'role' => 'tim_dbh',
                'team_id' => 5,
                'is_approved' => true,
                'approved_at' => now(),
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
