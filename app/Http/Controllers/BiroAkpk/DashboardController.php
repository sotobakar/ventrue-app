<?php

namespace App\Http\Controllers\BiroAkpk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $statistics = [
            [
                'name' => 'Acara yang diselenggarakan',
                'icon' => 'fa-calendar',
                'value' => '1 acara',
                'link' => route('admin.events')
            ],
            [
                'name' => 'Total mahasiswa',
                'icon' => 'fa-user-friends',
                'value' => '1 mahasiswa',
                'link' => route('admin.students')
            ],
            [
                'name' => 'Total organisasi',
                'icon' => 'fa-sitemap',
                'value' => '1 organisasi',
                'link' => route('admin.organizations')
            ],
            [
                'name' => 'Persentase pendaftar yang hadir',
                'icon' => 'fa-clipboard-user',
                'value' => '100 %',
            ],
            [
                'name' => 'Total acara terverifikasi',
                'icon' => 'fa-check-square',
                'value' => '1 acara',
            ],
            [
                'name' => 'Rata-rata pendaftar per acara',
                'icon' => 'fa-file-user',
                'value' => '1 pendaftar',
            ]
        ];

        return view('biroakpk.pages.index', [
            'statistics' => $statistics
        ]);
    }
}
