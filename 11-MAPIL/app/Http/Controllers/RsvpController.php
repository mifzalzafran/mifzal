<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Rsvp;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'status' => 'required|in:hadir,tidak_hadir,mungkin',
            'note'   => 'nullable|string|max:255',
        ]);

        Rsvp::updateOrCreate(
            ['event_id' => $event->id, 'user_id' => auth()->id()],
            ['status' => $request->status, 'note' => $request->note]
        );

        return back()->with('success', 'RSVP berhasil disimpan!');
    }

    public function destroy(Event $event)
    {
        Rsvp::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->delete();

        return back()->with('success', 'RSVP dibatalkan.');
    }
}