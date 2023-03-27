<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Approval\SendApprovalRequest;
use App\Http\Requests\Organization\Approval\ShowApprovalRequest;
use App\Http\Requests\Organization\Approval\StoreApprovalRequest;
use App\Mail\ApprovalSent;
use App\Models\Approver;
use App\Models\Event;
use App\Models\EventApproval;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;

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

            if ($event) {
                return view('organization.pages.approvals.create', [
                    'event' => $event
                ]);
            } else {
                return redirect()->route('organization.approvals.create')->withErrors(['Acara tidak ditemukan']);
            }
        }

        return view('organization.pages.approvals.create');
    }

    /**
     * Create approval request and store to database.
     * 
     */
    public function store(StoreApprovalRequest $request, ImageService $imageService)
    {
        $data = $request->validated();

        // If approval exists then cannot create
        $exists = EventApproval::where('event_id', $data['id'])->exists();
        if ($exists) {
            return back()->withErrors(['Persetujuan sudah pernah dibuat']);
        }

        // Create approval
        $eventApproval = EventApproval::create([
            'event_id' => $data['id']
        ]);

        // Store approval files
        foreach ($data['file_pendukung'] as $file) {
            $name = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs(config('constants.EVENT.APPROVAL.STORAGE.path'), $name, 'public');

            $eventApproval->files()->create([
                'name' => $name,
                'path' => $filePath
            ]);
        }

        // Redirect to approval page
        return redirect()->route('organization.approvals')->with('success', 'Berhasil membuat approval');
    }

    /**
     * Send approval request to approver (with signed urls).
     * 
     */
    public function send(SendApprovalRequest $request, EventApproval $approval)
    {
        $approver = Approver::where('faculty_id', $approval->event->faculty_id)->first();

        // Generate signed URL to approve route
        $approveLink = URL::temporarySignedRoute('admin.approvals.approve', now()->addDay(), ['approval' => $approval->id]);

        // Check if sent last 24 hours
        $executed = RateLimiter::attempt(
            'send-approval-request:' . $approval->event->id,
            $perHour = 1,
            function () use ($approver, $approval, $approveLink) {
                // Send email
                Mail::to($approver->email)->send(new ApprovalSent($approval->event, $approval, $approver, $approveLink));
            },
            3600
        );

        if (!$executed) {
            return back()->withErrors(['Email hanya bisa dikirim setiap satu jam. Silahkan coba lagi nanti.']);
        }


        return back()->with('success', 'Permohonan persetujuan untuk acara ' . $approval->event->name . ' berhasil dikirim ke penyetuju.');
    }

    /**
     * Detail page of approval request.
     * 
     */
    public function show(ShowApprovalRequest $request, EventApproval $approval)
    {
        $approver = Approver::where('faculty_id', $approval->event->faculty_id)->first();

        return view('organization.pages.approvals.show', [
            'approval' => $approval,
            'approver' => $approver,
            'event' => $approval->event
        ]);
    }
}
