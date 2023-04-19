<?php

namespace Database\Seeders;

use App\Models\Event;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all finished events
        $events = Event::where('end', '<', now())->get();

        $faker = app(Faker::class);

        // Loop every attendees and give feedback
        foreach($events as $event) {
            foreach($event->attendees as $student) {
                $event->feedbacks()->create([
                    'student_id' => $student->id,
                    'body' => $faker->paragraph(4),
                    'rating' => rand(3,5)
                ]);
            }
        }
    }
}
