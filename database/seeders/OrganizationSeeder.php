<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create 5 organization
        $organizations = [
            [
                'email' => 'ksmandroiddemo@gmail.com',
                'name' => 'KSM Android',
                'level' => 'Fakultas',
                'faculty' => 'FIK',
                'image' => 'organizations/images/ksmandroid.png'
            ],
            [
                'email' => 'fivetvupnvj@gmail.com',
                'name' => 'Five TV',
                'level' => 'Fakultas',
                'faculty' => 'FISIP',
                'image' => 'organizations/images/fivetv.png'
            ],
            [
                'email' => 'eosupnvj@gmail.com',
                'name' => 'English of Siloence',
                'level' => 'Fakultas',
                'faculty' => 'FISIP',
                'image' => 'organizations/images/eos.jpg'
            ],
            [
                'email' => 'bemfikupnvj@gmail.com',
                'name' => 'BEM FIK',
                'level' => 'Fakultas',
                'faculty' => 'FIK',
                'image' => 'organizations/images/bemfik.jpg'
            ],
            [
                'email' => 'bemfk@gmail.com',
                'name' => 'BEM FK',
                'level' => 'Fakultas',
                'faculty' => 'FK',
                'image' => 'organizations/images/bemfk.png'
            ]
        ];

        foreach ($organizations as $org) {
            $user = User::factory()->create([
                'email' => $org['email']
            ]);

            $user->assignRole('organization');
            if (isset($org['faculty'])) {
                $faculty = Faculty::where('acronym', $org['faculty'])->first();

                $user->organization()->create([
                    'name' => $org['name'],
                    'level' => $org['level'],
                    'faculty_id' => $faculty->id,
                    'image' => $org['image']
                ]);
            } else {
                $user->organization()->create([
                    'name' => $org['name'],
                    'level' => $org['level'],
                    'image' => $org['image']
                ]);
            }
        }
    }
}
