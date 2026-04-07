<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Room; // Pastikan Model Room diimport
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Menampilkan halaman utama Kalender dengan statistik dan filter ruangan lengkap.
     */
    public function index()
    {
        // 1. Ambil data event
        $events = Event::all(); 

        // 2. AMBIL DATA RUANGAN (Solusi Fix Error Undefined $rooms)
        // Diperlukan untuk loop @foreach($rooms as $room) di view kalender
        $rooms = Room::where('is_active', true)->get();

        /** * 3. HITUNG STATISTIK DASHBOARD
         * Bagian ini memperbaiki semua error "Undefined variable" sebelumnya
         */

        // Total semua event
        $totalEvents = Event::count(); 
        
        // Event disetujui
        $approvedEvents = Event::where('status', 'approved')->count(); 

        // Event menunggu (pending)
        $pendingEvents = Event::where('status', 'pending')->count(); 

        // Event di bulan berjalan
        $thisMonthEvents = Event::whereMonth('start_datetime', Carbon::now()->month)
                                ->whereYear('start_datetime', Carbon::now()->year)
                                ->count();

        // 4. Kirim semua variabel ke view 'calendar.index'
        return view('calendar.index', compact(
            'events', 
            'rooms',
            'totalEvents', 
            'approvedEvents',
            'pendingEvents',
            'thisMonthEvents'
        ));
    }

    /**
     * Endpoint JSON untuk menyuplai data ke FullCalendar.
     */
    public function events()
    {
        // Hanya tampilkan event yang statusnya disetujui
        $events = Event::with(['category', 'room'])
            ->where('status', 'approved')
            ->get()
            ->map(function ($e) {
                return [
                    'id'              => $e->id,
                    'title'           => $e->title,
                    'start'           => $e->start_datetime->toIso8601String(),
                    'end'             => $e->end_datetime->toIso8601String(),
                    'backgroundColor' => $e->category->color ?? '#95A5A6',
                    'borderColor'     => $e->category->color ?? '#95A5A6',
                    'extendedProps'   => [
                        'category' => $e->category->name ?? '-',
                        'room'     => $e->room->name ?? 'N/A',
                    ],
                ];
            });

        $year = now()->year;
        $holidays = $this->getNationalHolidays($year);

        return response()->json($events->concat($holidays));
    }

    /**
     * Data Hardcoded Hari Libur Nasional Indonesia.
     */
    private function getNationalHolidays($year)
    {
        return collect([
            ['title' => '🇮🇩 Tahun Baru',       'start' => "$year-01-01", 'display' => 'background', 'backgroundColor' => '#FADBD8'],
            ['title' => '🇮🇩 Hari Buruh',       'start' => "$year-05-01", 'display' => 'background', 'backgroundColor' => '#FADBD8'],
            ['title' => '🇮🇩 Hari Pancasila',   'start' => "$year-06-01", 'display' => 'background', 'backgroundColor' => '#FADBD8'],
            ['title' => '🇮🇩 HUT RI',           'start' => "$year-08-17", 'display' => 'background', 'backgroundColor' => '#FADBD8'],
            ['title' => '🇮🇩 Hari Pahlawan',    'start' => "$year-11-10", 'display' => 'background', 'backgroundColor' => '#FADBD8'],
            ['title' => '🇮🇩 Hari Ibu',         'start' => "$year-12-22", 'display' => 'background', 'backgroundColor' => '#FADBD8'],
            ['title' => '🇮🇩 Natal',            'start' => "$year-12-25", 'display' => 'background', 'backgroundColor' => '#FADBD8'],
        ]);
    }
}