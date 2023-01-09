<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event_categories = ['Seminar', 'Workshop', 'Ujian', 'Akademik', 'Non-Akademik','Hiburan'];
        
        foreach($event_categories as $event_category) {
            EventCategory::firstOrCreate([
                'name' => $event_category
            ]);
        }
    }
}
