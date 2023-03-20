<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HighlightedEvent;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * View content in landing page.
     * 
     */
    public function index(Request $request) {
        $highlighted_events = HighlightedEvent::get();
        return view('admin.pages.content.index', [
            'contents' => $highlighted_events
        ]);
    }

    /**
     * Update the event in content in landing page
     * 
     */
    public function update(Request $request, HighlightedEvent $content) {
        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,id']
        ]);

        $content->update([
            'event_id' => $validated['event_id']
        ]);

        return redirect()->route('admin.content');
    }
}
