<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EventController extends Controller
{
    /**
     * Get events list.
     * 
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Event::class)
            ->allowedFilters(['name', AllowedFilter::exact('event_category', 'event_category_id'), 'type']);


        $events = $query->where('start', '>', \Carbon\Carbon::now())
            ->orderBy('start', 'asc')->simplePaginate(6);

        $event_categories = EventCategory::get();

        $types = ['offline', 'online', 'hybrid'];

        return view('student.pages.events.index', [
            'events' => $events,
            'event_categories' => $event_categories,
            'types' => $types
        ]);
    }

    /**
     * Show event detail page by id
     * 
     */
    public function show(Request $request, Event $event)
    {
        if ($request->user()) {
            // Check if student registered to the event
            $studentRegistered = $event->participants()->where('id', $request->user()->student->id)->exists();
        }

        return view('student.pages.events.show', [
            'event' => $event,
            'studentRegistered' => $studentRegistered ?? null
        ]);
    }

    /**
     * Register student for the event
     * 
     */
    public function register(Request $request, Event $event)
    {
        $event->participants()->syncWithoutDetaching([$request->user()->student->id]);

        // If successful, then show alert, return page.
        return redirect()->route('student.events.detail', ['event' => $event->id])->with('success', 'Pendaftaran acara berhasil');
    }

    /**
     * Set reminder event (to be sent to student's email)
     * 
     */
    public function remind(Request $request, Event $event)
    {
    }

    /**
     * My events 
     * 
     */
    public function my_events(Request $request)
    {
        $events = $request->user()->student->registered_events()->paginate(6);

        return view('student.pages.events.my_events', [
            'events' => $events
        ]);
    }

    /**
     * My event detail
     * 
     */
    public function my_event_detail(Request $request)
    {

    }
}
