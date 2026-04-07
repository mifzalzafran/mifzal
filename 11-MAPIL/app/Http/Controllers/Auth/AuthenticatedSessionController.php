<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();
    
    // Gunakan strtolower untuk menghindari error jika di database ada huruf kapital
    $role = strtolower($user->role); 

    // Redirect Berdasarkan Role
    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } 
    
    if ($role === 'guru' || $role === 'panitia') {
        return redirect()->route('guru.dashboard');
    }

    if ($role === 'siswa') {
        return redirect()->route('siswa.dashboard');
    }

    // Fallback terakhir jika role tidak dikenali
    return redirect()->route('calendar.index');
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}