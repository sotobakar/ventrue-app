<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Ruang 3.02 Gedung Dewi Sartika',
            'Ruang Fungsional Dosen Gedung FIK Lt.2',
            'Ruang Rapat FIK Lt.1',
            'Selasar FIK',
            'Lapangan Basket UPNVJ Pondok Labu',
        ];

        foreach($locations as $location) {
            Location::create([
                'name' => $location
            ]);
        }
    }
}
