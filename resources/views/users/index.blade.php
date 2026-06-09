@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8" data-purpose="dashboard-content">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen User</h1>
        <div class="flex space-x-3">
            <a class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition-colors" href="{{ route('users.create') }}">
                <span class="mr-2 text-lg leading-none">+</span> Tambah User Baru
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-gray-700 text-sm font-semibold border-b border-gray-200">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Nama & Username</th>
                        <th class="py-3 px-4">Role</th>
                        <th class="py-3 px-4">Tanggal Dibuat</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4">{{ $user->id }}</td>
                            <td class="py-4 px-4 font-medium text-gray-800">
                                {{ $user->name }}
                                <div class="text-xs text-gray-500 font-normal">{{ $user->username }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700 border border-purple-200' : 'bg-blue-100 text-blue-700 border border-blue-200' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center space-x-3 text-gray-400">
                                    <a class="hover:text-blue-600 flex items-center space-x-1" href="{{ route('users.edit', $user) }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                            <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </a>
                                    @if (auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="hover:text-red-600 flex items-center space-x-1" type="submit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-6 px-4 text-center text-gray-500" colspan="5">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 flex items-center justify-center">
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>
</main>
@endsection
