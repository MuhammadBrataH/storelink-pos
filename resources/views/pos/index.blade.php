<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>POS - Storelink POS</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen bg-slate-50 p-6">
    <div class="max-w-4xl mx-auto bg-white border border-slate-200 rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-slate-900">Halaman POS</h1>
        <p class="text-slate-600 mt-2">Kasir masuk langsung ke POS.</p>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button class="text-sm text-slate-700 underline" type="submit">Logout</button>
        </form>
    </div>
</body>

</html>