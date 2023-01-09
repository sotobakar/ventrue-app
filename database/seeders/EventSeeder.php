<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'data' => [
                    'name' => 'Lari Bersama di Senayan',
                    'location' => 'Jl. Stadion Senayan',
                    'type' => 'offline',
                    'banner' => 'events/images/running.jpeg',
                    'description' => 'Olahraga di Senayan bersama mahasiswa, dosen, dan staf Fakultas Ilmu Komputer UPN Veteran Jakarta.'
                ],
                'organization' => 'BEM FIK',
                'event_category' => 'Hiburan'
            ],
            [
                'data' => [
                    'name' => 'Study with Android: Backend',
                    'location' => 'Zoom Meeting',
                    'meeting_link' => 'https://zoom.us',
                    'type' => 'online',
                    'banner' => 'events/images/android.png',
                    'description' => 'Belajar pengembangan backend bersama mentor dan pengajar di KSM Android yuk. Setiap minggu diadakan sesi belajar bersama dengan hands-on yang dapat diikuti dari laptop/komputer kalian masing-masing.'
                ],
                'organization' => 'KSM Android',
                'event_category' => 'Workshop'
            ],
            [
                'data' => [
                    'name' => 'TOEFL Practice for UPN Students',
                    'location' => 'Ruang 3.02 Gedung Dewi Sartika',
                    'type' => 'offline',
                    'banner' => 'events/images/toefl.png',
                    'description' => 'Belajar TOEFL bersama English of Siloence yuk. Dilatih dengan para mentor yang memiliki skor TOEFL 600++, mahasiswa mempelajari tiga bagian ujian dari Structural, Written, dan Listening.'
                ],
                'organization' => 'English of Siloence',
                'event_category' => 'Akademik'
            ]
        ];

        foreach ($events as $event) {
            $event['data']['event_category_id'] = EventCategory::where('name', $event['event_category'])->first()->id;

            $event['data']['organization_id'] = Organization::where('name', $event['organization'])->first()->id;

            for ($i = 1; $i < 5; $i++) {
                Event::create(array_merge($event['data'], [
                    'registration_start' => Carbon::today()->addWeeks($i - 1),
                    'registration_end' => Carbon::today()->addWeeks($i - 1)->addDays(6),
                    'start' => Carbon::today()->addWeeks($i)->addHours(7),
                    'end' => Carbon::today()->addWeeks($i)->addHours(10),
                ]));
            }
        }
    }
}
