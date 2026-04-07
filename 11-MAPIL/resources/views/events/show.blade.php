@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">

    {{-- Header Event --}}
    <div class="bg-white rounded-lg shadow p-6 mb-4">
        <div class="flex justify-between items-start">
            <div>
                <span class="inline-block px-2 py-1 text-xs rounded text-white mb-2"
                      style="background-color: {{ $event->category->color ?? '#95A5A6' }}">
                    {{ $event->category->name ?? 'Umum' }}
                </span>
                <h1 class="text-2xl font-bold">{{ $event->title }}</h1>
                <p class="text-gray-500 mt-1">
                    📅 {{ $event->start_datetime->format('l, d F Y') }}
                    ⏰ {{ $event->start_datetime->format('H:i') }} - {{ $event->end_datetime->format('H:i') }} WIB
                </p>
                <p class="text-gray-500">📍 {{ $event->room->name ?? 'Tanpa ruangan' }}</p>
                @if($event->target_audience)
                    <p class="text-gray-500">👥 {{ $event->target_audience }}</p>
                @endif
            </div>
            <div>
                @if($event->status == 'approved')
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded text-sm font-medium">✅ Disetujui</span>
                @elseif($event->status == 'pending')
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded text-sm font-medium">⏳ Menunggu Approval</span>
                @elseif($event->status == 'rejected')
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded text-sm font-medium">❌ Ditolak</span>
                @elseif($event->status == 'selesai')
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm font-medium">🏁 Selesai</span>
                @endif
            </div>
        </div>

        @if($event->description)
            <div class="mt-4 text-gray-700 border-t pt-4">
                {!! nl2br(e($event->description)) !!}
            </div>
        @endif

        @if($event->status == 'rejected' && $event->rejection_reason)
            <div class="mt-4 bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm">
                <strong>Alasan penolakan:</strong> {{ $event->rejection_reason }}
            </div>
        @endif
    </div>

    {{-- Tombol Aksi untuk Siswa/User: Subscribe & RSVP --}}
    @if($event->status == 'approved')
    <div class="grid grid-cols-2 gap-4 mb-4">

        {{-- Subscribe / Unsubscribe --}}
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-2">🔔 Reminder Event</h3>
            <form method="POST" action="{{ route('events.subscribe', $event) }}">
                @csrf
                <button type="submit"
                        class="{{ $isSubscribed ? 'bg-gray-200 text-gray-700' : 'bg-blue-600 text-white' }}
                               w-full py-2 rounded hover:opacity-80">
                    {{ $isSubscribed ? '🔕 Berhenti Subscribe' : '🔔 Subscribe & Dapatkan Reminder' }}
                </button>
            </form>
            <p class="text-xs text-gray-500 mt-1">
                Subscriber mendapat notifikasi H-3 dan H-1 sebelum event.
            </p>
        </div>

        {{-- RSVP --}}
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-2">✋ Konfirmasi Kehadiran (RSVP)</h3>
            @if($userRsvp)
                <p class="text-sm text-gray-600 mb-2">
                    Status kamu:
                    <strong>
                        {{ $userRsvp->status == 'hadir' ? '✅ Hadir' : ($userRsvp->status == 'tidak_hadir' ? '❌ Tidak Hadir' : '🤔 Mungkin') }}
                    </strong>
                </p>
                <form method="POST" action="{{ route('rsvp.destroy', $event) }}">
                    @csrf
                    @method('DELETE')
                    <button class="w-full bg-gray-200 text-gray-700 py-1 rounded text-sm hover:bg-gray-300">
                        Batalkan RSVP
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('rsvp.store', $event) }}" class="space-y-2">
                    @csrf
                    <select name="status" class="w-full border rounded px-2 py-1 text-sm">
                        <option value="hadir">✅ Hadir</option>
                        <option value="tidak_hadir">❌ Tidak Hadir</option>
                        <option value="mungkin">🤔 Mungkin</option>
                    </select>
                    <input type="text" name="note" placeholder="Catatan (opsional)"
                           class="w-full border rounded px-2 py-1 text-sm">
                    <button class="w-full bg-green-600 text-white py-1 rounded text-sm hover:bg-green-700">
                        Konfirmasi
                    </button>
                </form>
            @endif
        </div>
    </div>
    @endif

    {{-- Lampiran Dokumen --}}
    @if($event->attachments->count() > 0)
    <div class="bg-white rounded-lg shadow p-4 mb-4">
        <h3 class="font-semibold mb-3">📎 Dokumen Lampiran</h3>
        <ul class="space-y-2">
            @foreach($event->attachments as $attachment)
            <li class="flex items-center justify-between border rounded px-3 py-2 text-sm">
                <span>📄 {{ $attachment->file_name }}</span>
                <a href="{{ route('attachments.download', $attachment) }}"
                   class="text-blue-600 hover:underline text-xs">
                    ⬇ Unduh
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Daftar RSVP --}}
    @if($event->rsvps->count() > 0 && (auth()->user()->isAdmin() || auth()->user()->isGuru()))
    <div class="bg-white rounded-lg shadow p-4 mb-4">
        <h3 class="font-semibold mb-3">
            👥 Daftar RSVP ({{ $event->rsvps->count() }} orang)
        </h3>
        <div class="space-y-1">
            @foreach($event->rsvps as $rsvp)
            <div class="flex items-center justify-between text-sm border-b py-1">
                <span>{{ $rsvp->user->name }}</span>
                <span class="{{ $rsvp->status == 'hadir' ? 'text-green-600' : ($rsvp->status == 'tidak_hadir' ? 'text-red-600' : 'text-yellow-600') }}">
                    {{ $rsvp->status == 'hadir' ? '✅ Hadir' : ($rsvp->status == 'tidak_hadir' ? '❌ Tidak Hadir' : '🤔 Mungkin') }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Aksi Admin/Guru --}}
    @if((auth()->user()->isAdmin() || auth()->user()->isGuru()) && $event->status == 'pending')
    <div class="bg-white rounded-lg shadow p-4 flex gap-3">
        <form action="{{ route('events.approve', $event) }}" method="POST" class="flex-1">
            @csrf
            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700"
                    onclick="return confirm('Setujui event ini?')">
                ✅ Setujui Event
            </button>
        </form>
        <button onclick="document.getElementById('rejectModal').classList.remove('hidden')"
                class="flex-1 bg-red-600 text-white py-2 rounded hover:bg-red-700">
            ❌ Tolak Event
        </button>
    </div>
    @endif

    {{-- Tandai Selesai (untuk pengaju atau admin) --}}
    @if($event->status == 'approved' &&
        ($event->requested_by == auth()->id() || auth()->user()->isAdmin()))
    <div class="bg-white rounded-lg shadow p-4 mt-4">
        <h3 class="font-semibold mb-2">📋 Tandai Event Selesai & Input Laporan</h3>
        <form method="POST" action="{{ route('events.selesai', $event) }}">
            @csrf
            <textarea name="report_notes" rows="3"
                      class="w-full border rounded px-3 py-2 text-sm mb-2"
                      placeholder="Tulis catatan laporan kegiatan (opsional)..."></textarea>
            <button class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                🏁 Tandai Selesai
            </button>
        </form>
    </div>
    @endif
</div>

{{-- Modal Tolak --}}
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">Alasan Penolakan</h2>
        <form action="{{ route('events.reject', $event) }}" method="POST">
            @csrf
            <textarea name="reason" required rows="3"
                      class="w-full border rounded px-3 py-2 mb-4"
                      placeholder="Masukkan alasan penolakan..."></textarea>
            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 bg-red-600 text-white py-2 rounded hover:bg-red-700">
                    Tolak Event
                </button>
                <button type="button"
                        onclick="document.getElementById('rejectModal').classList.add('hidden')"
                        class="flex-1 bg-gray-500 text-white py-2 rounded hover:bg-gray-600">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection