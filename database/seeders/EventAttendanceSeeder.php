<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all events that has started
        $events = Event::where('start', '<', now())->get();

        // Random attend event registrants
        foreach ($events as $event) {
            $event->attendees()->syncWithoutDetaching($event->participants->random(rand(0, $event->participants->count())));
        }

        // Set some ongoing events to open attendance
        $ongoingEvents = Event::where('start', '<', now())
                        ->where('end', '>', now())
                        ->limit(2)->get();
        
        foreach($ongoingEvents as $event) {
            $event->update([
                'attendance_open' => 1
            ]);
        }
    }
}
