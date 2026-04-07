<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Room;
use App\Models\EventCategory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalApproved  = Event::where('status', 'approved')->count();
        $pendingEvents  = Event::whereIn('status', ['pending', 'approved_guru'])->count();
        $totalRooms     = Room::where('is_active', true)->count();
        $totalUsers     = User::count();

        // Statistik per kategori bulan ini
        $statsPerCategory = EventCategory::withCount([
            'events as event_count' => function ($q) {
                $q->where('status', 'approved')
                  ->whereMonth('start_datetime', now()->month);
            }
        ])->get();

        $recentEvents = Event::with(['requester', 'room', 'category'])
            ->whereIn('status', ['pending', 'approved_guru'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalApproved',
            'pendingEvents',
            'totalRooms',
            'totalUsers',
            'statsPerCategory',
            'recentEvents'
        ));
    }
}