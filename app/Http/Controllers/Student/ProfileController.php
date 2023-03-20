<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show student profile
     * 
     */
    public function index(Request $request)
    {
        return view('student.pages.profile.index');
    }

    /**
     * Show verify page.
     * 
     */
    public function verifyPage(Request $request)
    {
        return view('student.pages.profile.verify');
    }

    /**
     * Submit verification
     * 
     */
    public function verify(Request $request)
    {
        $validated = $request->validate([
            'selfie' => ['required', 'image', 'max:10240'],
            'student_card' => ['required', 'image', 'max:10240'],
        ]);

        $imageService = new ImageService();

        // Store selfie and student_card
        $selfie_path = $imageService->store($validated['selfie'], 400, 600, "students/images/verifications");
        $student_card_path = $imageService->store($validated['student_card'], 400, 600, "students/images/verifications");

        // TODO: Store verification form to database.
        $request->user()->student->verification()->updateOrCreate([
            'student_id' => $request->user()->student->id
        ], [
            'selfie' => $selfie_path,
            'student_card' => $student_card_path,
            'status' => 'pending',
            'submitted_at' => now()
        ]);

        return redirect()->route('student.profile');
    }
}
