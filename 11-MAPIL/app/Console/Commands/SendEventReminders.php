<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature   = 'events:send-reminders';
    protected $description = 'Kirim reminder otomatis H-1 dan H-3 sebelum event';

    public function handle(): void
    {
        $this->info('Mengirim reminder event...');

        foreach ([1, 3] as $daysBefore) {
            $targetDate = now()->addDays($daysBefore)->toDateString();

            $events = Event::with('subscriptions.user')
                ->where('status', 'approved')
                ->whereDate('start_datetime', $targetDate)
                ->get();

            foreach ($events as $event) {
                $notified = 0;

                // Kirim ke semua subscriber
                foreach ($event->subscriptions as $sub) {
                    $sub->user->notify(
                        new EventReminderNotification($event, $daysBefore)
                    );
                    $notified++;
                }

                // Kirim juga ke pengaju event
                $event->requester->notify(
                    new EventReminderNotification($event, $daysBefore)
                );

                $this->info("Reminder H-{$daysBefore} terkirim untuk: {$event->title} ({$notified} subscriber)");
            }
        }

        $this->info('Selesai mengirim reminder!');
    }
}