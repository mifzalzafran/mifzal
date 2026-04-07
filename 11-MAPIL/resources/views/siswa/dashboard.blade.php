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
    .dash-root .mono { font-family: 'DM Mono', monospace; }

    /* ===== SIDEBAR (identik dengan admin) ===== */
    .dash-sidebar {
        width: 260px; min-height: 100vh;
        background: var(--blue-950);
        position: fixed; top: 0; left: 0;
        display: flex; flex-direction: column;
        z-index: 40;
        border-right: 1px solid rgba(255,255,255,0.06);
    }

    .sidebar-logo {
        padding: 28px 24px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.07);
    }

    .sidebar-logo .logo-badge {
        width: 40px; height: 40px;
        background: var(--blue-500); border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 12px;
        box-shadow: 0 4px 14px rgba(59,130,246,0.45);
    }

    .sidebar-logo h1 { font-size: 15px; font-weight: 800; color: white; letter-spacing: -0.3px; margin: 0 0 2px; }
    .sidebar-logo p  { font-size: 11px; color: rgba(255,255,255,0.38); font-weight: 500; margin: 0; letter-spacing: 0.02em; }

    .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

    .nav-section-label {
        font-size: 10px; font-weight: 700;
        color: rgba(255,255,255,0.25);
        letter-spacing: 0.12em; text-transform: uppercase;
        padding: 8px 12px 6px; margin-top: 8px;
    }

    .nav-item {
        display: flex; align-items: center; gap: 12px;
        padding: 10px 14px; border-radius: 12px;
        font-size: 13.5px; font-weight: 600;
        color: rgba(255,255,255,0.5);
        cursor: pointer; transition: all 0.18s ease;
        text-decoration: none; margin-bottom: 2px;
    }

    .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.85); }
    .nav-item.active { background: var(--blue-600); color: white; box-shadow: 0 4px 14px rgba(37,99,235,0.4); }
    .nav-item .nav-icon { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.8; }
    .nav-item.active .nav-icon { opacity: 1; }

    .sidebar-footer {
        padding: 16px 12px;
        border-top: 1px solid rgba(255,255,255,0.07);
    }

    .user-chip {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 12px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
    }

    .user-avatar {
        width: 34px; height: 34px; border-radius: 10px;
        background: var(--blue-600);
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

    .topbar-title { font-size: 17px; font-weight: 800; color: var(--blue-950); letter-spacing: -0.3px; }
    .topbar-subtitle { font-size: 12px; color: #94a3b8; font-weight: 500; margin-top: 1px; }
    .topbar-actions { display: flex; align-items: center; gap: 10px; }

    .topbar-btn {
        display: flex; align-items: center; gap: 7px;
        padding: 8px 16px; border-radius: 10px;
        font-size: 12.5px; font-weight: 700;
        border: none; cursor: pointer; transition: all 0.18s;
        text-decoration: none;
    }

    .btn-outline { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .btn-outline:hover { background: #e2e8f0; }
    .btn-primary { background: var(--blue-600); color: white; box-shadow: 0 3px 10px rgba(37,99,235,0.3); }
    .btn-primary:hover { background: var(--blue-700); transform: translateY(-1px); }

    .notif-dot {
        width: 8px; height: 8px; background: #ef4444; border-radius: 50%;
        border: 2px solid white; position: absolute; top: -2px; right: -2px;
    }

    /* ===== CONTENT ===== */
    .dash-content { padding: 32px 36px; }

    /* Welcome Banner */
    .welcome-banner {
        border-radius: 22px;
        background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-800) 60%, var(--blue-950) 100%);
        padding: 32px 36px;
        position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 24px;
        box-shadow: 0 12px 40px rgba(37,99,235,0.35);
    }

    .banner-deco-1 { position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.06); border-radius: 50%; }
    .banner-deco-2 { position: absolute; bottom: -60px; right: 100px; width: 140px; height: 140px; background: rgba(255,255,255,0.04); border-radius: 50%; }
    .banner-deco-3 { position: absolute; top: 20px; right: 200px; width: 50px; height: 50px; background: rgba(255,255,255,0.07); border-radius: 50%; }
    .banner-deco-4 { position: absolute; bottom: 10px; left: 40%; width: 30px; height: 30px; background: rgba(255,255,255,0.05); border-radius: 50%; }

    .banner-date { font-size: 12px; color: rgba(255,255,255,0.55); font-weight: 600; letter-spacing: 0.03em; margin-bottom: 8px; }
    .banner-title { font-size: 26px; font-weight: 900; color: white; letter-spacing: -0.5px; margin-bottom: 6px; }
    .banner-sub { font-size: 13px; color: rgba(255,255,255,0.6); font-weight: 500; }

    .banner-right { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }

    .banner-pill {
        padding: 6px 14px; border-radius: 20px;
        background: rgba(255,255,255,0.13);
        border: 1px solid rgba(255,255,255,0.18);
        font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.8);
        backdrop-filter: blur(6px);
        white-space: nowrap;
    }

    .banner-cta {
        display: flex; align-items: center; gap: 8px;
        padding: 10px 18px; border-radius: 12px;
        background: white; color: var(--blue-700);
        font-size: 13px; font-weight: 800;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
        box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    }
    .banner-cta:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }

    /* ===== STAT CARDS ===== */
    .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }

    .stat-card {
        background: white; border-radius: 18px;
        border: 1px solid #e8edf8; padding: 20px 22px;
        position: relative; overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 16px rgba(30,58,138,0.04);
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(30,58,138,0.1); }

    .stat-card-accent {
        position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 18px 18px 0 0;
    }

    .stat-label { font-size: 11px; font-weight: 700; color: #94a3b8; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 10px; }
    .stat-value { font-size: 34px; font-weight: 900; color: var(--blue-950); letter-spacing: -1.5px; line-height: 1; margin-bottom: 6px; }
    .stat-sub   { font-size: 11.5px; font-weight: 600; margin: 0; }
    .stat-sub.green  { color: #16a34a; }
    .stat-sub.blue   { color: #60a5fa; }
    .stat-sub.orange { color: #f59e0b; }
    .stat-sub.muted  { color: #94a3b8; }

    .stat-icon {
        position: absolute; bottom: 16px; right: 18px;
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        opacity: 0.12;
    }
    .stat-icon svg { width: 22px; height: 22px; }

    /* ===== FEATURE CARDS ===== */
    .feature-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px; }

    .feature-card {
        border-radius: 18px; padding: 22px 20px;
        border: 1.5px solid #e8edf8; background: white;
        cursor: pointer; transition: all 0.22s ease;
        text-decoration: none; display: block;
        box-shadow: 0 2px 12px rgba(30,58,138,0.04);
    }
    .feature-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(30,58,138,0.12); border-color: var(--blue-300); }

    .feature-card.featured {
        background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-800) 100%);
        border-color: transparent;
        box-shadow: 0 8px 28px rgba(37,99,235,0.35);
    }
    .feature-card.featured:hover { box-shadow: 0 14px 36px rgba(37,99,235,0.45); }

    .feature-icon-wrap {
        width: 46px; height: 46px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
        transition: all 0.22s ease;
    }

    .feature-card:not(.featured):hover .feature-icon-wrap { transform: scale(1.08); }
    .feature-icon-wrap svg { width: 20px; height: 20px; }

    .feature-title { font-size: 14px; font-weight: 800; margin: 0 0 6px; letter-spacing: -0.2px; }
    .feature-desc  { font-size: 11.5px; line-height: 1.55; margin: 0 0 16px; }
    .feature-link  { display: flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 700; transition: gap 0.15s; }
    .feature-card:hover .feature-link { gap: 8px; }
    .feature-link svg { width: 13px; height: 13px; }

    /* ===== SECTION CARD ===== */
    .section-card {
        background: white; border-radius: 20px;
        border: 1px solid #e8edf8; overflow: hidden;
        box-shadow: 0 2px 20px rgba(30,58,138,0.04);
    }

    .section-header {
        padding: 20px 24px 16px;
        border-bottom: 1px solid #f1f5f9;
        display: flex; align-items: center; justify-content: space-between;
    }

    .section-header h3 {
        font-size: 15px; font-weight: 800; color: var(--blue-950);
        letter-spacing: -0.2px; display: flex; align-items: center; gap: 10px; margin: 0;
    }

    .section-header h3 .icon-wrap {
        width: 32px; height: 32px; background: var(--blue-50);
        border-radius: 9px; display: flex; align-items: center; justify-content: center;
    }

    .section-header h3 .icon-wrap svg { width: 16px; height: 16px; color: var(--blue-600); }

    .see-all-btn {
        font-size: 12px; font-weight: 700; color: var(--blue-600);
        background: var(--blue-50); border: none; padding: 6px 14px;
        border-radius: 8px; cursor: pointer; text-decoration: none; transition: background 0.15s;
    }
    .see-all-btn:hover { background: var(--blue-100); }

    /* ===== TWO COL ===== */
    .two-col { display: grid; grid-template-columns: 1fr 340px; gap: 20px; margin-bottom: 24px; }

    /* ===== EVENT LIST ===== */
    .event-item {
        display: flex; align-items: center; gap: 16px;
        padding: 16px 24px; border-bottom: 1px solid #f8faff;
        transition: background 0.15s;
    }
    .event-item:last-child { border-bottom: none; }
    .event-item:hover { background: #f8faff; }

    .event-date-box {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        flex-shrink: 0; border: 1.5px solid;
    }

    .event-date-month { font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; }
    .event-date-day   { font-size: 20px; font-weight: 900; line-height: 1; letter-spacing: -1px; }

    .event-info { flex: 1; min-width: 0; }
    .event-title-text { font-size: 13.5px; font-weight: 700; color: var(--blue-950); margin: 0 0 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .event-meta  { font-size: 11.5px; color: #94a3b8; margin: 0 0 6px; }
    .event-badges { display: flex; align-items: center; gap: 6px; }

    .badge {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 10.5px; font-weight: 700; padding: 3px 10px;
        border-radius: 20px; border: 1px solid;
    }
    .badge-dot { width: 5px; height: 5px; border-radius: 50%; }

    .badge-green  { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
    .badge-green .badge-dot  { background: #22c55e; }
    .badge-amber  { background: #fef3c7; color: #92400e; border-color: #fde68a; }
    .badge-amber .badge-dot  { background: #f59e0b; }
    .badge-blue   { background: var(--blue-50); color: var(--blue-700); border-color: var(--blue-200); }
    .badge-blue .badge-dot   { background: var(--blue-500); }
    .badge-red    { background: #fee2e2; color: #991b1b; border-color: #fecaca; }

    .event-count { font-size: 11px; color: #94a3b8; }

    .event-action {
        flex-shrink: 0;
        display: inline-flex; align-items: center;
        font-size: 12px; font-weight: 700; padding: 7px 14px;
        border-radius: 10px; text-decoration: none; transition: all 0.15s;
        white-space: nowrap;
    }

    .action-detail  { border: 1.5px solid #e2e8f0; color: #475569; background: white; }
    .action-detail:hover { background: #f8faff; border-color: var(--blue-300); color: var(--blue-700); }
    .action-daftar  { background: #16a34a; color: white; box-shadow: 0 3px 10px rgba(22,163,74,0.3); }
    .action-daftar:hover { background: #15803d; transform: translateY(-1px); }
    .action-rsvp    { background: var(--blue-600); color: white; box-shadow: 0 3px 10px rgba(37,99,235,0.3); }
    .action-rsvp:hover { background: var(--blue-700); transform: translateY(-1px); }

    /* ===== NOTIF ===== */
    .notif-item {
        display: flex; gap: 12px; align-items: flex-start;
        padding: 14px 20px; border-bottom: 1px solid #f8faff;
        transition: background 0.15s; cursor: pointer;
    }
    .notif-item:last-child { border-bottom: none; }
    .notif-item:hover { background: #f8faff; }

    .notif-bullet { width: 8px; height: 8px; border-radius: 50%; margin-top: 5px; flex-shrink: 0; }
    .notif-text { font-size: 12.5px; color: var(--blue-950); line-height: 1.55; margin: 0 0 3px; }
    .notif-text .notif-bold { font-weight: 700; }
    .notif-time { font-size: 10.5px; color: #94a3b8; }
    .notif-item.read .notif-text { color: #94a3b8; }
    .notif-item.read .notif-bullet { background: #e2e8f0 !important; }

    /* ===== REMINDER ===== */
    .reminder-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; padding: 20px 24px; }

    .reminder-card {
        display: flex; align-items: center; gap: 12px;
        padding: 14px 16px; border-radius: 14px;
        border: 1.5px solid; transition: all 0.18s;
    }
    .reminder-card.on  { background: #f0f7ff; border-color: var(--blue-200); }
    .reminder-card.off { background: #f8f9fb; border-color: #e8ecf0; }
    .reminder-card:hover { transform: translateY(-2px); }
    .reminder-card.on:hover { box-shadow: 0 6px 18px rgba(37,99,235,0.12); }

    .reminder-icon {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .reminder-icon svg { width: 18px; height: 18px; }

    .reminder-name { font-size: 13px; font-weight: 700; margin: 0 0 2px; }
    .reminder-date { font-size: 10.5px; margin: 0; }
    .reminder-card.on  .reminder-name { color: var(--blue-900); }
    .reminder-card.on  .reminder-date { color: var(--blue-400); }
    .reminder-card.off .reminder-name { color: #64748b; }
    .reminder-card.off .reminder-date { color: #94a3b8; }

    .toggle-btn {
        margin-left: auto; flex-shrink: 0;
        width: 38px; height: 22px; border-radius: 11px;
        position: relative; border: none; cursor: pointer; transition: all 0.2s;
    }
    .toggle-btn.on  { background: var(--blue-600); }
    .toggle-btn.off { background: #d1d5db; }
    .toggle-btn::after {
        content: ''; position: absolute; top: 3px;
        width: 16px; height: 16px; border-radius: 50%;
        background: white; box-shadow: 0 1px 4px rgba(0,0,0,0.15);
        transition: left 0.2s;
    }
    .toggle-btn.on::after  { left: 19px; }
    .toggle-btn.off::after { left: 3px; }

    /* Reminder email notice */
    .reminder-notice {
        display: flex; align-items: center; gap: 12px;
        margin: 4px 24px 20px; padding: 14px 18px;
        background: var(--blue-50); border-radius: 14px;
        border: 1px solid var(--blue-100);
    }
    .reminder-notice svg { width: 18px; height: 18px; color: var(--blue-500); flex-shrink: 0; }
    .reminder-notice p  { font-size: 12px; font-weight: 600; color: var(--blue-800); margin: 0 0 2px; }
    .reminder-notice span { font-size: 11px; color: var(--blue-400); }

    /* ===== POIN SECTION ===== */
    .poin-bar-wrap { padding: 20px 24px; }
    .poin-bar-label { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
    .poin-bar-label span { font-size: 12px; font-weight: 700; color: var(--blue-950); }
    .poin-bar-label small { font-size: 11px; color: #94a3b8; }
    .poin-bar-track { height: 10px; background: #f1f5f9; border-radius: 20px; overflow: hidden; }
    .poin-bar-fill  { height: 100%; background: linear-gradient(90deg, var(--blue-400), var(--blue-600)); border-radius: 20px; transition: width 1s ease; }
    .poin-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; padding: 0 24px 20px; }
    .poin-item { background: var(--blue-50); border-radius: 12px; padding: 12px 14px; border: 1px solid var(--blue-100); }
    .poin-item-label { font-size: 10.5px; color: var(--blue-400); font-weight: 600; margin: 0 0 4px; }
    .poin-item-value { font-size: 18px; font-weight: 900; color: var(--blue-800); letter-spacing: -0.5px; margin: 0; }

    /* ===== EMPTY STATE ===== */
    .empty-state { text-align: center; padding: 48px 24px; }
    .empty-state svg { width: 44px; height: 44px; color: #cbd5e1; margin: 0 auto 14px; display: block; }
    .empty-state p   { font-size: 14px; font-weight: 700; color: #64748b; margin: 0 0 4px; }
    .empty-state span { font-size: 12.5px; color: #94a3b8; }

    /* ===== ANIMATIONS ===== */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .anim-1 { animation: slideUp 0.4s ease 0.00s both; }
    .anim-2 { animation: slideUp 0.4s ease 0.07s both; }
    .anim-3 { animation: slideUp 0.4s ease 0.14s both; }
    .anim-4 { animation: slideUp 0.4s ease 0.21s both; }
    .anim-5 { animation: slideUp 0.4s ease 0.28s both; }
    .anim-6 { animation: slideUp 0.4s ease 0.35s both; }
    .anim-7 { animation: slideUp 0.4s ease 0.42s both; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1100px) {
        .two-col { grid-template-columns: 1fr; }
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .feature-grid { grid-template-columns: repeat(2, 1fr); }
        .reminder-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 900px) {
        .dash-sidebar { display: none; }
        .dash-main { margin-left: 0; }
        .dash-content { padding: 20px 16px; }
        .topbar { padding: 0 16px; }
        .banner-right { display: none; }
        .welcome-banner { padding: 24px 24px; }
    }

    @media (max-width: 640px) {
        .stat-grid, .feature-grid, .reminder-grid, .poin-grid { grid-template-columns: 1fr; }
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

            <a href="#" class="nav-item active">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('calendar.index') }}" class="nav-item">
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

            <a href="#reminder" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                Reminder Saya
            </a>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Poin Partisipasi
            </a>

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil Saya
            </a>

            <div class="nav-section-label">Sistem</div>

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="nav-item" style="color: rgba(239,68,68,0.7);">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </nav>

        <div class="sidebar-footer">
            <div class="user-chip">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}</div>
                <div>
                    <p class="user-name">{{ Auth::user()->name ?? 'Siswa' }}</p>
                    <p class="user-role">Siswa Aktif</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="dash-main" style="flex:1;">

        {{-- Top Bar --}}
        <div class="topbar">
            <div>
                <div class="topbar-title">Dashboard Siswa</div>
                <div class="topbar-subtitle">
                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }} &mdash; Semester Genap 2025/2026
                </div>
            </div>
            <div class="topbar-actions">
                <button class="topbar-btn btn-outline" style="position:relative;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    Notifikasi
                    <span class="notif-dot"></span>
                </button>
                <a href="{{ route('events.create') }}" class="topbar-btn btn-primary">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Ajukan Kegiatan
                </a>
            </div>
        </div>

        {{-- ===== PAGE CONTENT ===== --}}
        <div class="dash-content">

            {{-- WELCOME BANNER --}}
            <div class="welcome-banner anim-1">
                <div class="banner-deco-1"></div>
                <div class="banner-deco-2"></div>
                <div class="banner-deco-3"></div>
                <div class="banner-deco-4"></div>

                <div style="position:relative; z-index:1;">
                    <div class="banner-date">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</div>
                    <div class="banner-title">Halo, {{ Auth::user()->name ?? 'Siswa' }}! 👋</div>
                    <div class="banner-sub">Selamat datang di Student Hub &mdash; Semester Genap 2025/2026</div>
                </div>

                <div class="banner-right" style="position:relative; z-index:1;">
                    <span class="banner-pill">Semester Genap 2025/2026</span>
                    <a href="{{ route('events.create') }}" class="banner-cta">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Ajukan Kegiatan
                    </a>
                </div>
            </div>

            {{-- STAT CARDS --}}
            <div class="stat-grid anim-2">
                <div class="stat-card">
                    <div class="stat-card-accent" style="background: linear-gradient(90deg, #2563eb, #1d4ed8);"></div>
                    <div class="stat-label">Total Kegiatan</div>
                    <div class="stat-value">{{ $totalEvents ?? 12 }}</div>
                    <p class="stat-sub muted">Tahun ajaran ini</p>
                    <div class="stat-icon" style="background: #2563eb;">
                        <svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-accent" style="background: linear-gradient(90deg, #16a34a, #15803d);"></div>
                    <div class="stat-label">Kegiatan Aktif</div>
                    <div class="stat-value">{{ $activeEvents ?? 3 }}</div>
                    <p class="stat-sub green">Perlu konfirmasi RSVP</p>
                    <div class="stat-icon" style="background: #16a34a;">
                        <svg fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-accent" style="background: linear-gradient(90deg, #f59e0b, #d97706);"></div>
                    <div class="stat-label">Poin Partisipasi</div>
                    <div class="stat-value">{{ $points ?? 245 }}</div>
                    <p class="stat-sub orange">+12 poin bulan ini</p>
                    <div class="stat-icon" style="background: #f59e0b;">
                        <svg fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-accent" style="background: linear-gradient(90deg, #4f46e5, #4338ca);"></div>
                    <div class="stat-label">Reminder Aktif</div>
                    <div class="stat-value">{{ $reminders ?? 5 }}</div>
                    <p class="stat-sub blue">Langganan kegiatan</p>
                    <div class="stat-icon" style="background: #4f46e5;">
                        <svg fill="none" stroke="#4f46e5" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                </div>
            </div>

            {{-- FEATURE CARDS --}}
            <div class="feature-grid anim-3">

                <a href="{{ route('calendar.index') }}" class="feature-card">
                    <div class="feature-icon-wrap" style="background: var(--blue-50);">
                        <svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="feature-title" style="color: var(--blue-950);">Kalender Kegiatan</div>
                    <div class="feature-desc" style="color: #94a3b8;">Lihat jadwal semua kegiatan sekolah</div>
                    <div class="feature-link" style="color: var(--blue-500);">
                        Buka Kalender
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </a>

                <a href="{{ route('events.create') }}" class="feature-card featured">
                    <div class="feature-icon-wrap" style="background: rgba(255,255,255,0.18);">
                        <svg fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div class="feature-title" style="color: white;">Ajukan Kegiatan</div>
                    <div class="feature-desc" style="color: rgba(255,255,255,0.65);">Buat proposal & minta izin ruangan</div>
                    <div class="feature-link" style="color: rgba(255,255,255,0.8);">
                        Buat Proposal
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </a>

                <a href="#" class="feature-card">
                    <div class="feature-icon-wrap" style="background: #f0fdf4;">
                        <svg fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="feature-title" style="color: var(--blue-950);">RSVP & Presensi</div>
                    <div class="feature-desc" style="color: #94a3b8;">Konfirmasi kehadiran kegiatan</div>
                    <div class="feature-link" style="color: #16a34a;">
                        Cek Sekarang
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </a>

                <a href="#reminder" class="feature-card">
                    <div class="feature-icon-wrap" style="background: #fff7ed;">
                        <svg fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <div class="feature-title" style="color: var(--blue-950);">Subscribe Reminder</div>
                    <div class="feature-desc" style="color: #94a3b8;">Aktifkan notifikasi kegiatan favoritmu</div>
                    <div class="feature-link" style="color: #f59e0b;">
                        Kelola Reminder
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </a>
            </div>

            {{-- UPCOMING EVENTS + NOTIFIKASI --}}
            <div class="two-col anim-4">

                {{-- Upcoming Events --}}
                <div class="section-card">
                    <div class="section-header">
                        <h3>
                            <span class="icon-wrap">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            Kegiatan Mendatang
                        </h3>
                        <a href="{{ route('calendar.index') }}" class="see-all-btn">Lihat semua &rarr;</a>
                    </div>

                    @php
                        $upcomingEvents = $upcomingEvents ?? collect([
                            (object)['month'=>'MAR','day'=>'25','title'=>'Lomba Debat Bahasa Inggris','room'=>'Aula Utama','time'=>'08:00–12:00','status'=>'closed','count'=>'24 peserta','color_bg'=>'#eff6ff','color_border'=>'#93c5fd','color_text'=>'#1d4ed8'],
                            (object)['month'=>'MAR','day'=>'28','title'=>'Workshop UI/UX Design','room'=>'Lab Komputer','time'=>'13:00–16:00','status'=>'open','count'=>'12 / 30 kuota','color_bg'=>'#f0fdf4','color_border'=>'#86efac','color_text'=>'#15803d'],
                            (object)['month'=>'APR','day'=>'5', 'title'=>'Peringatan Hari Kartini','room'=>'Lapangan Sekolah','time'=>'07:00–10:00','status'=>'mandatory','count'=>'Semua siswa','color_bg'=>'#eff6ff','color_border'=>'#93c5fd','color_text'=>'#1d4ed8'],
                        ]);
                    @endphp

                    @forelse($upcomingEvents as $ev)
                        <div class="event-item">
                            <div class="event-date-box"
                                 style="background: {{ $ev->color_bg ?? 'var(--blue-50)' }}; border-color: {{ $ev->color_border ?? 'var(--blue-200)' }}; color: {{ $ev->color_text ?? 'var(--blue-700)' }};">
                                <span class="event-date-month">{{ $ev->month ?? \Carbon\Carbon::parse($ev->start_date ?? now())->format('M') }}</span>
                                <span class="event-date-day">{{ $ev->day ?? \Carbon\Carbon::parse($ev->start_date ?? now())->format('j') }}</span>
                            </div>
                            <div class="event-info">
                                <div class="event-title-text">{{ $ev->title }}</div>
                                <div class="event-meta">{{ $ev->room ?? ($ev->room_name ?? '') }} &bull; {{ $ev->time ?? '' }}</div>
                                <div class="event-badges">
                                    @if(($ev->status ?? '') === 'open')
                                        <span class="badge badge-green"><span class="badge-dot"></span>Tersedia</span>
                                    @elseif(($ev->status ?? '') === 'closed')
                                        <span class="badge badge-amber"><span class="badge-dot"></span>Ditutup</span>
                                    @elseif(($ev->status ?? '') === 'mandatory')
                                        <span class="badge badge-blue"><span class="badge-dot"></span>Wajib</span>
                                    @else
                                        <span class="badge badge-blue"><span class="badge-dot"></span>Tersedia</span>
                                    @endif
                                    <span class="event-count">{{ $ev->count ?? '' }}</span>
                                </div>
                            </div>
                            @if(($ev->status ?? '') === 'open')
                                <a href="#" class="event-action action-daftar">Daftar</a>
                            @elseif(($ev->status ?? '') === 'mandatory')
                                <a href="#" class="event-action action-rsvp">RSVP</a>
                            @else
                                <a href="#" class="event-action action-detail">Detail</a>
                            @endif
                        </div>
                    @empty
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p>Tidak ada kegiatan mendatang</p>
                            <span>Cek kalender untuk jadwal lengkap</span>
                        </div>
                    @endforelse
                </div>

                {{-- Notifikasi --}}
                <div class="section-card" style="height: fit-content;">
                    <div class="section-header">
                        <h3>
                            <span class="icon-wrap">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            </span>
                            Notifikasi
                        </h3>
                        <button class="see-all-btn">Tandai Dibaca</button>
                    </div>

                    <div class="notif-item">
                        <div class="notif-bullet" style="background: var(--blue-600);"></div>
                        <div>
                            <div class="notif-text">Proposal <span class="notif-bold">"Class Meeting"</span> telah disetujui</div>
                            <div class="notif-time">2 jam yang lalu</div>
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-bullet" style="background: var(--blue-600);"></div>
                        <div>
                            <div class="notif-text">Reminder: Presensi kegiatan <span class="notif-bold">Isra Miraj</span></div>
                            <div class="notif-time">5 jam yang lalu</div>
                        </div>
                    </div>
                    <div class="notif-item read">
                        <div class="notif-bullet"></div>
                        <div>
                            <div class="notif-text">Sistem reminder otomatis telah aktif</div>
                            <div class="notif-time" style="color:#d1d5db;">Kemarin</div>
                        </div>
                    </div>

                    <div style="padding: 12px 20px; background: var(--blue-50); border-top: 1px solid var(--blue-100); text-align:center;">
                        <span style="font-size:11px; color: var(--blue-400); font-weight:600;">Notifikasi dikirim ke email terdaftar</span>
                    </div>
                </div>

            </div>

            {{-- POIN + REMINDER BARIS BAWAH --}}
            <div class="two-col anim-5" style="margin-bottom: 24px;">

                {{-- Poin Partisipasi --}}
                <div class="section-card">
                    <div class="section-header">
                        <h3>
                            <span class="icon-wrap">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            </span>
                            Poin Partisipasi Saya
                        </h3>
                        <a href="#" class="see-all-btn">Riwayat &rarr;</a>
                    </div>

                    <div class="poin-bar-wrap">
                        <div class="poin-bar-label">
                            <span>Progress ke Level Berikutnya</span>
                            <small>{{ $points ?? 245 }} / 300 poin</small>
                        </div>
                        <div class="poin-bar-track">
                            <div class="poin-bar-fill" style="width: {{ min((($points ?? 245) / 300) * 100, 100) }}%;"></div>
                        </div>
                    </div>

                    <div class="poin-grid">
                        <div class="poin-item">
                            <div class="poin-item-label">Total Poin</div>
                            <div class="poin-item-value">{{ $points ?? 245 }}</div>
                        </div>
                        <div class="poin-item">
                            <div class="poin-item-label">Bulan Ini</div>
                            <div class="poin-item-value">+12</div>
                        </div>
                        <div class="poin-item">
                            <div class="poin-item-label">Kegiatan Diikuti</div>
                            <div class="poin-item-value">{{ $totalEvents ?? 12 }}</div>
                        </div>
                    </div>
                </div>

                {{-- Quick Status Pengajuan --}}
                <div class="section-card" style="height: fit-content;">
                    <div class="section-header">
                        <h3>
                            <span class="icon-wrap">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            </span>
                            Pengajuan Saya
                        </h3>
                        <a href="#" class="see-all-btn">Semua &rarr;</a>
                    </div>
                    <div style="padding: 16px 20px; display: flex; flex-direction: column; gap: 10px;">
                        {{-- Contoh status pengajuan --}}
                        <div style="display:flex; align-items:center; gap:12px; padding:12px 14px; border-radius:12px; background:#f0fdf4; border:1.5px solid #bbf7d0;">
                            <div style="width:8px;height:8px;border-radius:50%;background:#22c55e;flex-shrink:0;"></div>
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:13px;font-weight:700;color:#166534;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Class Meeting Semester Genap</div>
                                <div style="font-size:11px;color:#16a34a;margin-top:2px;">Disetujui &bull; Aula Utama</div>
                            </div>
                            <span class="badge badge-green" style="flex-shrink:0;"><span class="badge-dot"></span>Disetujui</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:12px; padding:12px 14px; border-radius:12px; background:#fef3c7; border:1.5px solid #fde68a;">
                            <div style="width:8px;height:8px;border-radius:50%;background:#f59e0b;flex-shrink:0;"></div>
                            <div style="flex:1; min-width:0;">
                                <div style="font-size:13px;font-weight:700;color:#92400e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Latihan Paduan Suara</div>
                                <div style="font-size:11px;color:#b45309;margin-top:2px;">Menunggu review &bull; Ruang Musik</div>
                            </div>
                            <span class="badge badge-amber" style="flex-shrink:0;"><span class="badge-dot"></span>Pending</span>
                        </div>
                        <a href="{{ route('events.create') }}"
                           style="display:flex; align-items:center; justify-content:center; gap:6px; padding:11px; border-radius:12px; background:var(--blue-50); border:1.5px dashed var(--blue-200); font-size:12.5px; font-weight:700; color:var(--blue-600); text-decoration:none; transition:all 0.15s;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Buat Pengajuan Baru
                        </a>
                    </div>
                </div>

            </div>

            {{-- SUBSCRIBE REMINDER --}}
            <div class="section-card anim-6" id="reminder">
                <div class="section-header">
                    <h3>
                        <span class="icon-wrap">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </span>
                        Subscribe Reminder Kegiatan
                    </h3>
                    <span style="font-size:11.5px; font-weight:700; padding:5px 14px; background:#fff7ed; color:#f59e0b; border-radius:20px; border:1px solid #fed7aa;">{{ $reminders ?? 5 }} aktif</span>
                </div>

                <div class="reminder-grid">
                    <div class="reminder-card on">
                        <div class="reminder-icon" style="background:#eff6ff;">
                            <svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="reminder-name">Lomba Debat</div>
                            <div class="reminder-date">25 Mar 2026</div>
                        </div>
                        <button class="toggle-btn on" onclick="this.classList.toggle('on'); this.classList.toggle('off')"></button>
                    </div>

                    <div class="reminder-card on">
                        <div class="reminder-icon" style="background:#f0fdf4;">
                            <svg fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="reminder-name">Workshop UI/UX</div>
                            <div class="reminder-date">28 Mar 2026</div>
                        </div>
                        <button class="toggle-btn on" onclick="this.classList.toggle('on'); this.classList.toggle('off')"></button>
                    </div>

                    <div class="reminder-card off">
                        <div class="reminder-icon" style="background:#f1f5f9;">
                            <svg fill="none" stroke="#94a3b8" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="reminder-name">Hari Kartini</div>
                            <div class="reminder-date">5 Apr 2026</div>
                        </div>
                        <button class="toggle-btn off" onclick="this.classList.toggle('on'); this.classList.toggle('off')"></button>
                    </div>
                </div>

                <div class="reminder-notice">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <div>
                        <p>Notifikasi dikirim ke email terdaftar</p>
                        <span>{{ Auth::user()->email ?? 'siswa@smkn1pwt.sch.id' }} &bull; H-1 dan H-0 sebelum kegiatan</span>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="anim-7" style="margin-top:28px; border-top:1px solid #e8edf8; padding-top:20px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                <p style="font-size:10px; color:#94a3b8; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; margin:0;">SMKN 1 Purwokerto &bull; Student Hub v2.0</p>
                <div style="display:flex; gap:20px;">
                    <span style="font-size:11px; color:#94a3b8;">(0281) 123456</span>
                    <span style="font-size:11px; color:#94a3b8;">support@smkn1pwt.sch.id</span>
                </div>
            </div>

        </div>
    </main>
</div>
</x-app-layout>