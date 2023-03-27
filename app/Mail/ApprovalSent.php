<?php

namespace App\Mail;

use App\Models\Approver;
use App\Models\Event;
use App\Models\EventApproval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalSent extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $approval;
    public $approver;
    public $approveLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event, EventApproval $approval, Approver $approver, $approveLink)
    {
        $this->event = $event;
        $this->approval = $approval;
        $this->approver = $approver;
        $this->approveLink = $approveLink;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Permintaan Persetujuan dan Verifikasi Acara ORMAWA',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'organization.emails.approval',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // Map attachments from approval files
        return $this->approval->files->map(function ($file) {
            return Attachment::fromStorageDisk('public', $file->path);
        })->all();
    }
}
