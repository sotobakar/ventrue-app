<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $online_events = Event::where('type', '<>', 'offline')->get();

        $offline_events = Event::where('type', 'offline')->get();

        foreach ($online_events as $event) {
            $event->materials()->create([
                'name' => 'Materi',
                'path' => 'events/materials/Materi.pdf'
            ]);

            $event->materials()->create([
                'name' => 'Peraturan Lomba',
                'path' => 'events/materials/Peraturan Lomba.pdf'
            ]);

            $event->materials()->create([
                'name' => 'Virtual Background',
                'path' => 'events/materials/Virtual Background.pdf'
            ]);
        }

        foreach ($offline_events as $event) {
            $event->materials()->create([
                'name' => 'Materi',
                'path' => 'events/materials/Materi.pdf'
            ]);

            $event->materials()->create([
                'name' => 'Peraturan Lomba',
                'path' => 'events/materials/Peraturan Lomba.pdf'
            ]);
        }
    }
}
