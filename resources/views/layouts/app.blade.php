<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Inventory Management Dashboard</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>



<body class="bg-slate-50 text-gray-800 h-screen overflow-hidden">

    <!-- BEGIN: MainHeader -->
    <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 z-10"
        data-purpose="top-navbar">
        <!-- Logo Text Area -->
        <div class="flex items-center space-x-2 font-bold text-lg tracking-wide text-gray-800">
            <!-- Logo SVG -->
            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewbox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
            <span>STORELINK</span>
        </div>
        <!-- Search Bar -->
        @if (request()->routeIs('inventory.index'))
            <form action="{{ route('inventory.index') }}" class="flex-1 max-w-xl mx-8 relative" method="GET" x-data>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"></path>
                    </svg>
                </div>
                <input @input.debounce.300ms="$el.closest('form').submit()"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-100 rounded-lg leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors"
                    name="search" placeholder="Cari produk, transaksi, laporan..." type="text"
                    value="{{ $search ?? '' }}" />
            </form>
        @endif
        <!-- Right Nav Profile/Icons -->
        <div class="flex items-center space-x-5">
            <!-- Notifications -->
            <button class="text-gray-400 hover:text-gray-500 relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span
                    class="absolute top-0 right-0 block h-4 w-4 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center transform translate-x-1 -translate-y-1">3</span>
            </button>
            <!-- Settings Header Icon -->
            <button class="text-gray-400 hover:text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"></path>
                </svg>
            </button>
            <!-- Profile -->
            <div class="flex items-center space-x-3 border-l pl-5 border-gray-200">
                <img alt="User Avatar" class="h-8 w-8 rounded-full object-cover border border-gray-200 bg-gray-100"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuASaThGtpL0MUG5_G9b0uQ7z1jZRbonGeqvGgJzvhy0QaBok3zCv33d36FEEzkB81Ep0QmHxoyHHuhu0AORseDF7_-5SPJ2UTll04FX1oIa2cNBfLWkZ0-tXUqdGJ_oqFNmrL11bagKrnCT79FGwijKzOu7jzdJ4OVwXupsw330JOnvY32-PWD5UuyAzvvolmIrT-XCTDGbctGpSAme-wxRiZAvTduj3gwL1g4UrtJrjIJ7Bg-vqlZbD_Nmsr5GxAv8sAy8J1Xt-G0" />
                <span class="text-sm font-medium text-gray-700">Halo, Pak Budi!</span>
            </div>
        </div>
    </header>
    <!-- END: MainHeader -->

    <div class="flex h-[calc(100vh-4rem)] overflow-hidden">
        <!-- BEGIN: Sidebar -->
        <aside class="w-20 bg-white border-r border-gray-200 flex flex-col items-center py-6 flex-shrink-0 z-20"
            data-purpose="main-sidebar">
            <!-- Logo Icon (Dummy) -->
            <div class="mb-10 text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"></path>
                </svg>
            </div>
            <!-- Navigation Icons -->
            <nav class="flex flex-col space-y-4 w-full">
                <!-- Home -->
                <a class="flex justify-center items-center w-full py-3 text-gray-400 hover:text-gray-600 transition-colors"
                    href="#">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </a>
                <!-- Inventory (Active) arahkan ke -->
                <div class="relative flex justify-center items-center w-full py-3">
                    @if (request()->routeIs('inventory.*'))
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-600 rounded-r-md"></div>
                    @endif
                    <a class="{{ request()->routeIs('inventory.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:text-gray-600' }} p-2 rounded-lg flex justify-center items-center relative group w-full"
                        href="{{ route('inventory.index') }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <!-- Tooltip -->
                        <div
                            class="absolute left-full ml-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 whitespace-nowrap transition-opacity pointer-events-none">
                            Inventory Page
                            <div
                                class="absolute right-full top-1/2 transform -translate-y-1/2 w-0 h-0 border-t-4 border-t-transparent border-r-4 border-r-gray-700 border-b-4 border-b-transparent">
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Analytics -->
                <a class="flex justify-center items-center w-full py-3 text-gray-400 hover:text-gray-600 transition-colors"
                    href="#">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                </a>
                <!-- Users -->
                <a class="flex justify-center items-center w-full py-3 text-gray-400 hover:text-gray-600 transition-colors group relative {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-600 rounded-lg' : '' }}"
                    href="{{ route('users.index') }}">
                    @if (request()->routeIs('users.*'))
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-600 rounded-r-md"></div>
                    @endif
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <!-- Tooltip -->
                    <div
                        class="absolute left-full ml-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 whitespace-nowrap transition-opacity pointer-events-none">
                        Manajemen User
                        <div
                            class="absolute right-full top-1/2 transform -translate-y-1/2 w-0 h-0 border-t-4 border-t-transparent border-r-4 border-r-gray-700 border-b-4 border-b-transparent">
                        </div>
                    </div>
                </a>
            </nav>
        </aside>
        <!-- END: Sidebar -->

        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>