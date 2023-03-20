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
        $event = Event::first();
        
        for ($i=0; $i < 5 ; $i++) { 
            HighlightedEvent::create([
                'event_id' => $event->id
            ]);
        }
    }
}
