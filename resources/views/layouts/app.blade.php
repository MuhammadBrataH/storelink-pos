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
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-primary-fixed-variant": "#003ea8",
                      "background": "#f8f9ff",
                      "on-primary-fixed": "#00174b",
                      "on-background": "#121c2a",
                      "outline": "#737686",
                      "primary-fixed": "#dbe1ff",
                      "secondary-fixed-dim": "#4edea3",
                      "surface-container-lowest": "#ffffff",
                      "tertiary-fixed": "#ffddb8",
                      "primary-fixed-dim": "#b4c5ff",
                      "surface-bright": "#f8f9ff",
                      "surface-container-high": "#dee9fc",
                      "on-secondary": "#ffffff",
                      "on-error": "#ffffff",
                      "surface": "#f8f9ff",
                      "on-tertiary-fixed": "#2a1700",
                      "surface-dim": "#d0dbed",
                      "on-secondary-container": "#00714d",
                      "outline-variant": "#c3c6d7",
                      "secondary-container": "#6cf8bb",
                      "on-surface-variant": "#434655",
                      "on-primary": "#ffffff",
                      "inverse-on-surface": "#eaf1ff",
                      "on-primary-container": "#eeefff",
                      "on-error-container": "#93000a",
                      "on-tertiary-container": "#ffeedd",
                      "tertiary-fixed-dim": "#ffb95f",
                      "tertiary": "#784b00",
                      "surface-container": "#e6eeff",
                      "on-tertiary-fixed-variant": "#653e00",
                      "surface-container-highest": "#d9e3f6",
                      "inverse-surface": "#27313f",
                      "inverse-primary": "#b4c5ff",
                      "on-tertiary": "#ffffff",
                      "error": "#ba1a1a",
                      "primary-container": "#2563eb",
                      "tertiary-container": "#996100",
                      "surface-tint": "#0053db",
                      "on-surface": "#121c2a",
                      "on-secondary-fixed": "#002113",
                      "error-container": "#ffdad6",
                      "on-secondary-fixed-variant": "#005236",
                      "secondary-fixed": "#6ffbbe",
                      "surface-container-low": "#eff4ff",
                      "secondary": "#006c49",
                      "primary": "#004ac6",
                      "surface-variant": "#d9e3f6"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "cart-panel-width": "380px",
                      "gutter": "16px",
                      "sidebar-width": "80px",
                      "margin-mobile": "16px",
                      "unit": "4px",
                      "margin-desktop": "24px"
              },
              "fontFamily": {
                      "headline-md": ["Inter"],
                      "body-md": ["Inter"],
                      "headline-lg": ["Inter"],
                      "headline-sm": ["Inter"],
                      "body-sm": ["Inter"],
                      "body-lg": ["Inter"],
                      "mono-label": ["Inter"],
                      "label-md": ["Inter"],
                      "label-lg": ["Inter"]
              },
              "fontSize": {
                      "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                      "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                      "headline-lg": ["30px", {"lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                      "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                      "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                      "body-lg": ["18px", {"lineHeight": "26px", "fontWeight": "400"}],
                      "mono-label": ["13px", {"lineHeight": "18px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                      "label-md": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                      "label-lg": ["14px", {"lineHeight": "20px", "fontWeight": "600"}]
              }
            }
          }
        }
    </script>
    <style>
        .material-symbols-outlined {
          font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
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
        <!-- Right Nav Profile -->
        <div class="flex items-center space-x-5">
            <!-- Profile -->
            <div class="flex items-center space-x-3 border-l pl-5 border-gray-200">
                <img alt="User Avatar" class="h-8 w-8 rounded-full object-cover border border-gray-200 bg-gray-100"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuASaThGtpL0MUG5_G9b0uQ7z1jZRbonGeqvGgJzvhy0QaBok3zCv33d36FEEzkB81Ep0QmHxoyHHuhu0AORseDF7_-5SPJ2UTll04FX1oIa2cNBfLWkZ0-tXUqdGJ_oqFNmrL11bagKrnCT79FGwijKzOu7jzdJ4OVwXupsw330JOnvY32-PWD5UuyAzvvolmIrT-XCTDGbctGpSAme-wxRiZAvTduj3gwL1g4UrtJrjIJ7Bg-vqlZbD_Nmsr5GxAv8sAy8J1Xt-G0" />
                <span class="text-sm font-medium text-gray-700">Halo, {{ auth()->user()->name ?: auth()->user()->username }}!</span>
            </div>
            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-1 text-red-600 hover:text-red-800 transition-colors text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            </form>
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
                <div class="relative flex justify-center items-center w-full py-3">
                    @if (request()->routeIs('home'))
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-600 rounded-r-md"></div>
                    @endif
                    <a class="{{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:text-gray-600' }} p-2 rounded-lg flex justify-center items-center relative group w-full transition-colors"
                        href="{{ route('home') }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <!-- Tooltip -->
                        <div class="absolute left-full ml-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 whitespace-nowrap transition-opacity pointer-events-none">
                            Dashboard
                            <div class="absolute right-full top-1/2 transform -translate-y-1/2 w-0 h-0 border-t-4 border-t-transparent border-r-4 border-r-gray-700 border-b-4 border-b-transparent"></div>
                        </div>
                    </a>
                </div>
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

        <main class="flex-1 overflow-y-auto bg-surface">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>