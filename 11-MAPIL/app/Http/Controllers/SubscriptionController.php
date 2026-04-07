<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSubscription;

class SubscriptionController extends Controller
{
    public function toggle(Event $event)
    {
        $exists = EventSubscription::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($exists) {
            $exists->delete();
            $message = 'Berhasil berhenti subscribe event ini.';
        } else {
            EventSubscription::create([
                'event_id' => $event->id,
                'user_id'  => auth()->id(),
            ]);
            $message = 'Berhasil subscribe event! Kamu akan mendapat reminder.';
        }

        return back()->with('success', $message);
    }
}