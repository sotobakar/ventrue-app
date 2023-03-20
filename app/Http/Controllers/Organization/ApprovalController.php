<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Approval\SendApprovalRequest;
use App\Http\Requests\Organization\Approval\ShowApprovalRequest;
use App\Models\Approver;
use App\Models\Event;
use App\Models\EventApproval;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * List of approval request.
     * 
     */
    public function index(Request $request)
    {
        $event_ids = $request->user()->organization->events->pluck('id')->all();
        $approvals = EventApproval::whereIn('event_id', $event_ids)->get();
        return view('organization.pages.approvals.index', [
            'approvals' => $approvals
        ]);
    }

    /**
     * Show page for approval request creation.
     * 
     */
    public function create(Request $request)
    {
        if ($request->has('id')) {
            $event = Event::where('id', $request->input('id'))
                ->where('organization_id', $request->user()->organization->id)
                ->first();
        }
        
        return view('organization.pages.approvals.create', [
            'event' => $event ?? null
        ]);
    }

    /**
     * Create approval request and store to database.
     * 
     */
    public function store(Request $request)
    {
    }

    /**
     * Send approval request to approver (with signed urls).
     * 
     */
    public function send(SendApprovalRequest $request, EventApproval $approval)
    {
    }

    /**
     * Detail page of approval request.
     * 
     */
    public function show(ShowApprovalRequest $request, EventApproval $approval)
    {
        dd("Test");
    }
}
