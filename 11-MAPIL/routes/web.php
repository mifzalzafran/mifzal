<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes - SMKN 1 Purwokerto
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA
Route::get('/', function () {
    return redirect()->route('calendar.index');
});

// 2. RUTE UNTUK SEMUA USER YANG LOGIN (Siswa, Guru, Admin)
Route::middleware('auth')->group(function () {
    
    // Kalender & Event Umum
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
    Route::resource('events', EventController::class);

    // RSVP & Subscribe (Interaksi Event)
    Route::post('events/{event}/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');
    Route::delete('events/{event}/rsvp', [RsvpController::class, 'destroy'])->name('rsvp.destroy');
    Route::post('events/{event}/subscribe', [SubscriptionController::class, 'toggle'])->name('events.subscribe');

    // Notifikasi Sistem
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');

    // Laporan (Global)
    Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
    Route::get('/laporan/export-pdf', [ReportController::class, 'exportPdf'])->name('report.pdf');
    Route::get('/laporan/export-excel', [ReportController::class, 'exportExcel'])->name('report.excel');

    // Pengaturan Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. RUTE KHUSUS ADMIN (Prefix: /admin)
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('users', UserController::class);
        Route::resource('rooms', RoomController::class);
        Route::resource('categories', CategoryController::class);
        
        Route::post('/events/{event}/approve', [EventController::class, 'approve'])->name('events.approve');
        Route::post('/events/{event}/reject', [EventController::class, 'reject'])->name('events.reject');
        
        Route::get('attachments/{attachment}/download', [EventController::class, 'downloadAttachment'])->name('attachments.download'); 
    }); 

// 4. RUTE KHUSUS GURU & PANITIA (Prefix: /guru)
Route::middleware(['auth', 'guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('guru.dashboard'); 
        })->name('dashboard');
    });

// 5. RUTE KHUSUS SISWA (Prefix: /siswa) - TAMBAHAN BARU
Route::middleware(['auth', 'siswa']) // Gunakan middleware siswa yang sudah didaftarkan
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        // Dashboard Utama Siswa (Blok Ungu ala Dribbble)
        Route::get('/dashboard', function () {
            return view('siswa.dashboard'); 
        })->name('dashboard');

        // Tambahkan rute khusus siswa lainnya di sini jika diperlukan
    });

    Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});

// 6. AUTHENTICATION ROUTES
require __DIR__.'/auth.php';