<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create Faculty
        $faculties = [
            [
                'name' => 'Fakultas Ilmu Komputer',
                'acronym' => 'FIK'
            ],
            [
                'name' => 'Fakultas Hukum',
                'acronym' => 'FH'
            ],
            [
                'name' => 'Fakultas Kedokteran',
                'acronym' => 'FK'
            ],
            [
                'name' => 'Fakultas Ilmu Sosial dan Politik',
                'acronym' => 'FISIP'
            ],
            [
                'name' => 'Fakultas Ekonomi dan Bisnis',
                'acronym' => 'FEB'
            ],
            [
                'name' => 'Fakultas Teknik',
                'acronym' => 'FT'
            ],
            [
                'name' => 'Fakultas Ilmu Kesehatan',
                'acronym' => 'FIKES'
            ]
        ];

        foreach ($faculties as $faculty) {
            Faculty::firstOrCreate([
                'name' => $faculty['name']
            ], $faculty);
        }
    }
}
