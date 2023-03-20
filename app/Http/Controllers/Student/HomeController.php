<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\HighlightedEvent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $contents = HighlightedEvent::get();
        return view('student.pages.index', [
            'contents' => $contents
        ]);
    }
}
