<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EventController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if ($request->user() && $request->user()->organization) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }


            return $next($request);
        });
    }

    /**
     * Get events list.
     * 
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Event::class)
            ->allowedFilters([
                'name',
                AllowedFilter::exact('event_category', 'event_category_id'),
                'type',
                AllowedFilter::scope('from')->default(now()),
                AllowedFilter::scope('to')
            ])
            ->whereHas('approval', function (Builder $query) {
                $query->where('approved_at', '<>', null);
            });


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

            if ($studentRegistered) {
                return redirect()->route('student.my_events.detail', ['event' => $event]);
            }
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
        $validated = $request->validate([
            'minutes_before' => ['required', 'integer', 'max:60']
        ]);

        // Create event reminder
        $event->reminders()->create([
            'student_id' => $request->user()->student->id,
            'remind_at' => Carbon::parse($event->start)->subMinutes($validated['minutes_before'])
        ]);

        return back();
    }

    /**
     * My events 
     * 
     */
    public function my_events(Request $request)
    {
        $events = $request->user()->student->registered_events()->orderBy('registered_at', 'desc')->paginate(6);

        return view('student.pages.events.my_events', [
            'events' => $events
        ]);
    }

    /**
     * My event detail
     * 
     */
    public function my_event_detail(Request $request, Event $event)
    {
        $feedback_exists = $event->feedbacks()->where('student_id', $request->user()->student->id)->exists();

        $reminder = $event->reminders()->where('student_id', $request->user()->student->id)->first();

        return view('student.pages.events.my_event_detail', [
            'event' => $event,
            'feedback_exists' => $feedback_exists,
            'reminder'  => $reminder
        ]);
    }

    /**
     * Attend event
     * 
     */
    public function attend(Request $request, Event $event)
    {
        $event->attendees()->syncWithoutDetaching([$request->user()->student->id]);
        return back()->with('success', 'Anda berhasil absen untuk acara ' . $event->name . '.');
    }

    /**
     * Attend event via QR Code
     * 
     */
    public function attendWithQRCode(Request $request, Event $event)
    {
        $isRegistered = $event->participants()->wherePivot('student_id', $request->user()->student->id)->exists();

        if (!$isRegistered) {
            return redirect()->route('student.events.detail', ['event' => $event->id])->withErrors(['Anda belum terdaftar sebagai partisipan acara.']);
        }

        // Add attendance to student
        $event->attendees()->syncWithoutDetaching([$request->user()->student->id]);

        // Redirect to events page with success response
        return redirect()->route('student.my_events.detail', ['event' => $event->id])->with('success', 'Anda berhasil absen untuk acara ' . $event->name . '.');
    }

    /**
     * Submit feedback
     * 
     */
    public function submit_feedback(Request $request, Event $event)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'body' => ['required']
        ]);

        $feedback = $event->feedbacks()->make(array_merge($validated, [
            'student_id' => $request->user()->student->id
        ]));

        $feedback->save();

        return back()->with('success', 'Terimakasih sudah mengisi feedback.');
    }
}
