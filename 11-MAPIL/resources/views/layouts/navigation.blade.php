<nav x-data="{ open: false }" class="bg-white border-b border-blue-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('calendar.index') }}" class="flex items-center gap-2">
                    <div class="p-2 bg-blue-600 rounded-lg shadow-blue-200 shadow-lg">
                        <x-application-logo class="block h-6 w-auto fill-current text-white" />
                    </div>
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-8 bg-blue-50/50 px-8 py-2 rounded-full border border-blue-100 my-auto">
                <x-nav-link :href="auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'guru' ? route('guru.dashboard') : route('siswa.dashboard'))" 
                    :active="request()->routeIs('*.dashboard')" class="text-sm font-bold uppercase tracking-widest">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <x-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.index')" class="text-sm font-bold uppercase tracking-widest">
                    {{ __('Kalender') }}
                </x-nav-link>
            </div>

            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>