<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 students
        $students = [
            [
                'email' => 'patricks@upnvj.ac.id',
                'name' => 'Patrick Santino',
                'sid' => '1910512012',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512012.png'
            ],
            [
                'email' => 'radityara@upnvj.ac.id',
                'name' => 'Raditya Rahardyansyah Rifat',
                'sid' => '1910512014',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512014.png'
            ],
            [
                'email' => 'laurentius@upnvj.ac.id',
                'name' => 'Laurentius Wijaya',
                'sid' => '1910512016',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512016.png'
            ],
            [
                'email' => 'marcusra@upnvj.ac.id',
                'name' => 'Marcus Rashford',
                'sid' => '1910512018',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512018.png'
            ],
            [
                'email' => 'lulun@upnvj.ac.id',
                'name' => 'Lulu Nailufar',
                'sid' => '1910512010',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512010.png'
            ],
        ];

        foreach ($students as $student) {
            $user = User::factory()->create([
                'email' => $student['email']
            ]);

            $user->assignRole('student');
            $faculty = Faculty::where('acronym', $student['faculty'])->first();

            $user->student()->create([
                'name' => $student['name'],
                'faculty_id' => $faculty->id,
                'image' => $student['image'],
                'sid' => $student['sid'],
                'year' => $student['year']
            ]);
        }
    }
}
