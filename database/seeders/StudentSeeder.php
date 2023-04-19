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
        // Create 20 students
        $students = [
            [
                'email' => 'patricks@upnvj.ac.id',
                'name' => 'Patrick Santino',
                'phone' => '081316472184',
                'sid' => '1910512012',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512012.png'
            ],
            [
                'email' => 'radityara@upnvj.ac.id',
                'name' => 'Raditya Rahardyansyah Rifat',
                'phone' => '0813111112222',
                'sid' => '1910512014',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512014.png'
            ],
            [
                'email' => 'laurentius@upnvj.ac.id',
                'name' => 'Laurentius Wijaya',
                'phone' => '081333334444',
                'sid' => '1910512016',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512016.png'
            ],
            [
                'email' => 'marcusra@upnvj.ac.id',
                'name' => 'Marcus Rashford',
                'phone' => '081355556666',
                'sid' => '1910512018',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512018.png'
            ],
            [
                'email' => 'lulun@upnvj.ac.id',
                'name' => 'Lulu Nailufar',
                'phone' => '081377778888',
                'sid' => '1910512010',
                'year' => '2019',
                'faculty' => 'FIK',
                'image' => 'students/images/1910512010.png'
            ],
            [
                'email' => 'rafat@upnvj.ac.id',
                'name' => 'Rafael T',
                'phone' => '081315542332',
                'sid' => '2010512010',
                'year' => '2020',
                'faculty' => 'FIK',
                'image' => 'students/images/2010512010.png'
            ],
            [
                'email' => 'samsula@upnvj.ac.id',
                'name' => 'Syamsul Agustinus',
                'phone' => '081315542331',
                'sid' => '2010512012',
                'year' => '2020',
                'faculty' => 'FIK',
                'image' => 'students/images/2010512012.png'
            ],
            [
                'email' => 'andre@upnvj.ac.id',
                'name' => 'Andre RW',
                'phone' => '081315542333',
                'sid' => '2010512014',
                'year' => '2020',
                'faculty' => 'FIK',
                'image' => 'students/images/2010512014.png'
            ],
            [
                'email' => 'andikay@upnvj.ac.id',
                'name' => 'Andika Yahya',
                'phone' => '081315542334',
                'sid' => '2010512016',
                'year' => '2020',
                'faculty' => 'FIK',
                'image' => 'students/images/2010512016.png'
            ],
            [
                'email' => 'yohanesm@upnvj.ac.id',
                'name' => 'Yohanes Matthew',
                'phone' => '081315542335',
                'sid' => '2010512018',
                'year' => '2020',
                'faculty' => 'FIK',
                'image' => 'students/images/2010512018.png'
            ],
            [
                'email' => 'bagask@upnvj.ac.id',
                'name' => 'Bagaskara Maulana Drianasta',
                'phone' => '081315542321',
                'sid' => '2110512010',
                'year' => '2021',
                'faculty' => 'FIK',
                'image' => 'students/images/2110512010.png'
            ],
            [
                'email' => 'susanr@upnvj.ac.id',
                'name' => 'Susan Rachel',
                'phone' => '081315542322',
                'sid' => '2110512012',
                'year' => '2021',
                'faculty' => 'FIK',
                'image' => 'students/images/2110512012.png'
            ],
            [
                'email' => 'amarkaleb@upnvj.ac.id',
                'name' => 'Ammar Kaleb',
                'phone' => '081315542323',
                'sid' => '2110512014',
                'year' => '2021',
                'faculty' => 'FIK',
                'image' => 'students/images/2110512014.png'
            ],
            [
                'email' => 'marioyus@upnvj.ac.id',
                'name' => 'Mario Yusuf Siahaan',
                'phone' => '081315542324',
                'sid' => '2110512016',
                'year' => '2021',
                'faculty' => 'FIK',
                'image' => 'students/images/2110512016.png'
            ],
            [
                'email' => 'jyosafat@upnvj.ac.id',
                'name' => 'Jeremiah Yosafat Imanuel',
                'phone' => '081315542325',
                'sid' => '2110512018',
                'year' => '2021',
                'faculty' => 'FIK',
                'image' => 'students/images/2110512018.png'
            ],
            [
                'email' => 'noahj@upnvj.ac.id',
                'name' => 'Noah James',
                'phone' => '081315542311',
                'sid' => '2210512010',
                'year' => '2022',
                'faculty' => 'FIK',
                'image' => 'students/images/2210512010.png'
            ],
            [
                'email' => 'willrussell@upnvj.ac.id',
                'name' => 'William Russell',
                'phone' => '081315542312',
                'sid' => '2210512012',
                'year' => '2022',
                'faculty' => 'FIK',
                'image' => 'students/images/2210512012.png'
            ],
            [
                'email' => 'hoshinoai@upnvj.ac.id',
                'name' => 'Hoshino Ai',
                'phone' => '081315542313',
                'sid' => '2210512014',
                'year' => '2022',
                'faculty' => 'FIK',
                'image' => 'students/images/2210512014.png'
            ],
            [
                'email' => 'axelf@upnvj.ac.id',
                'name' => 'Axel Feivel',
                'phone' => '081315542314',
                'sid' => '2210512016',
                'year' => '2022',
                'faculty' => 'FIK',
                'image' => 'students/images/2210512016.png'
            ],
            [
                'email' => 'eduardo@upnvj.ac.id',
                'name' => 'Eduardo Yoseph',
                'phone' => '081315542315',
                'sid' => '2210512018',
                'year' => '2022',
                'faculty' => 'FIK',
                'image' => 'students/images/2210512018.png'
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
                'phone' => $student['phone'],
                'faculty_id' => $faculty->id,
                'image' => $student['image'],
                'sid' => $student['sid'],
                'year' => $student['year']
            ]);
        }
    }
}
