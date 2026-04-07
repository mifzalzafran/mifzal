<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Room;
use App\Models\EventCategory;
use App\Models\EventAttachment;
use App\Notifications\EventStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $query = Event::with(['room', 'requester', 'category']);

        if (auth()->user()->isAdmin()) {
            // Admin lihat semua event
        } elseif (auth()->user()->isGuru()) {
            // Guru lihat event yang dia ajukan saja
            $query->where('requested_by', auth()->id());
        } else {
            // Siswa lihat event sendiri
            $query->where('requested_by', auth()->id());
        }

        $events = $query->latest()->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        // Mengambil data dari database agar dropdown tidak kosong
        $categories = EventCategory::all();
        $rooms = Room::all();

        return view('events.create', compact('categories', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'category_id'      => 'required|exists:event_categories,id',
            'room_id'          => 'nullable|exists:rooms,id',
            'start_datetime'   => 'required|date',
            'end_datetime'     => 'required|date|after:start_datetime',
            'description'      => 'nullable|string',
        nnty99    'target_audience'  => 'nullable|string|max:255',
            'attachments.*'    => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        // ⚡ CEK KONFLIK RUANGAN OTOMATIS
        if ($request->room_id) {
            $conflict = $this->checkRoomConflict(
                $request->room_id,
                $request->start_datetime,
                $request->end_datetime
            );

            if ($conflict) {
                return back()
                    ->withErrors(['room_id' =>
                        'Ruangan sudah digunakan pada waktu tersebut. ' .
                        'Silakan pilih ruangan atau waktu yang lain.'])
                    ->withInput();
            }
        }

        // Penentuan Status: 
        // 1. Jika klik tombol "Simpan Draft", status jadi draft
        // 2. Jika "Ajukan", Admin langsung approved, selain itu pending
        if ($request->status === 'draft') {
            $status = 'draft';
        } else {
            $status = auth()->user()->isAdmin() ? 'approved' : 'pending';
        }

        $event = Event::create(array_merge($validated, [
            'user_id'      => auth()->id(), // Tambahkan user_id pengaju
            'requested_by' => auth()->id(),
            'status'       => $status,
        ]));

        // Upload lampiran dokumen jika ada
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('event-attachments', 'public');
                EventAttachment::create([
                    'event_id'    => $event->id,
                    'file_name'   => $file->getClientOriginalName(),
                    'file_path'   => $path,
                    'file_type'   => 'proposal',
                    'file_size'   => $file->getSize(),
                    'uploaded_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil ' . ($status === 'draft' ? 'disimpan sebagai draft!' : 'diajukan!'));
    }

    public function show(Event $event)
    {
        $event->load(['room', 'requester', 'category', 'attachments', 'rsvps.user']);
        $userRsvp = $event->userRsvp(auth()->id());
        $isSubscribed = $event->isSubscribedBy(auth()->id());

        return view('events.show', compact('event', 'userRsvp', 'isSubscribed'));
    }

    public function edit(Event $event)
    {
        // Hanya pengaju atau admin yang boleh edit
        if (!auth()->user()->isAdmin() && $event->requested_by !== auth()->id()) {
            abort(403);
        }

        $rooms      = Room::where('is_active', true)->get();
        $categories = EventCategory::all();

        return view('events.edit', compact('event', 'rooms', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        if (!auth()->user()->isAdmin() && $event->requested_by !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'category_id'     => 'required|exists:event_categories,id',
            'room_id'         => 'nullable|exists:rooms,id',
            'start_datetime'  => 'required|date',
            'end_datetime'    => 'required|date|after:start_datetime',
            'description'     => 'nullable|string',
            'target_audience' => 'nullable|string|max:255',
        ]);

        if ($request->room_id) {
            $conflict = $this->checkRoomConflict(
                $request->room_id,
                $request->start_datetime,
                $request->end_datetime,
                $event->id
            );

            if ($conflict) {
                return back()
                    ->withErrors(['room_id' => 'Ruangan sudah digunakan pada waktu tersebut.'])
                    ->withInput();
            }
        }

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if (!auth()->user()->isAdmin() && $event->requested_by !== auth()->id()) {
            abort(403);
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    public function downloadAttachment(EventAttachment $attachment)
    {
        // Cek akses: hanya pengaju, guru, atau admin
        if (!auth()->user()->isAdmin() &&
            !auth()->user()->isGuru() &&
            $attachment->event->requested_by !== auth()->id()) {
            abort(403);
        }

        return response()->download(
            storage_path('app/public/' . $attachment->file_path),
            $attachment->file_name
        );
    }

    public function approve(Event $event)
    {
        if (auth()->user()->isGuru()) {
            $event->update([
                'status'      => 'approved_guru',
                'approved_by' => auth()->id(),
            ]);
        } else {
            // Admin final approve
            $event->update([
                'status'      => 'approved',
                'approved_by' => auth()->id(),
            ]);

            // Notifikasi ke semua subscriber event ini
            foreach ($event->subscriptions as $sub) {
                $sub->user->notify(new EventStatusNotification($event, 'approved'));
            }
        }

        // Notifikasi ke pengaju
        $event->requester->notify(
            new EventStatusNotification($event, $event->status)
        );

        return back()->with('success', 'Event berhasil disetujui!');
    }

    public function reject(Request $request, Event $event)
    {
        $request->validate(['reason' => 'required|string']);

        $event->update([
            'status'           => 'rejected',
            'rejection_reason' => $request->reason,
        ]);

        // Notifikasi ke pengaju
        $event->requester->notify(
            new EventStatusNotification($event, 'rejected')
        );

        return back()->with('success', 'Event ditolak.');
    }

    public function markSelesai(Request $request, Event $event)
    {
        $request->validate(['report_notes' => 'nullable|string']);

        $event->update([
            'status'       => 'selesai',
            'report_notes' => $report_notes,
        ]);

        return back()->with('success', 'Event ditandai selesai!');
    }

    // =====================================================
    // PRIVATE: Cek konflik ruangan
    // =====================================================
    private function checkRoomConflict($roomId, $start, $end, $excludeId = null)
    {
        $query = Event::where('room_id', $roomId)
            ->whereIn('status', ['pending', 'approved_guru', 'approved'])
            ->where(function ($q) use ($start, $end) {
                $q->where('start_datetime', '<', $end)
                  ->where('end_datetime', '>', $start);
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}