<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Student Hub SMKN 1 Purwokerto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .role-card {
            transition: all 0.2s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .role-card:hover {
            transform: translateY(-2px);
        }
        .role-card.active {
            border-color: currentColor;
            background-color: currentColor;
        }
        .role-card.active .role-icon,
        .role-card.active .role-label {
            color: white !important;
        }

        /* Subtle fade-in animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-anim { animation: fadeInUp 0.45s ease both; }
        .card-anim-delay { animation: fadeInUp 0.45s ease 0.1s both; }

        /* Password toggle */
        #toggle-password { cursor: pointer; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50 antialiased min-h-screen">

    {{-- Background decorative blobs --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-100 rounded-full opacity-40 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-indigo-100 rounded-full opacity-30 blur-3xl"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-center py-10 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center card-anim">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-3xl shadow-xl shadow-blue-200 mb-5 hover:rotate-6 transition-transform duration-300">
                <svg class="w-11 h-11 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-blue-900 tracking-tight">Student Hub</h1>
            <p class="mt-1.5 text-sm text-blue-400 font-medium">Sistem Penjadwalan Event SMKN 1 Purwokerto</p>
        </div>

        {{-- Login Card --}}
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[460px] card-anim-delay">
            <div class="bg-white/80 backdrop-blur-md py-10 px-6 shadow-[0_20px_60px_rgba(8,112,184,0.10)] sm:rounded-[28px] sm:px-10 border border-white/70 relative overflow-hidden">

                {{-- Decorative circle --}}
                <div class="absolute -top-20 -right-20 w-44 h-44 bg-blue-50 rounded-full opacity-60 pointer-events-none"></div>

                {{-- Flash Messages (Errors) --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4 flex gap-3 items-start">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-bold text-red-700 mb-1">Login gagal</p>
                            @foreach ($errors->all() as $error)
                                <p class="text-xs text-red-600">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Session Status (e.g. after logout) --}}
                @if (session('status'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-4 text-sm text-green-700 font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="space-y-5 relative" action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf

                    {{-- Role Selector --}}
                    <div>
                        <label class="block text-sm font-bold text-blue-900 mb-3">Masuk sebagai</label>
                        <div class="grid grid-cols-4 gap-2" id="roleSelector">

                            @php
                                $roles = [
                                    ['value' => 'siswa',   'label' => 'Siswa',   'color' => 'text-blue-600',   'active_bg' => 'bg-blue-600',   'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
                                    ['value' => 'guru',    'label' => 'Guru',    'color' => 'text-indigo-600',  'active_bg' => 'bg-indigo-600',  'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                                    ['value' => 'panitia', 'label' => 'Panitia', 'color' => 'text-violet-600',  'active_bg' => 'bg-violet-600',  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                                    ['value' => 'admin',   'label' => 'Admin',   'color' => 'text-rose-600',    'active_bg' => 'bg-rose-600',    'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                                ];
                            @endphp

                            @foreach ($roles as $role)
                                <button type="button"
                                    data-role="{{ $role['value'] }}"
                                    class="role-card flex flex-col items-center gap-1.5 py-3 px-2 rounded-2xl border-2 border-slate-200 bg-slate-50 hover:border-current {{ $role['color'] }} {{ old('role') === $role['value'] ? 'active' : '' }}"
                                    onclick="selectRole('{{ $role['value'] }}', this)">
                                    <svg class="role-icon w-6 h-6 {{ $role['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $role['icon'] }}"/>
                                    </svg>
                                    <span class="role-label text-xs font-bold {{ $role['color'] }}">{{ $role['label'] }}</span>
                                </button>
                            @endforeach
                        </div>

                        {{-- Hidden input untuk mengirim role --}}
                        <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'siswa') }}">
                        @error('role')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-blue-900 mb-2">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-blue-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required
                                value="{{ old('email') }}"
                                autocomplete="email"
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border @error('email') border-red-400 @else border-slate-200 @enderror rounded-2xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"
                                placeholder="Masukkan email aktif kamu">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-blue-900 mb-2">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-blue-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required
                                autocomplete="current-password"
                                class="block w-full pl-11 pr-12 py-3.5 bg-slate-50 border @error('password') border-red-400 @else border-slate-200 @enderror rounded-2xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"
                                placeholder="••••••••">
                            {{-- Toggle show/hide password --}}
                            <button type="button" id="toggle-password"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-blue-500 transition-colors"
                                onclick="togglePassword()">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember & Lupa sandi --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center cursor-pointer group">
                            <input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                            <span class="ml-2 text-slate-500 group-hover:text-blue-900 transition-colors">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-semibold text-blue-600 hover:text-blue-700 underline decoration-blue-100 underline-offset-4">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full flex justify-center items-center gap-2 py-4 px-4 rounded-2xl shadow-lg shadow-blue-100 text-sm font-extrabold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                        <span id="btnText">Masuk ke Dashboard</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </form>

                {{-- Register Footer --}}
                <div class="mt-7 pt-7 border-t border-slate-100">
                    <p class="text-center text-sm text-slate-500">
                        Belum punya akun?
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700 ml-1">Daftar Sekarang</a>
                        @endif
                    </p>
                </div>
            </div>

            {{-- School Branding Footer --}}
            <div class="mt-8 flex flex-col items-center gap-3">
                <div class="flex items-center gap-5">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9c/Logo_SMK_Negeri_1_Purwokerto.png"
                        class="h-8 opacity-60 grayscale hover:grayscale-0 transition-all duration-300"
                        alt="Logo SMKN 1 Purwokerto">
                    <div class="h-4 w-px bg-slate-300"></div>
                    <span class="text-[10px] uppercase tracking-[0.18em] font-bold text-slate-400 leading-relaxed text-center">
                        SMK Negeri 1 Purwokerto<br>Unggul &amp; Berkarakter
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- Role Selector Logic ---
        const roleColors = {
            siswa:   { border: '#2563eb', bg: '#2563eb' },
            guru:    { border: '#4f46e5', bg: '#4f46e5' },
            panitia: { border: '#7c3aed', bg: '#7c3aed' },
            admin:   { border: '#e11d48', bg: '#e11d48' },
        };

        function selectRole(roleValue, clickedEl) {
            // Reset all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('active');
                card.style.backgroundColor = '';
                card.style.borderColor = '';
                const icon = card.querySelector('.role-icon');
                const label = card.querySelector('.role-label');
                if (icon) icon.style.color = '';
                if (label) label.style.color = '';
            });

            // Activate clicked card
            const colors = roleColors[roleValue];
            clickedEl.classList.add('active');
            clickedEl.style.backgroundColor = colors.bg;
            clickedEl.style.borderColor = colors.border;

            const icon = clickedEl.querySelector('.role-icon');
            const label = clickedEl.querySelector('.role-label');
            if (icon) icon.style.color = 'white';
            if (label) label.style.color = 'white';

            // Update hidden input
            document.getElementById('roleInput').value = roleValue;

            // Update submit button hint
            const labels = { siswa: 'Siswa', guru: 'Guru', panitia: 'Panitia', admin: 'Admin' };
            document.getElementById('btnText').textContent = `Masuk sebagai ${labels[roleValue]}`;
        }

        // Auto-activate role from old() value on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedRole = document.getElementById('roleInput').value || 'siswa';
            const card = document.querySelector(`[data-role="${savedRole}"]`);
            if (card) selectRole(savedRole, card);
        });

        // --- Toggle Password Visibility ---
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            eyeIcon.innerHTML = isHidden
                ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    </script>
</body>
</html>