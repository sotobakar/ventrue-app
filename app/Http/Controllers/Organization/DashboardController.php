<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Dashboard page.
     * 
     */
    public function index(Request $request)
    {
        $query = Event::where('organization_id', $request->user()->organization->id);

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

        $totalAttendances = DB::table('event_attendances')
            ->whereIn('event_id', $event_ids)
            ->count();

        $attendeesToRegistrationsPercentage = round(($totalAttendances / $totalRegistrations) * 100, 2);

        $averageFeedbackRatings = DB::table('event_feedback')
            ->whereIn('event_id', $event_ids)
            ->avg('rating');
        
        $averageFeedbackRatings = round($averageFeedbackRatings, 1);

        $averageParticipantsPerEvent = $totalEvents != 0 ? round($totalRegistrations / $totalEvents, 2) : $totalEvents;

        $statistics = [
            [
                'name' => 'Acara yang diselenggarakan',
                'icon' => 'fa-calendar',
                'value' => $totalEvents . ' acara',
                'link' => route('organization.events')
            ],
            [
                'name' => 'Total pendaftar acara',
                'icon' => 'fa-user-friends',
                'value' => $totalRegistrations . ' pendaftar',
            ],
            [
                'name' => 'Total absensi acara',
                'icon' => 'fa-user-friends',
                'value' => $totalAttendances . ' hadirin',
            ],
            [
                'name' => 'Persentase pendaftar yang hadir',
                'icon' => 'fa-clipboard-user',
                'value' => $attendeesToRegistrationsPercentage . ' %',
            ],
            [
                'name' => 'Rata-rata nilai feedback',
                'icon' => 'fa-stars',
                'value' => $averageFeedbackRatings . ' / 5 bintang',
            ],
            [
                'name' => 'Rata-rata pendaftar per acara',
                'icon' => 'fa-file-user',
                'value' => $averageParticipantsPerEvent . ' pendaftar',
            ]
        ];

        return view('organization.pages.index', [
            'user' => $request->user(),
            'statistics' => $statistics
        ]);
    }
}
