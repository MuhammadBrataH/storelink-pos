@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto p-8" data-purpose="dashboard-content">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight mb-2">Selamat Datang di Storelink POS</h1>
        <p class="text-gray-500 mb-8">Ini adalah halaman Beranda (Home) sementara. Silakan navigasi melalui sidebar di sebelah kiri.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Dummy Card 1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Manajemen Inventaris</h3>
                <p class="text-sm text-gray-500 mb-4">Kelola stok produk, tambah item baru, dan perbarui harga dengan mudah.</p>
                <a href="{{ route('inventory.index') }}" class="mt-auto px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors">Buka Inventaris</a>
            </div>

            <!-- Dummy Card 2 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Manajemen User</h3>
                <p class="text-sm text-gray-500 mb-4">Buat akun kasir baru dan kelola hak akses admin dalam sistem.</p>
                <a href="{{ route('users.index') }}" class="mt-auto px-4 py-2 bg-purple-50 text-purple-600 rounded-lg text-sm font-medium hover:bg-purple-100 transition-colors">Buka Users</a>
            </div>

            <!-- Dummy Card 3 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Analitik</h3>
                <p class="text-sm text-gray-500 mb-4">Pantau penjualan dan laporan secara real-time (Segera Hadir).</p>
                <button disabled class="mt-auto px-4 py-2 bg-gray-50 text-gray-400 rounded-lg text-sm font-medium cursor-not-allowed">Segera Hadir</button>
            </div>
        </div>
    </div>
</main>
@endsection
