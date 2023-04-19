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
        $events = Event::where('organization_id', $organization->id)->get();

        // Verify events
        foreach ($events->take(2) as $event) {
            $event->approval()->create([
                'event_id' => $event->id,
                'approved_at' => now()
            ]);
        }

        // Verify events (not approved)
        foreach ($events->take(-3) as $event) {
            $event->approval()->create([
                'event_id' => $event->id,
                'approved_at' => null
            ]);
        }
    }
}
