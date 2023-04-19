<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $roles = ['student', 'organization', 'admin'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $this->call([
            FacultySeeder::class,
            OrganizationSeeder::class,
            EventCategorySeeder::class,
            EventSeeder::class,
            StudentSeeder::class,
            AdminSeeder::class,
            EventRegistrationSeeder::class,
            EventAttendanceSeeder::class,
            EventFeedbackSeeder::class,
            EventMaterialSeeder::class,
            HighlightedEventSeeder::class,
            ApproverSeeder::class,
            EventApprovalSeeder::class
        ]);
    }
}
