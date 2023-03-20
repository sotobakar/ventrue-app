<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
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
}
