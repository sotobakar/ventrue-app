<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard page.
     * 
     */
    public function index(Request $request) {
        return view('organization.pages.index', [
            'user' => $request->user()
        ]);
    }
}
