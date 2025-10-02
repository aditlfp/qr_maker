<div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-100 flex">
    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static"
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

        <!-- Logo -->
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <x-application-logo class="h-9 w-auto fill-current text-gray-800" />
            </a>
            <!-- Close button for mobile -->
            <button @click="sidebarOpen = false"
                class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-hidden">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto" style="max-height: calc(100vh - 180px);">
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('Dashboard') }}
            </a>

            <div>
                {{-- Check Auth And Admin Auth --}}
                @auth
                    <h3 class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        {{ __('Master Data') }}
                    </h3>
                    {{-- Barcode Link --}}
                    <a href="{{ route('barcodes.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-150 {{ request()->routeIs('barcodes.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#a)" stroke="#000000" stroke-width="1.5" stroke-miterlimit="10">
                                <path
                                    d="M5 23H3.4A2.4 2.4 0 0 1 1 20.6V19m18 4h1.6a2.4 2.4 0 0 0 2.4-2.4V19m0-14V3.4A2.4 2.4 0 0 0 20.6 1H19M5 1H3.4A2.4 2.4 0 0 0 1 3.4V5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M8.4 4H5.6A1.6 1.6 0 0 0 4 5.6v2.8A1.6 1.6 0 0 0 5.6 10h2.8A1.6 1.6 0 0 0 10 8.4V5.6A1.6 1.6 0 0 0 8.4 4Z"
                                    fill="#000000" fill-opacity=".16" />
                                <path
                                    d="M8.4 14H5.6A1.6 1.6 0 0 0 4 15.6v2.8A1.6 1.6 0 0 0 5.6 20h2.8a1.6 1.6 0 0 0 1.6-1.6v-2.8A1.6 1.6 0 0 0 8.4 14ZM18.4 4h-2.8A1.6 1.6 0 0 0 14 5.6v2.8a1.6 1.6 0 0 0 1.6 1.6h2.8A1.6 1.6 0 0 0 20 8.4V5.6A1.6 1.6 0 0 0 18.4 4Z"
                                    fill="#ffffff" />
                                <path
                                    d="M18.4 14h-2.8a1.6 1.6 0 0 0-1.6 1.6v2.8a1.6 1.6 0 0 0 1.6 1.6h2.8a1.6 1.6 0 0 0 1.6-1.6v-2.8a1.6 1.6 0 0 0-1.6-1.6Z"
                                    fill="#000000" fill-opacity=".16" />
                            </g>

                            <defs>

                                <clipPath id="a">

                                    <path fill="#ffffff" d="M0 0h24v24H0z" />

                                </clipPath>

                            </defs>

                        </svg>
                        {{ __('Barcode') }}
                    </a>
                @endauth
            </div>
        </nav>

        <!-- User Profile Section -->
        <div class="absolute bottom-0 left-0 right-0 border-t border-gray-200 bg-white">
            <div x-data="{ userMenu: false }" class="relative">
                <!-- User Profile Button -->
                <button @click="userMenu = !userMenu"
                    class="flex items-center w-full px-6 py-4 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-150 focus:outline-hidden">
                    <div class="flex items-center flex-1 min-w-0">
                        <div class="shrink-0">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="ml-3 text-left overflow-hidden">
                            <div class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-150 shrink-0"
                        :class="{ 'rotate-180': userMenu }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="userMenu" @click.away="userMenu = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute bottom-full left-0 right-0 mb-2 mx-4 bg-white rounded-lg shadow-lg border border-gray-200 py-1"
                    style="display: none;">

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                        <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ __('Profile') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150 text-left">
                            <svg class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden" style="display: none;">
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
        <!-- Mobile Header -->
        <div class="lg:hidden bg-white border-b border-gray-200 sticky top-0 z-30">
            <div class="flex items-center justify-between h-16 px-4">
                <button @click="sidebarOpen = true"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="h-8 w-auto fill-current text-gray-800" />
                </a>
                <div class="w-10"></div>
            </div>
        </div>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-[1.20rem] px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1 bg-gray-100">
            {{ $slot }}
        </main>
    </div>
</div>
