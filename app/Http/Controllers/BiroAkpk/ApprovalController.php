<?php

namespace App\Http\Controllers\BiroAkpk;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApprovalController extends Controller
{
    /**
     * Show list of unapproved events
     * 
     */
    public function index(Request $request)
    {
        $events = QueryBuilder::for(Event::class)
            ->allowedFilters([
                'name',
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to')
            ])
            ->doesntHave('approval')
            ->orWhereHas('approval', function (Builder $query) {
                $query->where('approved_at', '=', null);
            })
            ->orderBy('start', 'desc')
            ->paginate(10)
            ->appends(request()->query());

        return view('biroakpk.pages.approvals.index', [
            'events' => $events
        ]);
    }

    /**
     * Details of event (not approved yet)
     * 
     */
    public function detail(Request $request, Event $event)
    {
        return view('biroakpk.pages.approvals.show', [
            'event' => $event
        ]);
    }

    /**
     * Approve event
     * 
     */
    public function approve(Request $request, Event $event)
    {
        $event->approval()->create([
            'approved_at' => Carbon::now(),
        ]);

        return redirect()->route('biroakpk.approvals')->with('success', 'Berhasil menyetujui acara.');
    }
}
