<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organization = Organization::where('name', 'KSM Android')->first();
        $events = Event::where('organization_id', $organization->id)->limit(1)->get();

        foreach ($events as $event) {
            $approval = $event->approval()->create([
                'event_id' => $event->id,
                'approved_at' => null
            ]);

            // Append files to approval
        }
    }
}
