<?php

namespace Database\Seeders;

use App\Models\Approver;
use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApproverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = Faculty::get()->pluck('id')->all();
        $faculties[] = null;
        $approvers = [];
        foreach ($faculties as $faculty) {
            $approvers[] = [
                'name' => 'Nama Penyetuju',
                'email' => 'penyetuju@upnvj.ac.id',
                'faculty_id' => $faculty

            ];
        }

        foreach($approvers as $approver) {
            Approver::create($approver);
        }
    }
}
