<x-app-layout>
<x-slot name="header"></x-slot>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap');

    :root {
        --blue-50:  #eff6ff;
        --blue-100: #dbeafe;
        --blue-200: #bfdbfe;
        --blue-300: #93c5fd;
        --blue-400: #60a5fa;
        --blue-500: #3b82f6;
        --blue-600: #2563eb;
        --blue-700: #1d4ed8;
        --blue-800: #1e40af;
        --blue-900: #1e3a8a;
        --blue-950: #172554;
    }

    .dash-root * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }

    /* ===== SIDEBAR (identik admin/siswa) ===== */
    .dash-sidebar {
        width: 260px; min-height: 100vh;
        background: var(--blue-950);
        position: fixed; top: 0; left: 0;
        display: flex; flex-direction: column;
        z-index: 40;
        border-right: 1px solid rgba(255,255,255,0.06);
    }
    .sidebar-logo { padding: 28px 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.07); }
    .sidebar-logo .logo-badge {
        width: 40px; height: 40px; background: var(--blue-500); border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 12px; box-shadow: 0 4px 14px rgba(59,130,246,0.45);
    }
    .sidebar-logo h1 { font-size: 15px; font-weight: 800; color: white; letter-spacing: -0.3px; margin: 0 0 2px; }
    .sidebar-logo p  { font-size: 11px; color: rgba(255,255,255,0.38); font-weight: 500; margin: 0; }
    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
    .nav-section-label {
        font-size: 10px; font-weight: 700; color: rgba(255,255,255,0.25);
        letter-spacing: 0.12em; text-transform: uppercase;
        padding: 8px 12px 6px; margin-top: 8px;
    }
    .nav-item {
        display: flex; align-items: center; gap: 12px;
        padding: 10px 14px; border-radius: 12px;
        font-size: 13.5px; font-weight: 600;
        color: rgba(255,255,255,0.5);
        cursor: pointer; transition: all 0.18s; text-decoration: none; margin-bottom: 2px;
    }
    .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.85); }
    .nav-item.active { background: var(--blue-600); color: white; box-shadow: 0 4px 14px rgba(37,99,235,0.4); }
    .nav-item .nav-icon { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.8; }
    .nav-item.active .nav-icon { opacity: 1; }
    .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.07); }
    .user-chip {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 12px;
        background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
    }
    .user-avatar {
        width: 34px; height: 34px; border-radius: 10px; background: var(--blue-600);
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 800; color: white; flex-shrink: 0;
    }
    .user-chip .user-name { font-size: 12.5px; font-weight: 700; color: white; line-height: 1.2; margin: 0; }
    .user-chip .user-role { font-size: 10.5px; color: rgba(255,255,255,0.38); font-weight: 500; margin: 0; }

    /* ===== MAIN ===== */
    .dash-main {
        margin-left: 260px; min-height: 100vh;
        background: #f0f4ff;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(219,234,254,0.6) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(191,219,254,0.35) 0%, transparent 40%);
    }

    /* ===== TOPBAR ===== */
    .topbar {
        background: white; border-bottom: 1px solid #e8edf8;
        padding: 0 36px; height: 64px;
        display: flex; align-items: center; justify-content: space-between;
        position: sticky; top: 0; z-index: 30;
    }
    .topbar-title    { font-size: 17px; font-weight: 800; color: var(--blue-950); letter-spacing: -0.3px; }
    .topbar-subtitle { font-size: 12px; color: #94a3b8; font-weight: 500; margin-top: 1px; }
    .topbar-actions  { display: flex; align-items: center; gap: 10px; }
    .topbar-btn {
        display: flex; align-items: center; gap: 7px;
        padding: 8px 16px; border-radius: 10px;
        font-size: 12.5px; font-weight: 700;
        border: none; cursor: pointer; transition: all 0.18s; text-decoration: none;
    }
    .btn-outline { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .btn-outline:hover { background: #e2e8f0; }
    .btn-primary { background: var(--blue-600); color: white; box-shadow: 0 3px 10px rgba(37,99,235,0.3); }
    .btn-primary:hover { background: var(--blue-700); transform: translateY(-1px); }
    .notif-dot { width: 8px; height: 8px; background: #ef4444; border-radius: 50%; border: 2px solid white; position: absolute; top: -2px; right: -2px; }

    /* ===== CONTENT ===== */
    .dash-content { padding: 28px 36px; }

    /* ===== LEGEND BAR ===== */
    .legend-bar {
        background: white; border-radius: 16px;
        border: 1px solid #e8edf8;
        padding: 14px 20px;
        display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
        box-shadow: 0 2px 12px rgba(30,58,138,0.04);
        margin-bottom: 20px;
    }
    .legend-label {
        display: flex; align-items: center; gap: 6px;
        font-size: 10px; font-weight: 800; color: rgba(30,58,138,0.5);
        letter-spacing: 0.12em; text-transform: uppercase;
        padding: 5px 12px 5px 8px;
        background: var(--blue-50); border-radius: 20px;
        border: 1px solid var(--blue-100);
    }
    .legend-label svg { width: 13px; height: 13px; color: var(--blue-500); }
    .legend-items { display: flex; flex-wrap: wrap; align-items: center; gap: 8px 20px; }
    .legend-item {
        display: flex; align-items: center; gap: 8px;
        font-size: 12.5px; font-weight: 600; color: #475569;
    }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

    /* ===== STAT MINI ROW ===== */
    .mini-stat-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
    .mini-stat {
        background: white; border-radius: 16px;
        border: 1px solid #e8edf8; padding: 16px 18px;
        display: flex; align-items: center; gap: 14px;
        box-shadow: 0 2px 12px rgba(30,58,138,0.04);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .mini-stat:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(30,58,138,0.08); }
    .mini-stat-icon {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .mini-stat-icon svg { width: 18px; height: 18px; }
    .mini-stat-value { font-size: 22px; font-weight: 900; color: var(--blue-950); letter-spacing: -0.8px; line-height: 1; margin: 0 0 2px; }
    .mini-stat-label { font-size: 11px; font-weight: 600; color: #94a3b8; margin: 0; }

    /* ===== CALENDAR CARD ===== */
    .calendar-card {
        background: white; border-radius: 20px;
        border: 1px solid #e8edf8;
        box-shadow: 0 4px 24px rgba(30,58,138,0.07);
        overflow: hidden;
    }

    .calendar-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; justify-content: space-between;
    }

    .calendar-card-header h3 {
        font-size: 15px; font-weight: 800; color: var(--blue-950);
        letter-spacing: -0.2px; display: flex; align-items: center; gap: 10px; margin: 0;
    }

    .calendar-card-header h3 .icon-wrap {
        width: 32px; height: 32px; background: var(--blue-50);
        border-radius: 9px; display: flex; align-items: center; justify-content: center;
    }

    .calendar-card-header h3 .icon-wrap svg { width: 16px; height: 16px; color: var(--blue-600); }

    .view-switcher { display: flex; background: #f8faff; border-radius: 10px; padding: 3px; border: 1px solid #e8edf8; gap: 2px; }
    .view-btn {
        padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 700;
        border: none; cursor: pointer; transition: all 0.18s; color: #64748b; background: transparent;
    }
    .view-btn.active { background: var(--blue-600); color: white; box-shadow: 0 2px 8px rgba(37,99,235,0.3); }
    .view-btn:not(.active):hover { background: white; color: var(--blue-700); }

    .calendar-body { padding: 20px 24px 24px; }

    /* ===== FULLCALENDAR OVERRIDES ===== */
    #calendar {
        --fc-border-color: #f0f4ff;
        --fc-button-bg-color: var(--blue-600);
        --fc-button-border-color: var(--blue-600);
        --fc-button-hover-bg-color: var(--blue-700);
        --fc-button-hover-border-color: var(--blue-700);
        --fc-button-active-bg-color: var(--blue-800);
        --fc-button-active-border-color: var(--blue-800);
        --fc-today-bg-color: rgba(37,99,235,0.05);
        --fc-event-border-color: transparent;
        --fc-page-bg-color: transparent;
        --fc-neutral-bg-color: #f8faff;
        --fc-list-event-hover-bg-color: var(--blue-50);
    }

    /* Toolbar */
    .fc .fc-toolbar { margin-bottom: 20px; gap: 12px; flex-wrap: wrap; }
    .fc .fc-toolbar-title {
        font-size: 20px !important; font-weight: 900 !important;
        color: var(--blue-950) !important; letter-spacing: -0.5px;
    }

    /* Buttons */
    .fc .fc-button {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 12px !important; font-weight: 700 !important;
        border-radius: 10px !important; padding: 8px 16px !important;
        text-transform: none !important; letter-spacing: 0 !important;
        box-shadow: 0 2px 8px rgba(37,99,235,0.25) !important;
        transition: all 0.18s !important;
    }
    .fc .fc-button:hover { transform: translateY(-1px) !important; box-shadow: 0 4px 12px rgba(37,99,235,0.35) !important; }
    .fc .fc-button:focus { box-shadow: 0 0 0 3px rgba(37,99,235,0.2) !important; }
    .fc .fc-button-primary:not(:disabled).fc-button-active { background: var(--blue-800) !important; }
    .fc .fc-today-button { background: var(--blue-50) !important; color: var(--blue-700) !important; border: 1.5px solid var(--blue-200) !important; box-shadow: none !important; }
    .fc .fc-today-button:hover { background: var(--blue-100) !important; box-shadow: none !important; }

    /* Header cells */
    .fc .fc-col-header-cell {
        background: #f8faff; padding: 10px 0 !important;
        border-bottom: 1.5px solid #e8edf8 !important;
    }
    .fc .fc-col-header-cell-cushion {
        font-size: 11px !important; font-weight: 800 !important;
        color: #64748b !important; text-transform: uppercase !important;
        letter-spacing: 0.08em !important; text-decoration: none !important;
    }

    /* Day cells */
    .fc .fc-daygrid-day { border-color: #f0f4ff !important; }
    .fc .fc-daygrid-day-number {
        font-size: 12.5px !important; font-weight: 700 !important;
        color: #475569 !important; text-decoration: none !important;
        padding: 6px 8px !important;
    }
    .fc .fc-day-today .fc-daygrid-day-number {
        background: var(--blue-600) !important;
        color: white !important; border-radius: 8px !important;
        width: 28px; height: 28px;
        display: flex !important; align-items: center; justify-content: center;
        line-height: 1 !important; margin: 4px !important;
    }
    .fc .fc-day-today { background: rgba(37,99,235,0.04) !important; }

    /* Events */
    .fc .fc-event {
        border-radius: 8px !important; padding: 3px 8px !important;
        font-size: 11.5px !important; font-weight: 700 !important;
        border: none !important; cursor: pointer !important;
        transition: filter 0.15s, transform 0.15s !important;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important;
    }
    .fc .fc-event:hover { filter: brightness(1.08); transform: translateY(-1px) !important; box-shadow: 0 4px 10px rgba(0,0,0,0.15) !important; }
    .fc .fc-event-title { font-weight: 700 !important; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* List view */
    .fc .fc-list-event { cursor: pointer !important; transition: background 0.15s; }
    .fc .fc-list-event:hover td { background: var(--blue-50) !important; }
    .fc .fc-list-event-title a { text-decoration: none !important; font-weight: 700 !important; color: var(--blue-950) !important; }
    .fc .fc-list-day-cushion { background: #f8faff !important; }
    .fc .fc-list-day-text, .fc .fc-list-day-side-text { color: var(--blue-800) !important; font-weight: 800 !important; }
    .fc .fc-list-event-time { color: #94a3b8 !important; font-size: 12px !important; font-weight: 600 !important; }
    .fc .fc-list-empty { padding: 60px 24px !important; text-align: center !important; }
    .fc .fc-list-empty-cushion { color: #94a3b8 !important; font-size: 14px !important; }

    /* Week view time */
    .fc .fc-timegrid-slot-label-cushion { font-size: 11px !important; color: #94a3b8 !important; font-weight: 600 !important; }
    .fc .fc-timegrid-now-indicator-line { border-color: #ef4444 !important; border-width: 2px !important; }
    .fc .fc-timegrid-now-indicator-arrow { border-top-color: #ef4444 !important; border-bottom-color: #ef4444 !important; }

    /* Popover */
    .fc .fc-popover { border-radius: 14px !important; border: 1px solid #e8edf8 !important; box-shadow: 0 12px 32px rgba(30,58,138,0.15) !important; overflow: hidden !important; }
    .fc .fc-popover-header { background: var(--blue-950) !important; color: white !important; font-weight: 800 !important; padding: 10px 14px !important; font-size: 13px !important; }

    /* More link */
    .fc .fc-daygrid-more-link { font-size: 11px !important; font-weight: 700 !important; color: var(--blue-600) !important; }

    /* ===== EVENT DETAIL MODAL ===== */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(15,23,42,0.55);
        backdrop-filter: blur(4px); z-index: 200;
        display: none; align-items: center; justify-content: center; padding: 16px;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
        background: white; border-radius: 22px; width: 100%; max-width: 480px;
        overflow: hidden; box-shadow: 0 24px 60px rgba(15,23,42,0.25);
        animation: modalIn 0.25s ease;
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-header {
        padding: 22px 24px 18px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: flex-start; justify-content: space-between; gap: 12px;
    }
    .modal-header h4 { font-size: 17px; font-weight: 900; color: var(--blue-950); letter-spacing: -0.3px; margin: 0 0 6px; line-height: 1.3; }
    .modal-close {
        width: 32px; height: 32px; border-radius: 10px; border: none;
        background: #f1f5f9; cursor: pointer; display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; transition: background 0.15s;
    }
    .modal-close:hover { background: #e2e8f0; }
    .modal-close svg { width: 16px; height: 16px; color: #64748b; }
    .modal-body { padding: 20px 24px; display: flex; flex-direction: column; gap: 12px; }
    .modal-row { display: flex; align-items: flex-start; gap: 12px; }
    .modal-row-icon {
        width: 34px; height: 34px; border-radius: 10px; background: var(--blue-50);
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .modal-row-icon svg { width: 16px; height: 16px; color: var(--blue-600); }
    .modal-row-label { font-size: 10.5px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 3px; }
    .modal-row-value { font-size: 13.5px; font-weight: 700; color: var(--blue-950); margin: 0; }
    .modal-row-sub   { font-size: 11.5px; color: #64748b; margin: 2px 0 0; }
    .modal-footer { padding: 16px 24px; border-top: 1px solid #f1f5f9; display: flex; gap: 10px; }
    .modal-btn {
        flex: 1; padding: 11px; border-radius: 12px; font-size: 13px; font-weight: 700;
        border: none; cursor: pointer; transition: all 0.18s; text-align: center; text-decoration: none;
        display: flex; align-items: center; justify-content: center;
    }
    .modal-btn-outline { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .modal-btn-outline:hover { background: #e2e8f0; }
    .modal-btn-primary { background: var(--blue-600); color: white; box-shadow: 0 3px 10px rgba(37,99,235,0.3); }
    .modal-btn-primary:hover { background: var(--blue-700); }

    /* Event category badge */
    .cat-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11px; font-weight: 700; padding: 4px 12px;
        border-radius: 20px;
    }
    .cat-badge-dot { width: 7px; height: 7px; border-radius: 50%; }

    /* Animations */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim-1 { animation: slideUp 0.4s ease 0.00s both; }
    .anim-2 { animation: slideUp 0.4s ease 0.07s both; }
    .anim-3 { animation: slideUp 0.4s ease 0.14s both; }
    .anim-4 { animation: slideUp 0.4s ease 0.21s both; }

    /* Responsive */
    @media (max-width: 900px) {
        .dash-sidebar { display: none; }
        .dash-main { margin-left: 0; }
        .dash-content { padding: 16px; }
        .topbar { padding: 0 16px; }
        .mini-stat-row { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .mini-stat-row { grid-template-columns: 1fr 1fr; }
        .legend-bar { flex-direction: column; align-items: flex-start; gap: 12px; }
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
            <div class="nav-section-label">Menu Utama</div>

            <a href="{{ route('siswa.dashboard') ?? '#' }}" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('calendar.index') }}" class="nav-item active">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Kalender Kegiatan
            </a>

            <a href="{{ route('events.create') }}" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Ajukan Event
            </a>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                RSVP & Presensi
            </a>

            <div class="nav-section-label">Saya</div>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                Reminder Saya
            </a>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil Saya
            </a>

            <div class="nav-section-label">Sistem</div>

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form-cal').submit();"
               class="nav-item" style="color: rgba(239,68,68,0.7);">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </a>
            <form id="logout-form-cal" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </nav>

        <div class="sidebar-footer">
            <div class="user-chip">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</div>
                <div>
                    <p class="user-name">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                    <p class="user-role">{{ ucfirst(Auth::user()->role ?? 'Siswa') }}</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN ===== --}}
    <main class="dash-main" style="flex:1;">

        {{-- Topbar --}}
        <div class="topbar">
            <div>
                <div class="topbar-title">E-Kalender Event</div>
                <div class="topbar-subtitle">Jadwal Penggunaan Ruangan Global &mdash; SMKN 1 Purwokerto</div>
            </div>
            <div class="topbar-actions">
                <button class="topbar-btn btn-outline" style="position:relative;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16"/></svg>
                    Filter
                </button>
                <a href="{{ route('events.create') }}" class="topbar-btn btn-primary">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Ajukan Event Baru
                </a>
            </div>
        </div>

        {{-- Content --}}
        <div class="dash-content">

            {{-- Mini Stats --}}
            <div class="mini-stat-row anim-1">
                <div class="mini-stat">
                    <div class="mini-stat-icon" style="background:#eff6ff;">
                        <svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div class="mini-stat-value">{{ $totalEvents ?? '—' }}</div>
                        <div class="mini-stat-label">Total Event Bulan Ini</div>
                    </div>
                </div>
                <div class="mini-stat">
                    <div class="mini-stat-icon" style="background:#f0fdf4;">
                        <svg fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="mini-stat-value">{{ $approvedEvents ?? '—' }}</div>
                        <div class="mini-stat-label">Disetujui</div>
                    </div>
                </div>
                <div class="mini-stat">
                    <div class="mini-stat-icon" style="background:#fef3c7;">
                        <svg fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="mini-stat-value">{{ $pendingEvents ?? '—' }}</div>
                        <div class="mini-stat-label">Menunggu Approval</div>
                    </div>
                </div>
                <div class="mini-stat">
                    <div class="mini-stat-icon" style="background:#faf5ff;">
                        <svg fill="none" stroke="#7c3aed" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <div class="mini-stat-value">{{ $totalRooms ?? '—' }}</div>
                        <div class="mini-stat-label">Ruangan Tersedia</div>
                    </div>
                </div>
            </div>

            {{-- Legend Bar --}}
            <div class="legend-bar anim-2">
                <div class="legend-label">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Legend
                </div>
                <div class="legend-items">
                    <span class="legend-item"><span class="legend-dot" style="background:#ef4444;"></span>Lomba</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#7c3aed;"></span>Ujian</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#2563eb;"></span>Upacara</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#16a34a;"></span>Ekskul</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#f59e0b;"></span>Rapat</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#0891b2;"></span>Seminar</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#ea580c;"></span>Olahraga</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#db2777;"></span>Seni Budaya</span>
                    <span class="legend-item"><span class="legend-dot" style="background:#64748b;"></span>Lainnya</span>
                </div>

                {{-- Filter Ruangan --}}
                <div style="margin-left:auto; display:flex; gap:8px; align-items:center; flex-shrink:0;">
                    <label style="font-size:11.5px; font-weight:700; color:#64748b; white-space:nowrap;">Filter Ruangan:</label>
                    <select id="filterRoom" onchange="filterByRoom()"
                        style="font-size:12px; font-weight:600; color:#334155; background:#f8faff; border:1.5px solid #e2e8f0; border-radius:10px; padding:6px 10px; cursor:pointer; outline:none;">
                        <option value="">Semua Ruangan</option>
                        @if(isset($rooms))
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        @else
                            <option value="1">Aula Utama</option>
                            <option value="2">Lab Komputer</option>
                            <option value="3">Lapangan Sekolah</option>
                            <option value="4">Ruang Rapat</option>
                        @endif
                    </select>
                </div>
            </div>

            {{-- Calendar Card --}}
            <div class="calendar-card anim-3">
                <div class="calendar-card-header">
                    <h3>
                        <span class="icon-wrap">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        Peta Jadwal Kegiatan
                    </h3>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span id="currentMonthLabel" style="font-size:12px; font-weight:700; color:#94a3b8;"></span>
                        <div class="view-switcher">
                            <button class="view-btn active" onclick="switchView('dayGridMonth', this)">Bulan</button>
                            <button class="view-btn" onclick="switchView('timeGridWeek', this)">Minggu</button>
                            <button class="view-btn" onclick="switchView('listMonth', this)">Daftar</button>
                        </div>
                    </div>
                </div>
                <div class="calendar-body">
                    <div id="calendar"></div>
                </div>
            </div>

        </div>
    </main>
</div>

{{-- ===== EVENT DETAIL MODAL ===== --}}
<div class="modal-overlay" id="eventModal" onclick="closeModal(event)">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div style="flex:1;">
                <div id="modalCatBadge" style="margin-bottom:8px;"></div>
                <h4 id="modalTitle">Nama Event</h4>
            </div>
            <button class="modal-close" onclick="closeModal()">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-row">
                <div class="modal-row-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="modal-row-label">Tanggal & Waktu</div>
                    <div class="modal-row-value" id="modalDate">—</div>
                    <div class="modal-row-sub" id="modalTime">—</div>
                </div>
            </div>
            <div class="modal-row">
                <div class="modal-row-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <div class="modal-row-label">Ruangan</div>
                    <div class="modal-row-value" id="modalRoom">—</div>
                </div>
            </div>
            <div class="modal-row">
                <div class="modal-row-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <div class="modal-row-label">Pengaju / Penyelenggara</div>
                    <div class="modal-row-value" id="modalOrganizer">—</div>
                </div>
            </div>
            <div class="modal-row" id="modalDescRow" style="display:none;">
                <div class="modal-row-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <div class="modal-row-label">Keterangan</div>
                    <div class="modal-row-value" id="modalDesc" style="font-weight:500; font-size:13px; line-height:1.5;">—</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn modal-btn-outline" onclick="closeModal()">Tutup</button>
            <a href="#" id="modalDetailLink" class="modal-btn modal-btn-primary">Lihat Detail Lengkap</a>
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin  from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin     from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

let calendarInstance = null;
let currentRoomFilter = '';

const CATEGORY_COLORS = {
    'Lomba':      { bg: '#ef4444', light: '#fee2e2', text: '#991b1b' },
    'Ujian':      { bg: '#7c3aed', light: '#ede9fe', text: '#4c1d95' },
    'Upacara':    { bg: '#2563eb', light: '#dbeafe', text: '#1e40af' },
    'Ekskul':     { bg: '#16a34a', light: '#dcfce7', text: '#166534' },
    'Rapat':      { bg: '#f59e0b', light: '#fef3c7', text: '#92400e' },
    'Seminar':    { bg: '#0891b2', light: '#cffafe', text: '#164e63' },
    'Olahraga':   { bg: '#ea580c', light: '#ffedd5', text: '#7c2d12' },
    'Seni Budaya':{ bg: '#db2777', light: '#fce7f3', text: '#831843' },
    'Lainnya':    { bg: '#64748b', light: '#f1f5f9', text: '#334155' },
};

function getColor(category) {
    return CATEGORY_COLORS[category] || CATEGORY_COLORS['Lainnya'];
}

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' });
}

function formatTime(start, end) {
    if (!start) return '—';
    const s = new Date(start);
    const e = end ? new Date(end) : null;
    const fmt = d => d.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit' });
    return e ? `${fmt(s)} – ${fmt(e)} WIB` : `${fmt(s)} WIB`;
}

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    calendarInstance = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: 'id',
        contentHeight: 'auto',
        firstDay: 1,
        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  '',   // kita pakai custom switcher
        },
        buttonText: {
            today: 'Hari Ini',
            month: 'Bulan',
            week:  'Minggu',
            list:  'Daftar',
        },

        // ===== DATA SOURCE =====
        events: function(info, successCallback, failureCallback) {
            const url = new URL('{{ route("calendar.events") }}', window.location.origin);
            url.searchParams.set('start', info.startStr);
            url.searchParams.set('end',   info.endStr);
            if (currentRoomFilter) url.searchParams.set('room_id', currentRoomFilter);

            fetch(url)
                .then(r => r.json())
                .then(data => {
                    const mapped = data.map(ev => {
                        const color = getColor(ev.category_name || ev.category || 'Lainnya');
                        return {
                            id:              ev.id,
                            title:           ev.title,
                            start:           ev.start,
                            end:             ev.end,
                            backgroundColor: color.bg,
                            borderColor:     color.bg,
                            textColor:       '#ffffff',
                            extendedProps: {
                                category:   ev.category_name || ev.category || 'Lainnya',
                                room:       ev.room_name     || ev.room     || '—',
                                organizer:  ev.requester     || ev.organizer || '—',
                                description:ev.description   || '',
                            }
                        };
                    });
                    successCallback(mapped);
                    updateMonthLabel();
                })
                .catch(failureCallback);
        },

        // ===== EVENT CLICK → MODAL =====
        eventClick: function(info) {
            const ev    = info.event;
            const props = ev.extendedProps;
            const color = getColor(props.category);

            document.getElementById('modalTitle').textContent     = ev.title;
            document.getElementById('modalDate').textContent      = formatDate(ev.startStr);
            document.getElementById('modalTime').textContent      = formatTime(ev.start, ev.end);
            document.getElementById('modalRoom').textContent      = props.room;
            document.getElementById('modalOrganizer').textContent = props.organizer;
            document.getElementById('modalDetailLink').href       = `/events/${ev.id}`;

            // Category badge
            document.getElementById('modalCatBadge').innerHTML =
                `<span class="cat-badge" style="background:${color.light}; color:${color.text};">
                    <span class="cat-badge-dot" style="background:${color.bg};"></span>
                    ${props.category}
                </span>`;

            // Description
            if (props.description) {
                document.getElementById('modalDesc').textContent = props.description;
                document.getElementById('modalDescRow').style.display = 'flex';
            } else {
                document.getElementById('modalDescRow').style.display = 'none';
            }

            document.getElementById('eventModal').classList.add('open');
        },

        eventDidMount: function(info) {
            info.el.setAttribute('title', info.event.title);
        },

        datesSet: function() {
            updateMonthLabel();
        },
    });

    calendarInstance.render();
    updateMonthLabel();

    // Expose globally
    window.calendarInstance = calendarInstance;
});

function updateMonthLabel() {
    if (!calendarInstance) return;
    const d = calendarInstance.getDate();
    document.getElementById('currentMonthLabel').textContent =
        d.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });
}

// ===== VIEW SWITCHER =====
window.switchView = function(viewName, btn) {
    if (!calendarInstance) return;
    calendarInstance.changeView(viewName);
    document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateMonthLabel();
};

// ===== ROOM FILTER =====
window.filterByRoom = function() {
    currentRoomFilter = document.getElementById('filterRoom').value;
    if (calendarInstance) calendarInstance.refetchEvents();
};

// ===== MODAL =====
window.closeModal = function(evt) {
    if (!evt || evt.target === document.getElementById('eventModal')) {
        document.getElementById('eventModal').classList.remove('open');
    }
};

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') document.getElementById('eventModal').classList.remove('open');
});
</script>
@endpush

</x-app-layout>