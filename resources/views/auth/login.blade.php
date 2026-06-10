<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - Storelink Retail POS</title>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Google Fonts: Inter -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Tailwind Config -->
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary-fixed-dim": "#b4c5ff",
                    "outline": "#737686",
                    "surface": "#f8f9ff",
                    "on-primary-fixed-variant": "#003ea8",
                    "on-secondary-fixed": "#002113",
                    "on-primary-fixed": "#00174b",
                    "background": "#f8f9ff",
                    "inverse-primary": "#b4c5ff",
                    "error-container": "#ffdad6",
                    "tertiary-fixed": "#ffddb8",
                    "on-surface-variant": "#434655",
                    "on-primary-container": "#eeefff",
                    "surface-bright": "#f8f9ff",
                    "on-tertiary-fixed": "#2a1700",
                    "on-surface": "#121c2a",
                    "on-secondary-container": "#00714d",
                    "tertiary": "#784b00",
                    "on-tertiary-fixed-variant": "#653e00",
                    "primary": "#004ac6",
                    "on-secondary-fixed-variant": "#005236",
                    "inverse-on-surface": "#eaf1ff",
                    "surface-tint": "#0053db",
                    "primary-container": "#2563eb",
                    "on-secondary": "#ffffff",
                    "on-primary": "#ffffff",
                    "surface-container-lowest": "#ffffff",
                    "on-error-container": "#93000a",
                    "outline-variant": "#c3c6d7",
                    "on-tertiary": "#ffffff",
                    "surface-dim": "#d0dbed",
                    "surface-container-low": "#eff4ff",
                    "secondary-container": "#6cf8bb",
                    "on-tertiary-container": "#ffeedd",
                    "surface-variant": "#d9e3f6",
                    "surface-container-highest": "#d9e3f6",
                    "secondary-fixed-dim": "#4edea3",
                    "on-error": "#ffffff",
                    "error": "#ba1a1a",
                    "surface-container-high": "#dee9fc",
                    "inverse-surface": "#27313f",
                    "tertiary-fixed-dim": "#ffb95f",
                    "surface-container": "#e6eeff",
                    "on-background": "#121c2a",
                    "secondary": "#006c49",
                    "primary-fixed": "#dbe1ff",
                    "tertiary-container": "#996100",
                    "secondary-fixed": "#6ffbbe"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "2xl": "1rem",
                    "full": "9999px"
            },
            "spacing": {
                    "sidebar-width": "80px",
                    "margin-desktop": "24px",
                    "gutter": "16px",
                    "cart-panel-width": "380px",
                    "margin-mobile": "16px",
                    "unit": "4px"
            },
            "fontFamily": {
                    "headline-sm": ["Inter"],
                    "body-md": ["Inter"],
                    "body-lg": ["Inter"],
                    "label-lg": ["Inter"],
                    "headline-md": ["Inter"],
                    "headline-lg": ["Inter"],
                    "label-md": ["Inter"],
                    "mono-label": ["Inter"],
                    "body-sm": ["Inter"]
            },
            "fontSize": {
                    "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "body-lg": ["18px", {"lineHeight": "26px", "fontWeight": "400"}],
                    "label-lg": ["14px", {"lineHeight": "20px", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "headline-lg": ["30px", {"lineHeight": "38px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "label-md": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                    "mono-label": ["13px", {"lineHeight": "18px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
            },
            keyframes: {
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                }
            }
          }
        }
      }
    </script>
</head>
<body class="bg-gradient-to-br from-surface-container-low via-surface-container-low to-primary-fixed min-h-screen flex items-center justify-center p-margin-mobile md:p-margin-desktop relative overflow-hidden font-body-md text-on-surface">
<!-- Ambient Background Elements for Depth -->
<div class="absolute top-[-10%] left-[-10%] w-[80vw] h-[80vw] md:w-[40vw] md:h-[40vw] bg-primary-fixed/40 rounded-full blur-[100px] md:blur-[120px] pointer-events-none mix-blend-multiply"></div>
<div class="absolute bottom-[-10%] right-[-5%] w-[70vw] h-[70vw] md:w-[35vw] md:h-[35vw] bg-secondary-fixed/30 rounded-full blur-[80px] md:blur-[100px] pointer-events-none mix-blend-multiply"></div>
<!-- Login Card Container -->
<main class="w-full max-w-[440px] bg-surface-container-lowest/70 backdrop-blur-xl rounded-2xl shadow-[0_8px_32px_rgba(0,0,0,0.08)] border border-white/40 relative z-10 overflow-hidden animate-fade-in-up">
<!-- Header Top Accent -->
<div class="h-1.5 w-full bg-gradient-to-r from-primary to-primary-container"></div>
<div class="p-8 md:p-12">
<!-- Brand & Greeting -->
<div class="text-center mb-10">
<div class="flex justify-center items-center gap-3 mb-5">
<svg class="w-10 h-10 text-primary mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
</svg>
<h1 class="font-headline-lg text-[32px] font-bold text-primary tracking-tight">Storelink</h1>
</div>
<h2 class="font-headline-sm text-headline-sm text-on-surface mb-2">Selamat Datang</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Silakan masuk ke akun Anda</p>
</div>

