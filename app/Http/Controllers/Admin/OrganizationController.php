<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * List of organizations.
     * 
     */
    public function index(Request $request)
    {
        $organizations = Organization::get();
        return view('admin.pages.organizations.index', [
            'organizations' => $organizations
        ]);
    }
}
