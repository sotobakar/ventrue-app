<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\HighlightedEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HighlightedEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = Event::inRandomOrder()->limit(5)->get();
        
        foreach ($events as $event) { 
            HighlightedEvent::create([
                'event_id' => $event->id
            ]);
        }
    }
}
