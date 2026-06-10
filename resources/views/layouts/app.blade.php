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
                      "sidebar-width": "256px",
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
                <!-- tambahkan icon user -->
                <span class="material-symbols-outlined text-gray-700">person</span>
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
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col py-6 flex-shrink-0 z-20"
            data-purpose="main-sidebar">
            <!-- Navigation Items -->
            <nav class="flex flex-col space-y-2 w-full px-4">
                <div class="w-full">
                    <a class="{{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-4 py-3 rounded-xl flex items-center group w-full transition-all duration-200"
                        href="{{ route('home') }}">
                        <svg class="w-6 h-6 mr-3 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <span class="text-sm">Dashboard</span>
                    </a>
                </div>

                <div class="w-full">
                    <a class="{{ request()->routeIs('inventory.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-4 py-3 rounded-xl flex items-center group w-full transition-all duration-200"
                        href="{{ route('inventory.index') }}">
                        <svg class="w-6 h-6 mr-3 {{ request()->routeIs('inventory.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <span class="text-sm">Inventory</span>
                    </a>
                </div>

                <div class="w-full">
                    <a class="{{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }} px-4 py-3 rounded-xl flex items-center group w-full transition-all duration-200"
                        href="{{ route('users.index') }}">
                        <svg class="w-6 h-6 mr-3 {{ request()->routeIs('users.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-sm">Manajemen User</span>
                    </a>
                </div>
            </nav>

            <!-- Nubra Copyright Logo -->
            <div class="mt-auto pt-6 pb-4 px-6 flex flex-col items-center justify-center w-full border-t border-gray-100 text-center">
                <span class="text-[11px] text-gray-500 font-semibold mb-3 tracking-widest uppercase bg-gray-50 px-3 py-1 rounded-full inline-block">Powered by</span>
                <img src="{{ asset('image/logo_nubra.png') }}" alt="Nubra Solutions" class="w-36 object-contain hover:scale-105 transition-transform duration-300 drop-shadow-sm mx-auto" />
            </div>
        </aside>
        <!-- END: Sidebar -->

        <main class="flex-1 overflow-y-auto bg-surface">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>