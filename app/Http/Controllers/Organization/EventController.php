<?php

namespace App\Http\Controllers\Organization;

use App\Exports\EventAttendeesExport;
use App\Exports\EventFeedbacksExport;
use App\Exports\EventParticipantsExport;
use App\Exports\ParticipantsExport;
use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    /**
     * Show events table
     * 
     */
    public function index(Request $request)
    {
        $events = $request->user()->organization->events;
        return view('organization.pages.events.index', [
            'events' => $events
        ]);
    }

    /**
     * Create event page
     * 
     */
    public function create(Request $request)
    {
        $types = ['online', 'offline', 'hybrid'];

        $event_categories = EventCategory::get();
        return view('organization.pages.events.create', [
            'types' => $types,
            'event_categories' => $event_categories
        ]);
    }

    /**
     * Create event
     * 
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'banner' => ['required', 'image', 'dimensions:min_width=400,min_height=200'],
            'type' => ['required', 'string', Rule::in(['offline', 'online', 'hybrid'])],
            'event_category' => ['required', 'exists:event_categories,id'],
            'location' => ['required'],
            'meeting_link' => ['sometimes'],
            'start' => ['required'],
            'end' => ['required'],
            'registration_start' => ['required'],
            'registration_end' => ['required'],
            'description' => ['required', 'string', 'min:50']
        ]);

        $validated['event_category_id'] = $validated['event_category'];
        $validated['organization_id'] = $request->user()->id;

        // Store image
        $file = $validated['banner'];
        $resized_image = Image::make($file->getPathName())
            ->orientate()
            ->fit(600, 337.5, function ($constraint) {
                $constraint->aspectRatio();
            })->encode();

        // Rename file
        $now = \Carbon\Carbon::now()->toDateTimeString();
        $file_name = md5($resized_image->__toString() . $now);
        $path = "events/images/{$file_name}.{$file->getClientOriginalExtension()}";

        // Save to storage/public/organizations/images folder
        $resized_image->save(Storage::disk('public')->path($path));

        $validated['banner'] = $path;

        // Create Event
        Event::create($validated);

        // Return success alert
        return redirect()->route('organization.events')->with('success', 'Berhasil membuat event.');
    }

    /**
     * Show event details
     * 
     */
    public function show(Request $request, Event $event)
    {
        return view('organization.pages.events.show', [
            'event' => $event
        ]);
    }

    /**
     * Edit event
     * 
     */

    /**
     * Delete event
     * 
     */

    /**
     * Download participants of event to CSV.
     * 
     */
    public function participants_to_csv(Request $request, Event $event)
    {
        return (new EventParticipantsExport($event->participants))->download('Peserta ' . $event->name . '-' . date("Ymdhis") . ".csv", \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Download attendees of event to CSV
     * 
     */
    public function attendees_to_csv(Request $request, Event $event)
    {
        return (new EventAttendeesExport($event->attendees))->download('Absensi ' . $event->name . '-' . date("Ymdhis") . ".csv", \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Download event feedbacks to CSV
     * 
     */
    public function feedbacks_to_csv(Request $request, Event $event)
    {
        return (new EventFeedbacksExport($event->feedbacks))->download('Feedback ' . $event->name . '-' . date("Ymdhis") . ".csv", \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * Add Event Material
     * 
     */
    public function add_material(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'material' => ['required', 'mimes:pdf,ppt,pptx,jpg,jpeg,png', 'max:10000']
        ]);

        // Upload file
        /** @var \Illuminate\Http\UploadedFile */
        $file = $validated['material'];

        $name = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('events/materials', $name, 'public');

        $event->materials()->create([
            'name' => $validated['name'],
            'path' => $filePath
        ]);

        return back();
    }

    /**
     * Delete Event Material
     * 
     */
    public function delete_material(Request $request, Event $event, EventMaterial $material)
    {
        // Check for file existence
        $file_exists = Storage::disk('public')->exists($material->path);
        if ($file_exists) {
            Storage::disk('public')->delete($material->path);
        }

        $material->delete();
        return back();
    }

    /**
     * Open attendance for students
     * 
     */
    public function open_attendance(Request $request, Event $event)
    {
        $event->update([
            'attendance_open' => true
        ]);
        return back()->withFragment('#absensi');
    }

    /**
     * Close attendance for students
     * 
     */
    public function close_attendance(Request $request, Event $event)
    {
        $event->update([
            'attendance_open' => false
        ]);
        return back()->withFragment('#absensi');
    }

    /**
     * Open registration for students
     * 
     */
    public function open_registration(Request $request, Event $event)
    {
        $event->update([
            'registration_end' => Carbon::now()->addWeek()
        ]);
        return back()->withFragment('#pendaftaran');
    }

    /**
     * Close registration for students
     * 
     */
    public function close_registration(Request $request, Event $event)
    {
        $event->update([
            'registration_end' => Carbon::now()->subSecond()
        ]);
        return back()->withFragment('#pendaftaran');
    }
}
