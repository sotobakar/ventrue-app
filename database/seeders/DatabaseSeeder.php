<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Faculty;
use App\Models\User;
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
            AdminSeeder::class
        ]);
    }
}
