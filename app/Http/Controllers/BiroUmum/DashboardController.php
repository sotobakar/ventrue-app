<?php

namespace App\Http\Controllers\BiroUmum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $statistics = [
            [
                'name' => 'Jumlah Lokasi',
                'icon' => 'fa-map-marker-alt',
                'value' => '1 lokasi',
                'link' => route('biroumum.locations')
            ],
            [
                'name' => 'Jumlah Acara Bentrok',
                'icon' => 'fa-calendar-times',
                'value' => '1 acara',
                'link' => route('biroumum.schedules.clash')
            ],
        ];

        return view('biroumum.pages.index', [
            'statistics' => $statistics
        ]);
    }
}
