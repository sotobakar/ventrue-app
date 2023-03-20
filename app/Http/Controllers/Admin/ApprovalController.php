<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approver;
use App\Models\Faculty;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * List of faculties with approver data.
     * 
     */
    public function approvers_list(Request $request)
    {
        // Get all approvers
        $approvers = Approver::get();
        return view('admin.pages.approvers.index', [
            'approvers' => $approvers
        ]);
    }

    /**
     * Update approver data
     * 
     */
    public function update_approver(Request $request, Approver $approver)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email']
        ]);

        $approver->update($validated);

        return redirect()->route('admin.approvers');
    }

    /**
     * Approve request (url must be signed).
     * 
     */
    public function approve(Request $request)
    {
        
    }
}
