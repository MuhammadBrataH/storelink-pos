<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Storelink POS</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen bg-slate-50 flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white border border-slate-200 rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-semibold text-slate-900">Login</h1>
        <p class="text-slate-500 text-sm mt-1">Masuk sebagai Admin atau Kasir</p>

        @if ($errors->any())
        <div class="mt-4 rounded-md bg-red-50 text-red-700 text-sm p-3">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700" for="username">Username</label>
                <input
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-slate-900" />
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700" for="password">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-slate-900" />
            </div>

            <button
                type="submit"
                class="w-full rounded-md bg-slate-900 text-white py-2 text-sm font-medium hover:bg-slate-800">
                Masuk
            </button>
        </form>
    </div>
</body>

</html>