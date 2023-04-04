<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Show student profile
     * 
     */
    public function index(Request $request)
    {
        $id = $request->user()->student->id;

        // Statistics
        $eventsRegistered = DB::table('event_registrations')
            ->where('student_id', $id)
            ->count();
        $eventsAttended = DB::table('event_attendances')
            ->where('student_id', $id)
            ->count();
        $feedbacksSubmitted = DB::table('event_feedback')
            ->where('student_id', $id)
            ->count();

        $statistics = [
            'eventsRegistered' => $eventsRegistered,
            'eventsAttended' => $eventsAttended,
            'feedbacksSubmitted' => $feedbacksSubmitted
        ];

        $lastThreeEvents = DB::table('event_registrations as er')
            ->select('er.registered_at', 'e.id', 'e.name', 'e.banner', 'e.start', 'e.end')
            ->join('events as e', 'er.event_id', '=', 'e.id')
            ->where('er.student_id', $id)
            ->orderBy('er.registered_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($lastThreeEvents as $event) {
            $event->status = Event::getStatus($event->start, $event->end);
        }

        return view('student.pages.profile.index', [
            'statistics' => $statistics,
            'lastThreeEvents' => $lastThreeEvents
        ]);
    }

    /**
     * Update student profile image
     * 
     */
    public function updateImage(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:10240']
        ]);

        $student = $request->user()->student;

        $validated['image'] = $this->imageService->storeAndReplace($validated['image'], config('constants.STUDENT.PROFILE.IMAGE.WIDTH'), config('constants.STUDENT.PROFILE.IMAGE.HEIGHT'), 'students/images', $student->image);

        $student->update([
            'image' => $validated['image']
        ]);

        return back()->with('success', 'Foto profil berhasil diupdate.');
    }
}
