<?php

namespace App\Console\Commands;

use App\Mail\RemindEvent;
use App\Models\EventReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RemindEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remindevents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for event reminders and send emails to the user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $event_reminders = EventReminder::where('remind_at', '<', Carbon::now())->get();

        foreach ($event_reminders as $reminder) {
            Mail::to($reminder->student->user)->send(new RemindEvent($reminder->event));
        }

        // Delete all event reminders that was sent.
        EventReminder::whereIn('id', $event_reminders->pluck('id')->all())->delete();
        Log::info(Carbon::now()->toDateTimeString() . ': Selesai mengirim event reminder');
    }
}
