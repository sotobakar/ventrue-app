<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\UpdateEventRequest;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Location;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EventController extends Controller
{
    /**
     * List of events
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
            ->orderBy('start', 'asc')
            ->paginate(10)
            ->appends(request()->query());

        return view('admin.pages.events.index', [
            'events' => $events
        ]);
    }

    /**
     * Find event, return in json
     * 
     */
    public function find(Request $request)
    {
        $event = Event::find($request->input('id'));
        if ($event) {
            return response()->json([
                'message' => 'Acara ditemukan',
                'data' => $event
            ]);
        } else {
            return response()->json([
                'message' => 'Acara tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Edit event
     * 
     */
    public function edit(Request $request, Event $event)
    {
        $types = config('constants.EVENT.TYPES');

        $locations = Location::get();

        $event_categories = EventCategory::get();
        return view('admin.pages.events.edit', [
            'event' => $event,
            'types' => $types,
            'locations' => $locations,
            'event_categories' => $event_categories
        ]);
    }

    /**
     * Update event
     * 
     */
    public function update(UpdateEventRequest $request, Event $event, ImageService $imageService)
    {
        $data = $request->validated();
        if (isset($data['banner'])) {
            $data['banner'] = $imageService->storeAndReplace($data['banner'], config('constants.EVENT.BANNER.WIDTH'), config('constants.EVENT.BANNER.HEIGHT'), 'events/images', $event->banner);
        }

        // Change to event_category_id
        $data['event_category_id'] = $data['event_category'];

        if (!isset($data['location'])) {
            $location = Location::where('name', $data['location_select'])->first();

            if ($location) {
                $data['location'] = $location->name;
                $data['location_id'] = $location->id;
            }
        } else {
            $data['location_id'] = null;
        }

        $event->update($data);

        return back()->with('success', 'Berhasil mengupdate event.');
    }

    /**
     * Delete event
     * 
     */
    public function delete(Request $request, Event $event)
    {
        // Delete event banner if exists
        if (!is_null($event->banner)) {
            if (Storage::disk('public')->exists($event->banner)) {
                Storage::disk('public')->delete($event->banner);
            }
        }

        // TODO: Delete materials if exists

        $event->delete();
        return redirect()->route('admin.events')->with('success', 'Berhasil menghapus event.');
    }
}
