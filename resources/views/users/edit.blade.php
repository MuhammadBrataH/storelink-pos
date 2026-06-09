@extends('layouts.app')

@section('content')
<main class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">Edit Akun: {{ $user->username }}</h1>

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="font-semibold mb-2">Ada data yang belum sesuai:</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm text-gray-600 mb-1" for="name">Nama Lengkap</label>
                <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required />
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1" for="username">Username</label>
                <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required />
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1" for="password">Password (Biarkan kosong jika tidak diubah)</label>
                <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="password" name="password" type="password" minlength="8" />
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter. Jangan diisi jika tidak ingin mengganti password.</p>
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1" for="role">Role (Hak Akses)</label>
                <select class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="role" name="role" required>
                    <option value="kasir" {{ old('role', $user->role) === 'kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a class="px-6 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md bg-white hover:bg-gray-50" href="{{ route('users.index') }}">Batal</a>
                <button class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700" type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>
@endsection
