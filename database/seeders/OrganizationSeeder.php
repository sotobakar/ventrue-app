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

        // Create 20 organization
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
            ],
            [
                'email' => 'multimedia@upnvj.ac.id',
                'name' => 'KSM Multimedia',
                'level' => 'Fakultas',
                'faculty' => 'FIK',
                'image' => 'organizations/images/multimedia.png'
            ],
            [
                'email' => 'cybersecurity@upnvj.ac.id',
                'name' => 'KSM Cyber Security',
                'level' => 'Fakultas',
                'faculty' => 'FIK',
                'image' => 'organizations/images/cybersecurity.png'
            ],
            [
                'email' => 'robotika@upnvj.ac.id',
                'name' => 'KSM Robotika',
                'level' => 'Fakultas',
                'faculty' => 'FIK',
                'image' => 'organizations/images/robotika.png'
            ],
            [
                'email' => 'agape@upnvj.ac.id',
                'name' => 'PMK AGAPE',
                'level' => 'Universitas',
                'image' => 'organizations/images/agape.webp'
            ],
            [
                'email' => 'basket@upnvj.ac.id',
                'name' => 'Basket Veteran Jakarta',
                'level' => 'Universitas',
                'image' => 'organizations/images/basket.webp'
            ],
            [
                'email' => 'ksmbatavia@upnvj.ac.id',
                'name' => 'KSM Batavia',
                'level' => 'Fakultas',
                'faculty' => 'FIKES',
                'image' => 'organizations/images/batavia.jpg'
            ],
            [
                'email' => 'bemfh@upnvj.ac.id',
                'name' => 'BEM FH',
                'level' => 'Fakultas',
                'faculty' => 'FH',
                'image' => 'organizations/images/bemfh.png'
            ],
            [
                'email' => 'bemfikes@upnvj.ac.id',
                'name' => 'BEM FIKES',
                'level' => 'Fakultas',
                'faculty' => 'FIKES',
                'image' => 'organizations/images/bemfikes.jpg'   
            ],
            [
                'email' => 'frdm@upnvj.ac.id',
                'name' => 'Forum Riset dan Debat Mahasiswa',
                'level' => 'Fakultas',
                'faculty' => 'FH',
                'image' => 'organizations/images/frdm.jpg'          
            ],
            [
                'email' => 'himagi@upnvj.ac.id',
                'name' => 'Himpunan Mahasiswa Gizi',
                'level' => 'Fakultas',
                'faculty' => 'FIKES',
                'image' => 'organizations/images/himagi.jpg' 
            ],
            [
                'email' => 'hmtm@upnvj.ac.id',
                'name' => 'HIMA Mesin',
                'level' => 'Fakultas',
                'faculty' => 'FT',
                'image' => 'organizations/images/hm_teknik_mesin.png' 
            ],
            [
                'email' => 'mc@upnvj.ac.id',
                'name' => 'Master of Ceremony',
                'level' => 'Universitas',
                'image' => 'organizations/images/mc.jpg' 
            ],
            [
                'email' => 'ubv@upnvj.ac.id',
                'name' => 'UPN Band Veteran',
                'level' => 'Universitas',
                'image' => 'organizations/images/ubv.webp' 
            ],
            [
                'email' => 'ufo@upnvj.ac.id',
                'name' => 'UPN Fotografi & Videografi',
                'level' => 'Universitas',
                'image' => 'organizations/images/ufo.png'    
            ],
            [
                'email' => 'uvfc@upnvj.ac.id',
                'name' => 'Sepakbola UPNVJ',
                'level' => 'Universitas',
                'image' => 'organizations/images/uvfc.webp' 
            ],
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
