<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
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
}
