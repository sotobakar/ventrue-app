<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get events
        $events = Event::get();

        // Get students
        $students = Student::limit(20)->get();

        // Register student to events
        foreach($events as $event) {
            $event->participants()->syncWithoutDetaching($students->random(rand(5, 20)));
        }
    }
}
