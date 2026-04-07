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

    /* ===== SIDEBAR ===== */
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
        font-size: 13.5px; font-weight: 600; color: rgba(255,255,255,0.5);
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
        display: flex; align-items: center; gap: 7px; padding: 8px 16px;
        border-radius: 10px; font-size: 12.5px; font-weight: 700;
        border: none; cursor: pointer; transition: all 0.18s; text-decoration: none;
    }
    .btn-outline { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .btn-outline:hover { background: #e2e8f0; }

    /* ===== CONTENT ===== */
    .dash-content { padding: 32px 36px; }

    /* ===== BREADCRUMB ===== */
    .breadcrumb {
        display: flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 600; color: #94a3b8;
        margin-bottom: 24px;
    }
    .breadcrumb a { color: var(--blue-500); text-decoration: none; transition: color 0.15s; }
    .breadcrumb a:hover { color: var(--blue-700); }
    .breadcrumb svg { width: 12px; height: 12px; }
    .breadcrumb .current { color: var(--blue-950); font-weight: 700; }

    /* ===== FORM LAYOUT ===== */
    .form-layout { display: grid; grid-template-columns: 1fr 320px; gap: 24px; align-items: start; }

    /* ===== MAIN FORM CARD ===== */
    .form-card {
        background: white; border-radius: 20px;
        border: 1px solid #e8edf8;
        box-shadow: 0 4px 24px rgba(30,58,138,0.06);
        overflow: hidden;
    }

    /* Form banner header */
    .form-banner {
        background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-800) 60%, var(--blue-950) 100%);
        padding: 28px 32px; position: relative; overflow: hidden;
    }
    .form-banner::before {
        content: ''; position: absolute; top: -40px; right: -40px;
        width: 160px; height: 160px; background: rgba(255,255,255,0.07); border-radius: 50%;
    }
    .form-banner::after {
        content: ''; position: absolute; bottom: -50px; right: 80px;
        width: 100px; height: 100px; background: rgba(255,255,255,0.04); border-radius: 50%;
    }
    .form-banner-title { font-size: 22px; font-weight: 900; color: white; letter-spacing: -0.5px; margin: 0 0 6px; position: relative; z-index: 1; }
    .form-banner-sub   { font-size: 13px; color: rgba(255,255,255,0.6); font-weight: 500; margin: 0; position: relative; z-index: 1; }
    .form-banner-icon  {
        position: absolute; right: 32px; top: 50%; transform: translateY(-50%);
        width: 56px; height: 56px; background: rgba(255,255,255,0.12);
        border-radius: 18px; display: flex; align-items: center; justify-content: center;
        z-index: 1; border: 1px solid rgba(255,255,255,0.15);
    }
    .form-banner-icon svg { width: 26px; height: 26px; color: white; }

    /* Stepper progress */
    .stepper {
        display: flex; align-items: center; gap: 0;
        padding: 0 32px; background: #f8faff;
        border-bottom: 1px solid #e8edf8; overflow-x: auto;
    }
    .step {
        display: flex; align-items: center; gap: 10px;
        padding: 14px 0; flex-shrink: 0;
    }
    .step-num {
        width: 26px; height: 26px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 800; flex-shrink: 0;
        transition: all 0.2s;
    }
    .step.done .step-num    { background: var(--blue-600); color: white; }
    .step.active .step-num  { background: var(--blue-600); color: white; box-shadow: 0 0 0 4px rgba(37,99,235,0.15); }
    .step.pending .step-num { background: #e8edf8; color: #94a3b8; }
    .step-label { font-size: 12px; font-weight: 700; }
    .step.done .step-label    { color: var(--blue-600); }
    .step.active .step-label  { color: var(--blue-950); }
    .step.pending .step-label { color: #94a3b8; }
    .step-sep { width: 32px; height: 1.5px; background: #e8edf8; flex-shrink: 0; margin: 0 4px; }
    .step.done + .step-sep { background: var(--blue-300); }

    /* Form body */
    .form-body { padding: 28px 32px; }

    /* Section header */
    .section-title {
        display: flex; align-items: center; gap: 10px;
        font-size: 14px; font-weight: 800; color: var(--blue-950);
        padding-bottom: 14px; margin-bottom: 20px;
        border-bottom: 1.5px solid #f1f5f9;
        letter-spacing: -0.2px;
    }
    .section-title .step-badge {
        width: 24px; height: 24px; border-radius: 8px;
        background: var(--blue-600); color: white;
        font-size: 11px; font-weight: 900;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .section-divider { height: 1px; background: #f0f4ff; margin: 28px 0; }

    /* Form fields */
    .field-group { margin-bottom: 20px; }
    .field-group:last-child { margin-bottom: 0; }

    .field-label {
        display: block; font-size: 11.5px; font-weight: 800;
        color: #64748b; letter-spacing: 0.08em; text-transform: uppercase;
        margin-bottom: 8px;
    }
    .field-label .req { color: #ef4444; margin-left: 2px; }

    .field-input {
        width: 100%; padding: 12px 16px;
        background: #f8faff; border: 1.5px solid #e8edf8;
        border-radius: 12px; font-size: 13.5px; font-weight: 500; color: #1e293b;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none; transition: all 0.18s;
    }
    .field-input::placeholder { color: #94a3b8; font-weight: 400; }
    .field-input:hover { border-color: var(--blue-200); background: white; }
    .field-input:focus { border-color: var(--blue-500); background: white; box-shadow: 0 0 0 4px rgba(37,99,235,0.08); }
    .field-input.has-error { border-color: #ef4444; background: #fff5f5; box-shadow: 0 0 0 3px rgba(239,68,68,0.08); }

    .field-select {
        width: 100%; padding: 12px 16px;
        background: #f8faff; border: 1.5px solid #e8edf8;
        border-radius: 12px; font-size: 13.5px; font-weight: 500; color: #1e293b;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none; transition: all 0.18s; cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px;
        padding-right: 42px;
    }
    .field-select:hover { border-color: var(--blue-200); background-color: white; }
    .field-select:focus { border-color: var(--blue-500); background-color: white; box-shadow: 0 0 0 4px rgba(37,99,235,0.08); }

    .field-textarea {
        width: 100%; padding: 12px 16px; min-height: 110px; resize: vertical;
        background: #f8faff; border: 1.5px solid #e8edf8;
        border-radius: 12px; font-size: 13.5px; font-weight: 500; color: #1e293b;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none; transition: all 0.18s; line-height: 1.6;
    }
    .field-textarea::placeholder { color: #94a3b8; font-weight: 400; }
    .field-textarea:hover { border-color: var(--blue-200); background: white; }
    .field-textarea:focus { border-color: var(--blue-500); background: white; box-shadow: 0 0 0 4px rgba(37,99,235,0.08); }

    .field-hint { font-size: 11.5px; color: #94a3b8; font-weight: 500; margin-top: 6px; }
    .field-error { font-size: 11.5px; color: #ef4444; font-weight: 700; margin-top: 6px; display: flex; align-items: center; gap: 4px; }
    .field-error svg { width: 12px; height: 12px; flex-shrink: 0; }

    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    /* Notice box */
    .notice-box {
        display: flex; gap: 12px; align-items: flex-start;
        padding: 14px 16px; border-radius: 12px; margin-top: 4px;
    }
    .notice-box.amber { background: #fffbeb; border: 1.5px solid #fde68a; }
    .notice-box.blue  { background: var(--blue-50); border: 1.5px solid var(--blue-100); }
    .notice-box svg   { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }
    .notice-box.amber svg { color: #d97706; }
    .notice-box.blue  svg { color: var(--blue-500); }
    .notice-box p { font-size: 12px; font-weight: 600; margin: 0; line-height: 1.55; }
    .notice-box.amber p { color: #92400e; }
    .notice-box.blue  p { color: var(--blue-700); }
    .notice-box strong { font-weight: 800; }

    /* File upload */
    .file-drop {
        position: relative; border: 2px dashed #e2e8f0; border-radius: 14px;
        background: #f8faff; padding: 32px 20px; text-align: center;
        transition: all 0.2s; cursor: pointer;
    }
    .file-drop:hover { border-color: var(--blue-400); background: var(--blue-50); }
    .file-drop.dragging { border-color: var(--blue-600); background: var(--blue-50); box-shadow: 0 0 0 4px rgba(37,99,235,0.08); }
    .file-drop input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .file-drop-icon {
        width: 48px; height: 48px; border-radius: 14px; background: var(--blue-100);
        display: flex; align-items: center; justify-content: center; margin: 0 auto 14px;
    }
    .file-drop-icon svg { width: 22px; height: 22px; color: var(--blue-600); }
    .file-drop-title { font-size: 13.5px; font-weight: 700; color: var(--blue-700); margin: 0 0 4px; }
    .file-drop-sub   { font-size: 11.5px; color: #94a3b8; font-weight: 500; margin: 0; }
    .file-drop-sub span { color: var(--blue-500); font-weight: 700; }

    /* File preview list */
    .file-list { margin-top: 12px; display: flex; flex-direction: column; gap: 8px; }
    .file-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px; background: white; border-radius: 10px;
        border: 1.5px solid #e8edf8;
    }
    .file-item-icon {
        width: 32px; height: 32px; border-radius: 8px; background: var(--blue-50);
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .file-item-icon svg { width: 15px; height: 15px; color: var(--blue-600); }
    .file-item-name  { font-size: 12.5px; font-weight: 700; color: #334155; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .file-item-size  { font-size: 11px; color: #94a3b8; font-weight: 500; flex-shrink: 0; }
    .file-item-del   { width: 24px; height: 24px; border: none; background: #fee2e2; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background 0.15s; }
    .file-item-del:hover { background: #fecaca; }
    .file-item-del svg { width: 12px; height: 12px; color: #ef4444; }

    /* ===== SUBMIT BUTTONS ===== */
    .form-actions {
        display: flex; gap: 12px; padding: 22px 32px;
        border-top: 1px solid #f1f5f9; background: #f8faff;
    }
    .btn-submit {
        flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;
        padding: 14px 24px; border-radius: 14px;
        font-size: 14px; font-weight: 800; letter-spacing: -0.2px;
        border: none; cursor: pointer; transition: all 0.2s;
        text-decoration: none;
    }
    .btn-submit-primary {
        background: var(--blue-600); color: white;
        box-shadow: 0 4px 16px rgba(37,99,235,0.35);
    }
    .btn-submit-primary:hover { background: var(--blue-700); transform: translateY(-2px); box-shadow: 0 8px 22px rgba(37,99,235,0.4); }
    .btn-submit-primary:active { transform: scale(0.98); }
    .btn-submit-primary svg { width: 17px; height: 17px; }

    .btn-submit-ghost {
        background: white; color: #64748b;
        border: 1.5px solid #e2e8f0; flex: 0 0 auto; padding: 14px 20px;
    }
    .btn-submit-ghost:hover { background: #f1f5f9; border-color: #cbd5e1; }

    /* ===== SIDEBAR CARD ===== */
    .sidebar-card {
        background: white; border-radius: 18px;
        border: 1px solid #e8edf8;
        box-shadow: 0 2px 16px rgba(30,58,138,0.04);
        overflow: hidden; margin-bottom: 16px;
    }
    .sidebar-card-header {
        padding: 16px 20px; border-bottom: 1px solid #f1f5f9;
        font-size: 13px; font-weight: 800; color: var(--blue-950);
        display: flex; align-items: center; gap: 8px;
    }
    .sidebar-card-header .sh-icon {
        width: 28px; height: 28px; border-radius: 8px; background: var(--blue-50);
        display: flex; align-items: center; justify-content: center;
    }
    .sidebar-card-header .sh-icon svg { width: 14px; height: 14px; color: var(--blue-600); }
    .sidebar-card-body { padding: 16px 20px; }

    /* Checklist */
    .checklist { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 10px; }
    .checklist li {
        display: flex; align-items: flex-start; gap: 10px;
        font-size: 12.5px; font-weight: 600; color: #475569; line-height: 1.5;
    }
    .check-icon {
        width: 18px; height: 18px; border-radius: 50%; flex-shrink: 0; margin-top: 1px;
        display: flex; align-items: center; justify-content: center;
    }
    .check-ok  { background: #dcfce7; }
    .check-ok svg  { width: 10px; height: 10px; color: #16a34a; }
    .check-info { background: var(--blue-50); }
    .check-info svg { width: 10px; height: 10px; color: var(--blue-600); }

    /* Timeline */
    .timeline { display: flex; flex-direction: column; gap: 0; }
    .tl-item { display: flex; gap: 12px; padding-bottom: 16px; position: relative; }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-left { display: flex; flex-direction: column; align-items: center; flex-shrink: 0; }
    .tl-dot {
        width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 10px; font-weight: 800;
    }
    .tl-dot.done    { background: var(--blue-600); color: white; }
    .tl-dot.pending { background: #e8edf8; color: #94a3b8; }
    .tl-line { flex: 1; width: 1.5px; background: #e8edf8; margin: 4px 0; min-height: 20px; }
    .tl-item:last-child .tl-line { display: none; }
    .tl-content { padding-top: 4px; }
    .tl-title { font-size: 12.5px; font-weight: 800; color: #334155; margin: 0 0 2px; }
    .tl-desc  { font-size: 11px; color: #94a3b8; font-weight: 500; margin: 0; }

    /* Error alert */
    .error-alert {
        background: #fef2f2; border: 1.5px solid #fecaca;
        border-radius: 14px; padding: 16px 18px; margin-bottom: 24px;
        display: flex; gap: 12px; align-items: flex-start;
    }
    .error-alert svg { width: 18px; height: 18px; color: #ef4444; flex-shrink: 0; margin-top: 1px; }
    .error-alert-title { font-size: 13px; font-weight: 800; color: #991b1b; margin: 0 0 6px; }
    .error-alert ul { margin: 0; padding: 0 0 0 14px; }
    .error-alert li { font-size: 12px; color: #b91c1c; font-weight: 600; margin-bottom: 2px; }

    /* Animations */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim-1 { animation: slideUp 0.4s ease 0.00s both; }
    .anim-2 { animation: slideUp 0.4s ease 0.08s both; }
    .anim-3 { animation: slideUp 0.4s ease 0.16s both; }

    /* Responsive */
    @media (max-width: 1100px) {
        .form-layout { grid-template-columns: 1fr; }
        .form-sidebar-col { order: -1; display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-sidebar-col .sidebar-card { margin-bottom: 0; }
    }
    @media (max-width: 900px) {
        .dash-sidebar { display: none; }
        .dash-main { margin-left: 0; }
        .dash-content { padding: 20px 16px; }
        .topbar { padding: 0 16px; }
        .form-body { padding: 20px; }
        .form-banner { padding: 22px 24px; }
        .form-banner-icon { display: none; }
        .form-actions { padding: 18px 20px; }
    }
    @media (max-width: 600px) {
        .two-col { grid-template-columns: 1fr; }
        .form-sidebar-col { grid-template-columns: 1fr; }
        .stepper { padding: 0 20px; }
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

            <a href="#" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('calendar.index') }}" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Kalender Kegiatan
            </a>

            <a href="{{ route('events.create') }}" class="nav-item active">
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
               onclick="event.preventDefault(); document.getElementById('logout-form-create').submit();"
               class="nav-item" style="color: rgba(239,68,68,0.7);">
                <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar
            </a>
            <form id="logout-form-create" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
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
                <div class="topbar-title">Ajukan Event Baru</div>
                <div class="topbar-subtitle">Lengkapi formulir untuk mengajukan kegiatan sekolah</div>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('calendar.index') }}" class="topbar-btn btn-outline">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Kalender
                </a>
            </div>
        </div>

        {{-- Content --}}
        <div class="dash-content">

            {{-- Breadcrumb --}}
            <div class="breadcrumb anim-1">
                <a href="#">Dashboard</a>
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('calendar.index') }}">Kalender</a>
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="current">Ajukan Event</span>
            </div>

            {{-- Form + Sidebar --}}
            <div class="form-layout">

                {{-- ===== FORM UTAMA ===== --}}
                <div class="anim-2">

                    {{-- Error alert --}}
                    @if($errors->any())
                        <div class="error-alert" style="margin-bottom:20px;">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <div>
                                <div class="error-alert-title">Mohon periksa kembali formulir:</div>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="form-card">

                        {{-- Banner --}}
                        <div class="form-banner">
                            <div class="form-banner-title">Form Pengajuan Kegiatan</div>
                            <div class="form-banner-sub">Isi semua field bertanda bintang dengan lengkap dan benar</div>
                            <div class="form-banner-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            </div>
                        </div>

                        {{-- Stepper --}}
                        <div class="stepper">
                            <div class="step active">
                                <div class="step-num">1</div>
                                <div class="step-label">Informasi Kegiatan</div>
                            </div>
                            <div class="step-sep"></div>
                            <div class="step pending">
                                <div class="step-num">2</div>
                                <div class="step-label">Waktu & Peserta</div>
                            </div>
                            <div class="step-sep"></div>
                            <div class="step pending">
                                <div class="step-num">3</div>
                                <div class="step-label">Deskripsi & Berkas</div>
                            </div>
                        </div>

                        {{-- Form --}}
                        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" id="eventForm">
                            @csrf

                            <div class="form-body">

                                {{-- ===== SEKSI 1: Informasi Kegiatan ===== --}}
                                <div class="section-title">
                                    <div class="step-badge">1</div>
                                    Informasi Kegiatan
                                </div>

                                {{-- Judul --}}
                                <div class="field-group">
                                    <label class="field-label">Judul Event <span class="req">*</span></label>
                                    <input type="text" name="title" id="title"
                                           value="{{ old('title') }}"
                                           class="field-input {{ $errors->has('title') ? 'has-error' : '' }}"
                                           placeholder="Contoh: Latihan Rutin Basket SMKN 1 Purwokerto"
                                           required autocomplete="off">
                                    @error('title')
                                        <div class="field-error">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Kategori + Ruangan --}}
                                <div class="two-col field-group">
                                    <div>
                                        <label class="field-label">Kategori <span class="req">*</span></label>
                                        <select name="category_id" class="field-select {{ $errors->has('category_id') ? 'has-error' : '' }}" required>
                                            <option value="">— Pilih Kategori —</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="field-error">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="field-label">Ruangan</label>
                                        <select name="room_id" id="roomSelect" class="field-select" onchange="checkRoomAvailability()">
                                            <option value="">— Luar Ruangan / Online —</option>
                                            @foreach($rooms as $room)
                                                <option value="{{ $room->id }}"
                                                    data-capacity="{{ $room->capacity }}"
                                                    {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                                    {{ $room->name }} (Kapasitas: {{ $room->capacity }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div id="roomCapacityInfo" class="field-hint" style="display:none;"></div>
                                    </div>
                                </div>

                                <div class="notice-box amber">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <p><strong>Penting:</strong> Jika ruangan yang dipilih sudah dipesan oleh pihak lain pada waktu yang sama, sistem akan otomatis menolak pengajuan ini.</p>
                                </div>

                                <div class="section-divider"></div>

                                {{-- ===== SEKSI 2: Waktu & Peserta ===== --}}
                                <div class="section-title">
                                    <div class="step-badge">2</div>
                                    Waktu & Peserta
                                </div>

                                {{-- Waktu Mulai & Selesai --}}
                                <div class="two-col field-group">
                                    <div>
                                        <label class="field-label">Waktu Mulai <span class="req">*</span></label>
                                        <input type="datetime-local" name="start_datetime" id="startDatetime"
                                               value="{{ old('start_datetime') }}"
                                               class="field-input {{ $errors->has('start_datetime') ? 'has-error' : '' }}"
                                               onchange="validateDates()"
                                               required>
                                        @error('start_datetime')
                                            <div class="field-error">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="field-label">Waktu Selesai <span class="req">*</span></label>
                                        <input type="datetime-local" name="end_datetime" id="endDatetime"
                                               value="{{ old('end_datetime') }}"
                                               class="field-input {{ $errors->has('end_datetime') ? 'has-error' : '' }}"
                                               onchange="validateDates()"
                                               required>
                                        @error('end_datetime')
                                            <div class="field-error">
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Duration preview --}}
                                <div id="durationPreview" class="notice-box blue" style="display:none; margin-top:-8px; margin-bottom:20px;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p id="durationText"></p>
                                </div>

                                {{-- Date error --}}
                                <div id="dateError" class="field-error" style="display:none; margin-top:-12px; margin-bottom:16px;">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Waktu selesai harus setelah waktu mulai.
                                </div>

                                {{-- Target Peserta --}}
                                <div class="field-group">
                                    <label class="field-label">Target Peserta</label>
                                    <input type="text" name="target_audience"
                                           value="{{ old('target_audience') }}"
                                           class="field-input"
                                           placeholder="Contoh: Semua Siswa / Kelas XI TKJ / Guru & Staf">
                                    <div class="field-hint">Opsional. Kosongkan jika terbuka untuk semua.</div>
                                </div>

                                {{-- Estimasi Peserta --}}
                                <div class="field-group">
                                    <label class="field-label">Estimasi Jumlah Peserta</label>
                                    <input type="number" name="estimated_participants"
                                           value="{{ old('estimated_participants') }}"
                                           class="field-input" min="1"
                                           placeholder="Contoh: 50">
                                    <div class="field-hint">Bantu kami menyiapkan kapasitas yang sesuai.</div>
                                </div>

                                <div class="section-divider"></div>

                                {{-- ===== SEKSI 3: Deskripsi & Berkas ===== --}}
                                <div class="section-title">
                                    <div class="step-badge">3</div>
                                    Deskripsi & Berkas
                                </div>

                                {{-- Deskripsi --}}
                                <div class="field-group">
                                    <label class="field-label">Deskripsi Kegiatan</label>
                                    <textarea name="description" class="field-textarea"
                                              placeholder="Jelaskan tujuan, susunan acara, dan hal penting lainnya...">{{ old('description') }}</textarea>
                                    <div class="field-hint">Semakin detail, semakin mudah direview oleh admin.</div>
                                </div>

                                {{-- File Upload --}}
                                <div class="field-group">
                                    <label class="field-label">Lampiran Dokumen</label>
                                    <div class="file-drop" id="fileDropArea">
                                        <input type="file" name="attachments[]" id="fileInput" multiple
                                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                               onchange="handleFiles(this.files)">
                                        <div class="file-drop-icon">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                        </div>
                                        <div class="file-drop-title">Klik atau seret file ke sini</div>
                                        <div class="file-drop-sub">Format: <span>PDF, DOC, DOCX, JPG, PNG</span> &bull; Maks. <span>5MB per file</span></div>
                                    </div>
                                    <div class="file-list" id="fileList"></div>
                                    <div class="field-hint">Lampirkan proposal kegiatan, surat izin, atau dokumen pendukung lainnya.</div>
                                </div>

                            </div>{{-- /form-body --}}

                            {{-- Actions --}}
                            <div class="form-actions">
                                <a href="{{ route('calendar.index') }}" class="btn-submit btn-submit-ghost">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Batal
                                </a>
                                <button type="submit" class="btn-submit btn-submit-primary" id="submitBtn">
                                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    Kirim Pengajuan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- ===== SIDEBAR KANAN ===== --}}
                <div class="form-sidebar-col anim-3">

                    {{-- Syarat & Ketentuan --}}
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            <div class="sh-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            Syarat Pengajuan
                        </div>
                        <div class="sidebar-card-body">
                            <ul class="checklist">
                                <li>
                                    <div class="check-icon check-ok">
                                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    Pengajuan minimal H-3 sebelum pelaksanaan
                                </li>
                                <li>
                                    <div class="check-icon check-ok">
                                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    Satu ruangan hanya bisa dipakai satu event di waktu bersamaan
                                </li>
                                <li>
                                    <div class="check-icon check-ok">
                                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    Lampirkan proposal jika kegiatan bersifat resmi
                                </li>
                                <li>
                                    <div class="check-icon check-info">
                                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    Admin akan mereview dalam 1×24 jam kerja
                                </li>
                                <li>
                                    <div class="check-icon check-info">
                                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    Notifikasi dikirim ke email setelah diproses
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Alur Persetujuan --}}
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            <div class="sh-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            </div>
                            Alur Persetujuan
                        </div>
                        <div class="sidebar-card-body">
                            <div class="timeline">
                                <div class="tl-item">
                                    <div class="tl-left">
                                        <div class="tl-dot done">1</div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title">Pengajuan Dikirim</div>
                                        <div class="tl-desc">Form ini diterima oleh sistem</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-left">
                                        <div class="tl-dot pending">2</div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title">Review oleh Admin</div>
                                        <div class="tl-desc">Maks. 1×24 jam kerja</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-left">
                                        <div class="tl-dot pending">3</div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title">Verifikasi Ruangan</div>
                                        <div class="tl-desc">Cek konflik jadwal otomatis</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-left">
                                        <div class="tl-dot pending">4</div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title">Notifikasi Email</div>
                                        <div class="tl-desc">Hasil dikirim ke emailmu</div>
                                    </div>
                                </div>
                                <div class="tl-item">
                                    <div class="tl-left">
                                        <div class="tl-dot pending">5</div>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title">Tampil di Kalender</div>
                                        <div class="tl-desc">Event terpublikasi jika disetujui</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bantuan --}}
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            <div class="sh-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            Butuh Bantuan?
                        </div>
                        <div class="sidebar-card-body">
                            <p style="font-size:12.5px; color:#64748b; font-weight:500; margin:0 0 12px; line-height:1.6;">Jika ada pertanyaan mengenai pengajuan event, hubungi kami:</p>
                            <div style="display:flex; flex-direction:column; gap:8px;">
                                <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#475569; font-weight:600;">
                                    <svg width="14" height="14" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    support@smkn1pwt.sch.id
                                </div>
                                <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#475569; font-weight:600;">
                                    <svg width="14" height="14" fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    (0281) 123456
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /sidebar-col --}}

            </div>{{-- /form-layout --}}

        </div>{{-- /dash-content --}}
    </main>
</div>

<script>
    // ===== VALIDASI WAKTU =====
    function validateDates() {
        const start = document.getElementById('startDatetime').value;
        const end   = document.getElementById('endDatetime').value;
        const errEl = document.getElementById('dateError');
        const durEl = document.getElementById('durationPreview');
        const durTx = document.getElementById('durationText');

        if (!start || !end) { errEl.style.display = 'none'; durEl.style.display = 'none'; return; }

        const s = new Date(start), e = new Date(end);

        if (e <= s) {
            errEl.style.display = 'flex';
            durEl.style.display = 'none';
            document.getElementById('submitBtn').disabled = true;
            return;
        }

        errEl.style.display = 'none';
        document.getElementById('submitBtn').disabled = false;

        // Hitung durasi
        const diffMs   = e - s;
        const diffHrs  = Math.floor(diffMs / 3600000);
        const diffMins = Math.floor((diffMs % 3600000) / 60000);
        let durStr = '';
        if (diffHrs > 0)  durStr += `${diffHrs} jam `;
        if (diffMins > 0) durStr += `${diffMins} menit`;

        const opts = { weekday:'long', day:'numeric', month:'long', year:'numeric' };
        const sameDay = s.toDateString() === e.toDateString();
        const sTime = s.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit' });
        const eTime = e.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit' });

        durTx.textContent = sameDay
            ? `Durasi: ${durStr.trim()} (${s.toLocaleDateString('id-ID', opts)}, ${sTime} – ${eTime})`
            : `Durasi: ${durStr.trim()} (Lintas hari)`;

        durEl.style.display = 'flex';
    }

    // ===== INFO KAPASITAS RUANGAN =====
    function checkRoomAvailability() {
        const sel  = document.getElementById('roomSelect');
        const info = document.getElementById('roomCapacityInfo');
        const opt  = sel.options[sel.selectedIndex];
        if (sel.value && opt.dataset.capacity) {
            info.textContent = `Kapasitas ruangan: ${opt.dataset.capacity} orang`;
            info.style.display = 'block';
        } else {
            info.style.display = 'none';
        }
    }

    // ===== FILE UPLOAD =====
    let selectedFiles = [];

    function handleFiles(newFiles) {
        const MAX_SIZE = 5 * 1024 * 1024; // 5MB
        Array.from(newFiles).forEach(file => {
            if (file.size > MAX_SIZE) {
                alert(`File "${file.name}" melebihi batas 5MB.`);
                return;
            }
            // Cek duplikat
            if (!selectedFiles.find(f => f.name === file.name && f.size === file.size)) {
                selectedFiles.push(file);
            }
        });
        renderFileList();
        syncFileInput();
    }

    function removeFile(idx) {
        selectedFiles.splice(idx, 1);
        renderFileList();
        syncFileInput();
    }

    function formatSize(bytes) {
        if (bytes < 1024)        return bytes + ' B';
        if (bytes < 1048576)     return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }

    function getFileIcon(name) {
        const ext = name.split('.').pop().toLowerCase();
        if (['jpg','jpeg','png','gif','webp'].includes(ext)) {
            return `<svg fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`;
        }
        if (ext === 'pdf') {
            return `<svg fill="none" stroke="#ef4444" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>`;
        }
        return `<svg fill="none" stroke="#2563eb" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`;
    }

    function renderFileList() {
        const list = document.getElementById('fileList');
        if (selectedFiles.length === 0) { list.innerHTML = ''; return; }
        list.innerHTML = selectedFiles.map((f, i) => `
            <div class="file-item">
                <div class="file-item-icon">${getFileIcon(f.name)}</div>
                <span class="file-item-name">${f.name}</span>
                <span class="file-item-size">${formatSize(f.size)}</span>
                <button type="button" class="file-item-del" onclick="removeFile(${i})">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        `).join('');
    }

    function syncFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));
        document.getElementById('fileInput').files = dt.files;
    }

    // Drag & drop
    const dropArea = document.getElementById('fileDropArea');
    ['dragenter','dragover'].forEach(ev => {
        dropArea.addEventListener(ev, e => { e.preventDefault(); dropArea.classList.add('dragging'); });
    });
    ['dragleave','drop'].forEach(ev => {
        dropArea.addEventListener(ev, e => { e.preventDefault(); dropArea.classList.remove('dragging'); });
    });
    dropArea.addEventListener('drop', e => {
        handleFiles(e.dataTransfer.files);
    });

    // ===== STEPPER VISUAL (scroll-based) =====
    function updateStepper() {
        const sections = [
            document.querySelector('.section-title:nth-of-type(1)'),
        ];
        // Sederhana: step selesai saat field section itu terisi
        const title = document.getElementById('title').value;
        const start = document.getElementById('startDatetime').value;
        const steps = document.querySelectorAll('.step');

        if (title) {
            steps[0].className = 'step done';
            steps[1].className = 'step active';
        }
        if (title && start) {
            steps[0].className = 'step done';
            steps[1].className = 'step done';
            steps[2].className = 'step active';
        }
        // Update separators
        document.querySelectorAll('.step-sep').forEach((sep, i) => {
            if (steps[i] && steps[i].classList.contains('done')) {
                sep.style.background = 'var(--blue-300)';
            } else {
                sep.style.background = '#e8edf8';
            }
        });
    }

    document.getElementById('title').addEventListener('input', updateStepper);
    document.getElementById('startDatetime').addEventListener('change', updateStepper);

    // ===== SUBMIT LOADING STATE =====
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = `
            <svg style="animation:spin 1s linear infinite; width:17px; height:17px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Mengirim...
        `;
        btn.disabled = true;
        btn.style.opacity = '0.85';
    });

    // Spin animation
    const style = document.createElement('style');
    style.textContent = '@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
    document.head.appendChild(style);

    // Init
    validateDates();
    checkRoomAvailability();
</script>

</x-app-layout>