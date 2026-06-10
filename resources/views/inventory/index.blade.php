@extends('layouts.app')

@section('content')
    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">

        <!-- BEGIN: MainContentArea -->
        <main class="flex-1 overflow-y-auto p-8" data-purpose="dashboard-content">
            <!-- Top Title and Actions -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Manajemen Inventaris: Koleksi Fashion</h1>
                <div class="flex space-x-3">
                    <a class="bg-[#5C8AE6] hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition-colors"
                        href="{{ route('inventory.create') }}">
                        <span class="mr-2 text-lg leading-none">+</span> Tambah Produk Baru
                    </a>
                    <!-- <button class="bg-[#7AA6F4] hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        Impor/Ekspor
                    </button> -->
                </div>
            </div>
            <!-- Summary Cards -->
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center text-center shadow-sm">
                    <span class="text-gray-500 text-sm mb-1">Total Produk:</span>
                    <span class="font-bold text-gray-800 text-lg whitespace-nowrap">{{ $totalProducts }}</span>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center text-center shadow-sm">
                    <span class="text-gray-500 text-sm mb-1">Total Nilai:</span>
                    <span class="font-bold text-gray-800 text-lg whitespace-nowrap">Rp {{ number_format($totalValue, 0, ',', '.') }}</span>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center text-center shadow-sm">
                    <span class="text-gray-500 text-sm mb-1">Produk Stok Rendah:</span>
                    <span class="font-bold text-gray-800 text-lg whitespace-nowrap">{{ $lowStockProducts }}</span>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center text-center shadow-sm">
                    <span class="text-gray-500 text-sm mb-1">Produk Habis:</span>
                    <span class="font-bold text-gray-800 text-lg whitespace-nowrap">{{ $outOfStockProducts }}</span>
                </div>
            </div>
            <!-- Data Table Section -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden"
                data-purpose="inventory-table">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#EAF0F6] text-gray-700 text-sm font-semibold border-b border-gray-200">
                                <th class="py-3 px-4">ID Produk</th>
                                <th class="py-3 px-4">Nama Produk</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4 whitespace-nowrap">Harga Jual (Rp)</th>
                                <th class="py-3 px-4 text-center whitespace-nowrap">Stok Saat Ini</th>
                                <th class="py-3 px-4 whitespace-nowrap">Status Stok</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-100">
                            @forelse ($products as $product)
                                @php
                                    $totalStock = $product->variations->sum('stock');
                                    $priceSell = $product->variations->first()?->price_sell;
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">{{ $product->id }}</td>
                                    <td class="py-4 px-4 flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-gray-100 rounded-md border flex items-center justify-center overflow-hidden">
                                            @if($product->image_url)
                                                <img alt="{{ $product->name }}" class="w-8 h-8 object-cover rounded mix-blend-multiply"
                                                    src="{{ str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" />
                                            @else
                                                @php $cat = strtolower($product->category); @endphp
                                                @if($cat == 'baju')
                                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l4-1 5-2 5 2 4 1v3l-3 1v10H6V12L3 11V8z" /></svg>
                                                @elseif($cat == 'celana')
                                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 3h12v3l-3 16H9L6 6V3z M12 6v16" /></svg>
                                                @elseif($cat == 'aksesoris')
                                                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                @else
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                                @endif
                                            @endif
                                        </div>
                                        <span class="font-medium text-gray-800 truncate max-w-[200px]"
                                            title="{{ $product->name }}">{{ $product->name }}</span>
                                    </td>
                                    <td class="py-4 px-4 truncate max-w-[200px]" title="{{ $product->category }}">
                                        {{ $product->category }}</td>
                                    <td class="py-4 px-4">{{ $priceSell ? number_format($priceSell, 0, ',', '.') : '-' }}</td>
                                    <td class="py-4 px-4">
                                        <div class="flex justify-center mb-2">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold 'bg-gray-100 text-gray-700 border border-gray-200' }}">
                                                {{ $totalStock }}
                                            </span>
                                        </div>
                                        <div class="flex flex-wrap justify-center gap-1">
                                            @foreach ($product->variations as $variation)
                                                @php
                                                    $bgClass = 'bg-green-100 text-green-700 border-green-200';
                                                    if ($variation->stock == 0) {
                                                        $bgClass = 'bg-red-100 text-red-700 border-red-200 font-bold';
                                                    } elseif ($variation->stock <= 5 && $variation->stock > 0) {
                                                        $bgClass = 'bg-orange-100 text-orange-700 border-orange-200 font-bold';
                                                    }
                                                @endphp
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs border {{ $bgClass }}">
                                                    {{ $variation->size ?: '-' }}: {{ $variation->stock }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        {!! $product->stock_status !!}
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center space-x-3 text-gray-400">
                                            <a class="hover:text-blue-600 flex items-center space-x-1"
                                                href="{{ route('inventory.edit', $product) }}"><svg class="w-4 h-4" fill="none"
                                                    stroke="currentColor" viewbox="0 0 24 24">
                                                    <path
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                                </svg> <span>Edit</span></a>
                                            <form action="{{ route('inventory.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="hover:text-red-600 flex items-center space-x-1"
                                                    type="submit"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewbox="0 0 24 24">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        </path>
                                                    </svg> <span>Hapus</span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="py-6 px-4 text-center text-gray-500" colspan="8">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 flex items-center justify-center"
                    data-purpose="table-pagination">
                    {{ $products->onEachSide(1)->links() }}
                </div>
            </div>
        </main>
        <!-- END: MainContentArea -->
    </div>
@endsection