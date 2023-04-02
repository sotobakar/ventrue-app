<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\HighlightedEvent;
use App\Models\Organization;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $contents = HighlightedEvent::get();
        $eventsCount = Event::count();
        $organizationsCount = Organization::count();
        $studentsCount = Student::count();
        $statistics = [
            'eventsCount' => $eventsCount,
            'organizationsCount' => $organizationsCount,
            'studentsCount' => $studentsCount
        ];
        return view('student.pages.index', [
            'contents' => $contents,
            'statistics' => $statistics
        ]);
    }
}