@if ($errors->any())
<div class="mb-6 rounded-xl border border-error/20 bg-error-container p-4 text-sm text-on-error-container flex items-center gap-3">
    <span class="material-symbols-outlined text-[20px]">error</span>
    <p class="font-medium">{{ $errors->first() }}</p>
</div>
@endif

<!-- Login Form -->
<form action="{{ route('login.submit') }}" class="space-y-6" method="POST">
@csrf
<!-- Email/Username Input -->
<div class="space-y-2">
<label class="block font-label-md text-label-md text-on-surface-variant" for="username">Username</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors duration-300 text-[20px]">person</span>
</div>
<input class="block w-full pl-12 pr-4 py-3.5 bg-surface-bright/50 border border-outline-variant/60 rounded-xl text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-bright focus:ring-2 focus:ring-primary-container/30 focus:border-primary transition-all duration-300 outline-none shadow-sm" id="username" name="username" placeholder="username" required="" type="text" value="{{ old('username') }}"/>
</div>
</div>
<!-- Password Input -->
<div class="space-y-2">
<label class="block font-label-md text-label-md text-on-surface-variant" for="password">Password</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
<span class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors duration-300 text-[20px]">lock</span>
</div>
<input class="block w-full pl-12 pr-12 py-3.5 bg-surface-bright/50 border border-outline-variant/60 rounded-xl text-on-surface font-body-md text-body-md placeholder:text-outline focus:bg-surface-bright focus:ring-2 focus:ring-primary-container/30 focus:border-primary transition-all duration-300 outline-none shadow-sm" id="password" name="password" placeholder="••••••••" required="" type="password"/>
<button class="absolute inset-y-0 right-0 pr-4 flex items-center text-outline hover:text-on-surface transition-colors focus:outline-none" id="togglePassword" type="button">
<span class="material-symbols-outlined text-[20px]" id="visibilityIcon">visibility_off</span>
</button>
</div>
</div>
<!-- Additional Options -->
<div class="flex items-center justify-between pt-1">
<div class="flex items-center">
<input class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary/20 focus:ring-offset-0 bg-surface-bright cursor-pointer transition-colors" id="remember-me" name="remember" type="checkbox"/>
<label class="ml-2 block font-label-md text-label-md text-on-surface-variant cursor-pointer select-none" for="remember-me">
                            Remember Me
                        </label>
</div>
</div>

<!-- Submit Button -->
<div class="pt-6">
<button class="w-full flex justify-center items-center py-3.5 px-4 rounded-xl shadow-[0_4px_12px_rgba(37,99,235,0.25)] font-label-lg text-label-lg text-on-primary-container bg-gradient-to-r from-primary to-primary-container hover:shadow-[0_6px_16px_rgba(37,99,235,0.35)] hover:-translate-y-0.5 transition-all duration-300 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" type="submit">
                        Masuk
                        <span class="material-symbols-outlined ml-2 text-[20px]">arrow_forward</span>
</button>
</div>
</form>
</div>
<!-- Bottom Decorative Footer -->
<div class="bg-surface-bright/40 py-4 border-t border-white/20 text-center backdrop-blur-md flex flex-col items-center justify-center gap-1">
    <p class="font-label-md text-label-md text-outline">Storelink POS System v1.0.0</p>
    <div class="flex flex-col items-center justify-center opacity-80 hover:opacity-100 transition-opacity mt-1">
        <span class="text-[10px] text-outline font-medium tracking-wider uppercase mb-0.5">Powered by</span>
        <img src="{{ asset('image/logo_nubra.png') }}" alt="Nubra Solutions" class="h-10 object-contain" />
    </div>
</div>
</main>
<script>
        // Simple password toggle logic
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const visibilityIcon = document.getElementById('visibilityIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'password') {
                visibilityIcon.textContent = 'visibility_off';
            } else {
                visibilityIcon.textContent = 'visibility';
            }
        });
    </script>
</body>
</html>