<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\UpdateStudentRequest;
use App\Models\Faculty;
use App\Models\Student;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * List of students
     * 
     */
    public function index(Request $request)
    {
        $students = Student::get();

        return view('admin.pages.students.index', [
            'students' => $students
        ]);
    }

    /**
     * Delete student
     * 
     */
    public function delete(Request $request, Student $student)
    {
        // Delete profile image if exists
        if (!is_null($student->image)) {
            if (Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
            }
        }

        // Delete student user (will cascade to delete student)
        $student->user->delete();

        // Return success response
        return redirect()->route('admin.students')->with('success', 'Mahasiswa ' . $student->name . ' berhasil dihapus.');
    }

    /**
     * Edit student page
     *
     */
    public function edit(Request $request, Student $student)
    {
        $faculties = Faculty::get();
        return view('admin.pages.students.edit', [
            'faculties' => $faculties,
            'student' => $student
        ]);
    }

    /**
     * Update student data
     * 
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->validated();

        $user = $student->user;

        // Check email and password, change if they exist
        if (!is_null($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (!is_null($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Check image, replace if image exist
        if (isset($validated['image'])) {
            $imagePath = $this->imageService->storeAndReplace($validated['image'], 400, 600, 'students/images', $student->image);

            $validated['image'] = $imagePath;
        }

        // Update student
        $student->update($validated);

        return redirect()->route('admin.students')->with('success', 'Mahasiswa ' . $student->name . ' berhasil diupdate.');
    }
}
