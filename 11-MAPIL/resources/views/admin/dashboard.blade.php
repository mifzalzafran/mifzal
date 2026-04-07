<x-app-layout>
<x-slot name="header">
    {{-- Header slot kosong, kita pakai custom header di dalam konten --}}
</x-slot>

{{-- ===== INLINE STYLES & FONT ===== --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap');

    :root {
        --blue-50:  #eff6ff;
        --blue-100: #dbeafe;
        --blue-200: #bfdbfe;
        --blue-400: #60a5fa;
        --blue-500: #3b82f6;
        --blue-600: #2563eb;
        --blue-700: #1d4ed8;
        --blue-800: #1e40af;
        --blue-900: #1e3a8a;
        --blue-950: #172554;
    }

    .dash-root * { font-family: 'Plus Jakarta Sans', sans-serif; }
    .dash-root .mono { font-family: 'DM Mono', monospace; }

    /* Sidebar */
    .dash-sidebar {
        width: 260px;
        min-height: 100vh;
        background: var(--blue-950);
        position: fixed;
        top: 0; left: 0;
        display: flex;
        flex-direction: column;
        z-index: 40;
        border-right: 1px solid rgba(255,255,255,0.06);
    }

    .sidebar-logo {
        padding: 28px 24px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }

    .sidebar-logo .logo-badge {
        width: 40px; height: 40px;
        background: var(--blue-500);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 12px;
        box-shadow: 0 4px 14px rgba(59,130,246,0.45);
    }

    .sidebar-logo h1 {
        font-size: 15px; font-weight: 800;
        color: white; letter-spacing: -0.3px;
        margin: 0 0 2px;
    }

    .sidebar-logo p {
        font-size: 11px; color: rgba(255,255,255,0.38);
        font-weight: 500; margin: 0;
        letter-spacing: 0.02em;
    }

    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

    .nav-section-label {
        font-size: 10px; font-weight: 700;
        color: rgba(255,255,255,0.25);
        letter-spacing: 0.12em; text-transform: uppercase;
        padding: 8px 12px 6px;
        margin-top: 8px;
    }

    .nav-item {
        display: flex; align-items: center; gap: 12px;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 13.5px; font-weight: 600;
        color: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.18s ease;
        text-decoration: none;
        margin-bottom: 2px;
    }

    .nav-item:hover {
        background: rgba(255,255,255,0.07);
        color: rgba(255,255,255,0.85);
    }

    .nav-item.active {
        background: var(--blue-600);
        color: white;
        box-shadow: 0 4px 14px rgba(37,99,235,0.4);
    }

    .nav-item .nav-icon {
        width: 18px; height: 18px;
        flex-shrink: 0; opacity: 0.8;
    }

    .nav-item.active .nav-icon { opacity: 1; }

    .sidebar-footer {
        padding: 16px 12px;
        border-top: 1px solid rgba(255,255,255,0.07);
    }

    .user-chip {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px;
        border-radius: 12px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
    }

    .user-avatar {
        width: 34px; height: 34px; border-radius: 10px;
        background: var(--blue-600);
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 800; color: white;
        flex-shrink: 0;
    }

    .user-chip .user-name {
        font-size: 12.5px; font-weight: 700; color: white;
        line-height: 1.2; margin: 0;
    }

    .user-chip .user-role {
        font-size: 10.5px; color: rgba(255,255,255,0.38);
        font-weight: 500; margin: 0;
    }

    /* Main content */
    .dash-main {
        margin-left: 260px;
        min-height: 100vh;
        background: #f0f4ff;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(219,234,254,0.6) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(191,219,254,0.35) 0%, transparent 40%);
    }

    /* Top bar */
    .topbar {
        background: white;
        border-bottom: 1px solid #e8edf8;
        padding: 0 36px;
        height: 64px;
        display: flex; align-items: center; justify-content: space-between;
        position: sticky; top: 0; z-index: 30;
    }

    .topbar-title {
        font-size: 17px; font-weight: 800;
        color: var(--blue-950); letter-spacing: -0.3px;
    }

    .topbar-subtitle {
        font-size: 12px; color: #94a3b8; font-weight: 500; margin-top: 1px;
    }

    .topbar-actions { display: flex; align-items: center; gap: 10px; }

    .topbar-btn {
        display: flex; align-items: center; gap: 7px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 12.5px; font-weight: 700;
        border: none; cursor: pointer;
        transition: all 0.18s;
    }

    .btn-outline {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }
    .btn-outline:hover { background: #e2e8f0; }

    .btn-primary {
        background: var(--blue-600);
        color: white;
        box-shadow: 0 3px 10px rgba(37,99,235,0.3);
    }
    .btn-primary:hover { background: var(--blue-700); transform: translateY(-1px); }

    /* Content area */
    .dash-content { padding: 32px 36px; }

    /* Stat cards */
    .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }

    .stat-card {
        border-radius: 20px;
        padding: 24px;
        position: relative; overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover { transform: translateY(-3px); }

    .stat-card-primary {
        background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-800) 100%);
        box-shadow: 0 8px 32px rgba(37,99,235,0.35);
        color: white;
    }

    .stat-card-success {
        background: linear-gradient(135deg, #059669 0%, #065f46 100%);
        box-shadow: 0 8px 32px rgba(5,150,105,0.3);
        color: white;
    }

    .stat-card-warning {
        background: linear-gradient(135deg, #d97706 0%, #92400e 100%);
        box-shadow: 0 8px 32px rgba(217,119,6,0.3);
        color: white;
    }

    .stat-card-indigo {
        background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%);
        box-shadow: 0 8px 32px rgba(79,70,229,0.3);
        color: white;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: -40px; right: 20px;
        width: 80px; height: 80px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    .stat-icon-wrap {
        width: 44px; height: 44px;
        border-radius: 14px;
        background: rgba(255,255,255,0.18);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
    }

    .stat-icon-wrap svg { width: 22px; height: 22px; color: white; }

    .stat-value {
        font-size: 38px; font-weight: 900; line-height: 1;
        letter-spacing: -2px; color: white;
        margin-bottom: 6px;
        position: relative; z-index: 1;
    }

    .stat-label {
        font-size: 11px; font-weight: 700;
        color: rgba(255,255,255,0.65);
        letter-spacing: 0.1em; text-transform: uppercase;
        position: relative; z-index: 1;
    }

    .stat-trend {
        position: absolute; top: 20px; right: 20px;
        font-size: 11px; font-weight: 700;
        background: rgba(255,255,255,0.18);
        color: white; border-radius: 8px;
        padding: 4px 9px;
        z-index: 1;
    }

    /* Section cards */
    .section-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #e8edf8;
        overflow: hidden;
        box-shadow: 0 2px 20px rgba(30,58,138,0.04);
    }

    .section-header {
        padding: 20px 24px 16px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; justify-content: space-between;
    }

    .section-header h3 {
        font-size: 15px; font-weight: 800;
        color: var(--blue-950); letter-spacing: -0.2px;
        display: flex; align-items: center; gap: 10px;
        margin: 0;
    }

    .section-header h3 .icon-wrap {
        width: 32px; height: 32px;
        background: var(--blue-50);
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
    }

    .section-header h3 .icon-wrap svg {
        width: 16px; height: 16px;
        color: var(--blue-600);
    }

    .see-all-btn {
        font-size: 12px; font-weight: 700;
        color: var(--blue-600); background: var(--blue-50);
        border: none; padding: 6px 14px;
        border-radius: 8px; cursor: pointer;
        text-decoration: none;
        transition: background 0.15s;
    }
    .see-all-btn:hover { background: var(--blue-100); }

    /* Category pills */
    .cat-grid { display: flex; flex-wrap: wrap; gap: 10px; padding: 20px 24px; }

    .cat-pill {
        display: flex; align-items: center; gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        background: #f8faff;
        border: 1.5px solid #e2e8f0;
        font-size: 12.5px; font-weight: 700;
        color: #475569;
        transition: all 0.15s;
    }

    .cat-pill:hover {
        border-color: var(--blue-300);
        background: var(--blue-50);
        color: var(--blue-700);
        transform: translateY(-1px);
    }

    .cat-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }

    .cat-count {
        background: var(--blue-100);
        color: var(--blue-700);
        font-size: 11px; font-weight: 800;
        padding: 2px 8px; border-radius: 20px;
        margin-left: 2px;
    }

    /* Table */
    .dash-table { width: 100%; border-collapse: collapse; }

    .dash-table thead tr {
        background: #f8faff;
    }

    .dash-table thead th {
        padding: 13px 24px;
        font-size: 10.5px; font-weight: 800;
        color: #94a3b8;
        letter-spacing: 0.1em; text-transform: uppercase;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }

    .dash-table tbody tr {
        border-bottom: 1px solid #f8faff;
        transition: background 0.15s;
    }

    .dash-table tbody tr:hover { background: #f8faff; }
    .dash-table tbody tr:last-child { border-bottom: none; }

    .dash-table td {
        padding: 15px 24px;
        font-size: 13px;
        color: #334155;
        vertical-align: middle;
    }

    .event-title {
        font-weight: 700; color: var(--blue-700);
        font-size: 13.5px;
    }

    .badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11px; font-weight: 700;
        padding: 4px 11px; border-radius: 20px;
        letter-spacing: 0.03em;
    }

    .badge-pending {
        background: #fef3c7; color: #92400e;
        border: 1px solid #fde68a;
    }

    .badge-approved {
        background: #dcfce7; color: #166534;
        border: 1px solid #bbf7d0;
    }

    .badge-rejected {
        background: #fee2e2; color: #991b1b;
        border: 1px solid #fecaca;
    }

    .badge-dot {
        width: 6px; height: 6px; border-radius: 50%;
    }

    .badge-pending .badge-dot   { background: #f59e0b; }
    .badge-approved .badge-dot  { background: #22c55e; }
    .badge-rejected .badge-dot  { background: #ef4444; }

    .empty-state {
        text-align: center;
        padding: 60px 24px;
        color: #94a3b8;
    }

    .empty-state svg {
        width: 48px; height: 48px;
        margin: 0 auto 16px;
        color: #cbd5e1;
        display: block;
    }

    .empty-state p {
        font-size: 14px; font-weight: 600; margin: 0 0 4px;
        color: #64748b;
    }

    .empty-state span {
        font-size: 12.5px; color: #94a3b8;
    }

    /* 2-column grid */
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; }

    /* Quick action cards */
    .quick-actions { display: grid; grid-template-columns: 1fr; gap: 10px; padding: 16px 20px; }

    .qa-item {
        display: flex; align-items: center; gap: 14px;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1.5px solid #e8edf8;
        background: #f8faff;
        cursor: pointer;
        transition: all 0.18s;
        text-decoration: none;
    }

    .qa-item:hover {
        border-color: var(--blue-400);
        background: var(--blue-50);
        transform: translateX(4px);
    }

    .qa-icon {
        width: 40px; height: 40px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .qa-icon svg { width: 18px; height: 18px; }

    .qa-label { font-size: 13px; font-weight: 700; color: #1e293b; margin: 0 0 2px; }
    .qa-desc  { font-size: 11.5px; color: #94a3b8; margin: 0; }
    .qa-arrow { margin-left: auto; color: #cbd5e1; }
    .qa-arrow svg { width: 16px; height: 16px; }

    /* Staggered fade-in */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .anim-1 { animation: slideUp 0.4s ease 0.0s both; }
    .anim-2 { animation: slideUp 0.4s ease 0.08s both; }
    .anim-3 { animation: slideUp 0.4s ease 0.16s both; }
    .anim-4 { animation: slideUp 0.4s ease 0.24s both; }
    .anim-5 { animation: slideUp 0.4s ease 0.32s both; }
    .anim-6 { animation: slideUp 0.4s ease 0.40s both; }

    /* Notification dot */
    .notif-dot {
        width: 8px; height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid white;
        position: absolute;
        top: -2px; right: -2px;
    }

    /* Responsive hide sidebar on mobile */
    @media (max-width: 900px) {
        .dash-sidebar { display: none; }
        .dash-main { margin-left: 0; }
        .stat-grid { grid-template-columns: 1fr 1fr; }
        .two-col { grid-template-columns: 1fr; }
        .dash-content { padding: 20px 16px; }
        .topbar { padding: 0 16px; }
    }
</style>

<div class="dash-root" style="display:flex; min-height:100vh;">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="dash-sidebar">
        <div class="sidebar-logo">
            <div class="logo-badge">
                <svg width="22" height="22" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h1>Student Hub</h1>
            <p>SMKN 1 Purwokerto</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Utama</div>

            <a href="#" class="nav-item active">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="#" class="nav-item" style="position:relative;">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Pengajuan Event
                @if($pendingEvents > 0)
                    <span style="margin-left:auto; background:#ef4444; color:white; font-size:10px; font-weight:800; padding:2px 8px; border-radius:20px;">{{ $pendingEvents }}</span>
                @endif
            </a>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Jadwal Event
            </a>

            <div class="nav-section-label">Manajemen</div>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Kelola Ruangan
            </a>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pengguna
            </a>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Kategori Event
            </a>

            <div class="nav-section-label">Sistem</div>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pengaturan
            </a>

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="nav-item" style="color: rgba(239,68,68,0.7);">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </nav>

        {{-- User chip --}}
        <div class="sidebar-footer">
            <div class="user-chip">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
                </div>
                <div>
                    <p class="user-name">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="user-role">Admin Sistem</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="dash-main" style="flex:1;">

        {{-- Top Bar --}}
        <div class="topbar">
            <div>
                <div class="topbar-title">Dashboard Admin</div>
                <div class="topbar-subtitle">
                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }} &mdash; Selamat datang kembali!
                </div>
            </div>
            <div class="topbar-actions">
                <button class="topbar-btn btn-outline" style="position:relative;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    Notifikasi
                    @if($pendingEvents > 0)
                        <span class="notif-dot"></span>
                    @endif
                </button>
                <a href="#" class="topbar-btn btn-primary">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Event
                </a>
            </div>
        </div>

        {{-- Content --}}
        <div class="dash-content">

            {{-- STAT CARDS --}}
            <div class="stat-grid">
                <div class="stat-card stat-card-primary anim-1">
                    <div class="stat-icon-wrap">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="stat-value">{{ $totalApproved }}</div>
                    <div class="stat-label">Event Disetujui</div>
                    <div class="stat-trend">&#x2191; Aktif</div>
                </div>

                <div class="stat-card stat-card-warning anim-2">
                    <div class="stat-icon-wrap">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="stat-value">{{ $pendingEvents }}</div>
                    <div class="stat-label">Butuh Approval</div>
                    @if($pendingEvents > 0)
                        <div class="stat-trend">&#9888; Pending</div>
                    @endif
                </div>

                <div class="stat-card stat-card-success anim-3">
                    <div class="stat-icon-wrap">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="stat-value">{{ $totalRooms }}</div>
                    <div class="stat-label">Total Ruangan</div>
                    <div class="stat-trend">&#x2713; Tersedia</div>
                </div>

                <div class="stat-card stat-card-indigo anim-4">
                    <div class="stat-icon-wrap">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="stat-value">{{ $totalUsers }}</div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-trend">&#x1F465; Aktif</div>
                </div>
            </div>

            {{-- KATEGORI & QUICK ACTIONS --}}
            <div class="two-col anim-5">

                {{-- Statistik Kategori --}}
                <div class="section-card">
                    <div class="section-header">
                        <h3>
                            <span class="icon-wrap">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </span>
                            Statistik per Kategori
                        </h3>
                    </div>
                    <div class="cat-grid">
                        @foreach($statsPerCategory as $cat)
                            <div class="cat-pill">
                                <span class="cat-dot" style="background-color: {{ $cat->color ?? '#94a3b8' }}"></span>
                                {{ $cat->name }}
                                <span class="cat-count">{{ $cat->event_count }}</span>
                            </div>
                        @endforeach

                        @if($statsPerCategory->isEmpty())
                            <p style="color:#94a3b8; font-size:13px; padding:8px 0; font-weight:500;">Belum ada kategori.</p>
                        @endif
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="section-card">
                    <div class="section-header">
                        <h3>
                            <span class="icon-wrap">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </span>
                            Aksi Cepat
                        </h3>
                    </div>
                    <div class="quick-actions">
                        <a href="#" class="qa-item">
                            <div class="qa-icon" style="background:#eff6ff;">
                                <svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="qa-label">Review Pengajuan</p>
                                <p class="qa-desc">{{ $pendingEvents }} menunggu persetujuan</p>
                            </div>
                            <span class="qa-arrow"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></span>
                        </a>

                        <a href="#" class="qa-item">
                            <div class="qa-icon" style="background:#f0fdf4;">
                                <svg fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="qa-label">Kelola Ruangan</p>
                                <p class="qa-desc">{{ $totalRooms }} ruangan terdaftar</p>
                            </div>
                            <span class="qa-arrow"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></span>
                        </a>

                        <a href="#" class="qa-item">
                            <div class="qa-icon" style="background:#faf5ff;">
                                <svg fill="none" stroke="#7c3aed" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="qa-label">Manajemen Pengguna</p>
                                <p class="qa-desc">{{ $totalUsers }} pengguna aktif</p>
                            </div>
                            <span class="qa-arrow"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg></span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- TABEL PENGAJUAN --}}
            <div class="section-card anim-6" style="margin-top:20px;">
                <div class="section-header">
                    <h3>
                        <span class="icon-wrap">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                        </span>
                        Pengajuan Menunggu Persetujuan
                    </h3>
                    <a href="#" class="see-all-btn">Lihat Semua &rarr;</a>
                </div>

                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Nama Event</th>
                            <th>Pengaju</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEvents as $event)
                        <tr>
                            <td>
                                <span class="event-title">{{ $event->title }}</span>
                                @isset($event->category)
                                    <div style="font-size:11px; color:#94a3b8; margin-top:2px;">{{ $event->category->name ?? '' }}</div>
                                @endisset
                            </td>
                            <td>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div style="width:28px; height:28px; border-radius:8px; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:800; color:#2563eb; flex-shrink:0;">
                                        {{ strtoupper(substr($event->requester->name ?? 'U', 0, 2)) }}
                                    </div>
                                    <span style="font-weight:600; color:#334155;">{{ $event->requester->name ?? 'User' }}</span>
                                </div>
                            </td>
                            <td>
                                <span style="font-weight:600;">{{ $event->room->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <span class="mono" style="font-size:12px; color:#64748b;">
                                    {{ isset($event->start_date) ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pending">
                                    <span class="badge-dot"></span>
                                    Pending
                                </span>
                            </td>
                            <td>
                                <div style="display:flex; gap:6px;">
                                    <a href="#" style="font-size:11.5px; font-weight:700; padding:5px 12px; border-radius:8px; background:#dcfce7; color:#166534; text-decoration:none; border:1px solid #bbf7d0; transition:background 0.15s;">
                                        &#10003; Setujui
                                    </a>
                                    <a href="#" style="font-size:11.5px; font-weight:700; padding:5px 12px; border-radius:8px; background:#fee2e2; color:#991b1b; text-decoration:none; border:1px solid #fecaca; transition:background 0.15s;">
                                        &#10005; Tolak
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p>Tidak ada pengajuan pending</p>
                                    <span>Semua pengajuan sudah diproses</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</div>
</x-app-layout>