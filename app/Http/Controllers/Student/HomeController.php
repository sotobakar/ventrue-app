<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::limit(5)->get();
        return view('student.pages.index', [
            'events' => $events
        ]);
    }
}
