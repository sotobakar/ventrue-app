<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    /**
     * Dashboard page
     * 
     */
    public function index(Request $request)
    {
        $query = Event::query();

        if (!is_null($request->query('timeframe'))) {
            // If week then reduce by 7 days from now, if month then reduce by 30 days.
            if ($request->query('timeframe') == 'week') {
                $query->where('start', '>=', Carbon::now()->subDays(7)->startOfDay());
            } else if ($request->query('timeframe') == 'month') {
                $query->where('start', '>=', Carbon::now()->subDays(30)->startOfDay());
            }
        }

        $events = $query->get();

        // Get all IDs in array form
        $event_ids = $events->pluck('id')->all();

        $totalEvents = count($event_ids);

        $totalRegistrations = DB::table('event_registrations')
            ->whereIn('event_id', $event_ids)
            ->count();

        $totalStudentsQuery = Student::query();

        if (!is_null($request->query('timeframe'))) {
            // If week then reduce by 7 days from now, if month then reduce by 30 days.
            if ($request->query('timeframe') == 'week') {
                $totalStudentsQuery->where('created_at', '>=', Carbon::now()->subDays(7)->startOfDay());
            } else if ($request->query('timeframe') == 'month') {
                $totalStudentsQuery->where('created_at', '>=', Carbon::now()->subDays(30)->startOfDay());
            }
        }

        $totalStudents = $totalStudentsQuery->count();

        $totalOrganizationsQuery = Organization::query();

        if (!is_null($request->query('timeframe'))) {
            // If week then reduce by 7 days from now, if month then reduce by 30 days.
            if ($request->query('timeframe') == 'week') {
                $totalOrganizationsQuery->where('created_at', '>=', Carbon::now()->subDays(7)->startOfDay());
            } else if ($request->query('timeframe') == 'month') {
                $totalOrganizationsQuery->where('created_at', '>=', Carbon::now()->subDays(30)->startOfDay());
            }
        }

        $totalOrganizations = $totalOrganizationsQuery->count();

        $totalAttendances = DB::table('event_attendances')
            ->whereIn('event_id', $event_ids)
            ->count();
        
        $totalVerifiedEvents = $events->reject(function ($event) {
            return !$event->verified;
        })->count();

        $attendeesToRegistrationsPercentage = round(($totalAttendances / $totalRegistrations) * 100, 2);

        $averageParticipantsPerEvent = $totalEvents != 0 ? round($totalRegistrations / $totalEvents, 2) : $totalEvents;

        $statistics = [
            [
                'name' => 'Acara yang diselenggarakan',
                'icon' => 'fa-calendar',
                'value' => $totalEvents . ' acara',
                'link' => route('admin.events')
            ],
            [
                'name' => 'Total mahasiswa',
                'icon' => 'fa-user-friends',
                'value' => $totalStudents . ' mahasiswa',
                'link' => route('admin.students')
            ],
            [
                'name' => 'Total organisasi',
                'icon' => 'fa-sitemap',
                'value' => $totalOrganizations . ' organisasi',
                'link' => route('admin.organizations')
            ],
            [
                'name' => 'Persentase pendaftar yang hadir',
                'icon' => 'fa-clipboard-user',
                'value' => $attendeesToRegistrationsPercentage . ' %',
            ],
            [
                'name' => 'Total acara terverifikasi',
                'icon' => 'fa-check-square',
                'value' => $totalVerifiedEvents . ' acara',
            ],
            [
                'name' => 'Rata-rata pendaftar per acara',
                'icon' => 'fa-file-user',
                'value' => $averageParticipantsPerEvent . ' pendaftar',
            ]
        ];

        return view('admin.pages.index', [
            'statistics' => $statistics
        ]);
    }
}
