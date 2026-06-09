<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Storelink POS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
<body class="bg-surface text-on-surface font-body-md antialiased p-margin-desktop">

    @yield('content')

</body>
</html>
