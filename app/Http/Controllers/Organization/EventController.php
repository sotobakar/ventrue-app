<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

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
}
