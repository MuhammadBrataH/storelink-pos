@extends('layouts.app')

@section('content')
<!-- Header -->
<header class="mb-gutter">
<h1 class="text-headline-lg font-headline-lg text-on-surface">Ringkasan Statistik &amp; Analitik: Butik Pak Budi</h1>
</header>
<!-- Top Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-gutter">
<!-- Card 1: Total Produk -->
<div class="bg-surface-container-high rounded-xl p-4 flex flex-col justify-between shadow-sm shadow-black/5">
<div class="flex items-center gap-3 mb-2">
<div class="w-10 h-10 rounded-full bg-primary-fixed-dim/20 flex items-center justify-center text-primary-container">
<span class="material-symbols-outlined" data-icon="inventory_2" data-weight="fill">inventory_2</span>
</div>
<h3 class="text-label-lg font-label-lg text-on-surface-variant">Total Produk</h3>
</div>
<p class="text-headline-md font-headline-md text-on-surface">{{ $totalProducts }} units</p>
</div>
<!-- Card 2: Produk Terlaris -->
<div class="bg-tertiary-container/10 border border-tertiary-container/20 rounded-xl p-4 flex flex-col justify-between shadow-sm shadow-black/5">
<div class="flex items-center gap-3 mb-2">
<div class="w-10 h-10 rounded-full bg-tertiary-container/20 flex items-center justify-center text-tertiary-container">
<span class="material-symbols-outlined" data-icon="star" data-weight="fill">star</span>
</div>
<h3 class="text-label-lg font-label-lg text-on-surface-variant">Produk Terlaris</h3>
</div>
<p class="text-headline-sm font-headline-sm text-on-surface truncate">{{ $bestSellingProduct ? $bestSellingProduct->name : '-' }}</p>
</div>
<!-- Card 3: Stok Menipis -->
<div class="bg-error-container/20 border border-error-container/30 rounded-xl p-4 flex flex-col justify-between shadow-sm shadow-black/5">
<div class="flex items-center gap-3 mb-2">
<div class="w-10 h-10 rounded-full bg-error-container/30 flex items-center justify-center text-error">
<span class="material-symbols-outlined" data-icon="warning" data-weight="fill">warning</span>
</div>
<h3 class="text-label-lg font-label-lg text-on-surface-variant">Stok Menipis</h3>
</div>
<p class="text-headline-md font-headline-md text-error">{{ $lowStockCount }} Unit</p>
</div>
<!-- Card 4: Total Penjualan -->
<div class="bg-secondary-container/20 border border-secondary-container/30 rounded-xl p-4 flex flex-col justify-between shadow-sm shadow-black/5">
<div class="flex items-center gap-3 mb-2">
<div class="w-10 h-10 rounded-full bg-secondary-container/30 flex items-center justify-center text-on-secondary-container">
<span class="material-symbols-outlined" data-icon="receipt_long" data-weight="fill">receipt_long</span>
</div>
<h3 class="text-label-lg font-label-lg text-on-surface-variant">Total Penjualan Hari Ini</h3>
</div>
<p class="text-headline-md font-headline-md text-on-secondary-container">Rp {{ number_format($todaySalesAmount, 0, ',', '.') }}</p>
</div>
</div>
<!-- Middle Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter mb-gutter">
<!-- Chart 1: Grafik Penjualan Harian -->
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-[0_2px_4px_rgba(0,0,0,0.05)] border border-outline-variant/30">
<h2 class="text-headline-sm font-headline-sm text-on-surface mb-4">Grafik Penjualan Harian</h2>
<div class="w-full h-64 relative">
<canvas class="w-full h-full" id="salesChart"></canvas>
</div>
</div>
<!-- Chart 2: Grafik Kategori Terlaris -->
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-[0_2px_4px_rgba(0,0,0,0.05)] border border-outline-variant/30">
<h2 class="text-headline-sm font-headline-sm text-on-surface mb-4">Grafik Kategori Terlaris</h2>
<div class="w-full h-64 relative">
<canvas class="w-full h-full" id="categoryChart"></canvas>
</div>
</div>
</div>
<!-- Bottom Grid -->
<div class="grid grid-cols-1 lg:grid-cols-[65%_calc(35%-16px)] gap-gutter">
<!-- Left: Transaksi Terakhir -->
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-[0_2px_4px_rgba(0,0,0,0.05)] border border-outline-variant/30 overflow-x-auto">
<div class="flex justify-between items-center mb-4">
<h2 class="text-headline-sm font-headline-sm text-on-surface">Transaksi Terakhir (5 Transaksi Terbaru)</h2>
</div>
<table class="w-full text-left border-collapse">
<thead>
<tr class="border-b border-outline-variant/50">
<th class="py-2 px-3 text-label-md font-label-md text-on-surface-variant">No</th>
<th class="py-2 px-3 text-label-md font-label-md text-on-surface-variant">Waktu</th>
<th class="py-2 px-3 text-label-md font-label-md text-on-surface-variant">Produk</th>
<th class="py-2 px-3 text-label-md font-label-md text-on-surface-variant text-center">Jumlah</th>
<th class="py-2 px-3 text-label-md font-label-md text-on-surface-variant text-right">Total</th>
<th class="py-2 px-3 text-label-md font-label-md text-on-surface-variant">Kasir</th>
<th class="py-2 px-3 text-label-md font-label-md text-on-surface-variant text-center">Aksi</th>
</tr>
</thead>
@forelse($recentTransactions as $index => $transaction)
<tbody class="text-body-sm font-body-sm" x-data="{ open: false }">
<tr class="border-b border-outline-variant/20 hover:bg-surface-container/50 transition-colors cursor-pointer" @click="open = !open">
<td class="py-3 px-3 text-on-surface-variant">{{ $index + 1 }}</td>
<td class="py-3 px-3 text-on-surface-variant">{{ $transaction->created_at->format('h:i A') }}</td>
<td class="py-3 px-3">
<div class="flex items-center gap-3">
@php
    $firstDetail = $transaction->details->first();
    $productImage = $firstDetail && $firstDetail->variation->product->image_url ? $firstDetail->variation->product->image_url : 'https://placehold.co/40x40?text=IMG';
    $productName = $firstDetail ? $firstDetail->variation->product->name : 'Unknown Product';
    $totalQty = $transaction->details->sum('quantity');
@endphp
<div class="w-10 h-10 rounded bg-surface-variant flex-shrink-0 bg-cover bg-center" style="background-image: url('{{ $productImage }}');"></div>
<span class="text-on-surface font-medium">{{ $productName }}</span>
</div>
</td>
<td class="py-3 px-3 text-center text-on-surface">{{ $totalQty }}</td>
<td class="py-3 px-3 text-right text-on-surface font-medium">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
<td class="py-3 px-3 text-on-surface-variant">{{ $transaction->user ? $transaction->user->username : 'Kasir' }}</td>
<td class="py-3 px-3 text-center">
    <button class="py-1.5 px-3 rounded-lg text-primary hover:bg-primary-container/30 transition-colors focus:outline-none font-medium flex items-center justify-center gap-1 mx-auto text-sm">
        <span x-text="open ? 'Tutup' : 'Detail'"></span>
        <span class="material-symbols-outlined text-[18px] transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
    </button>
</td>
</tr>
<tr x-show="open" x-transition class="bg-gray-50" style="display: none;">
    <td colspan="7" class="p-4 border-b border-outline-variant/20">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-outline-variant/30">
            <h4 class="text-label-lg font-bold mb-3 text-on-surface">Detail Transaksi #{{ $transaction->invoice_code ?? $transaction->id }}</h4>
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-outline-variant/30 text-on-surface-variant">
                        <th class="pb-2 font-medium">Item & Variasi</th>
                        <th class="pb-2 font-medium text-right">Harga Satuan</th>
                        <th class="pb-2 font-medium text-center">Qty</th>
                        <th class="pb-2 font-medium text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $detail)
                    <tr class="border-b border-outline-variant/10 last:border-0">
                        <td class="py-2">
                            <span class="font-medium text-on-surface">{{ $detail->variation->product->name }}</span>
                            <div class="text-xs text-on-surface-variant mt-0.5 flex gap-2">
                                @if($detail->variation->size) <span class="bg-surface-variant px-1.5 py-0.5 rounded">Size: {{ $detail->variation->size }}</span> @endif
                                @if($detail->variation->color) <span class="bg-surface-variant px-1.5 py-0.5 rounded">Warna: {{ $detail->variation->color }}</span> @endif
                            </div>
                        </td>
                        <td class="py-2 text-right text-on-surface">Rp {{ number_format($detail->price_sell, 0, ',', '.') }}</td>
                        <td class="py-2 text-center text-on-surface">{{ $detail->quantity }}</td>
                        <td class="py-2 text-right text-on-surface font-medium">Rp {{ number_format($detail->price_sell * $detail->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </td>
</tr>
</tbody>
@empty
<tbody class="text-body-sm font-body-sm">
<tr>
    <td colspan="7" class="py-4 px-3 text-center text-on-surface-variant italic">Belum ada transaksi terakhir</td>
</tr>
</tbody>
@endforelse
</table>
</div>
<!-- Right: Notifikasi Stok Menipis -->
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-[0_2px_4px_rgba(0,0,0,0.05)] border border-outline-variant/30 flex flex-col">
<h2 class="text-headline-sm font-headline-sm text-on-surface mb-4">Notifikasi Stok Menipis</h2>
<div class="flex-grow flex flex-col gap-3 overflow-y-auto mb-4">
@forelse($lowStockProducts as $item)
<div class="flex items-center justify-between p-3 rounded-lg bg-surface hover:bg-surface-container-high transition-colors border border-outline-variant/20">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded bg-surface-variant bg-cover bg-center" style="background-image: url('{{ $item->product->image_url ?? 'https://placehold.co/48x48?text=IMG' }}');"></div>
<div>
<h4 class="text-label-lg font-label-lg text-on-surface">{{ $item->product->name }} - {{ $item->size }} / {{ $item->color }}</h4>
<p class="text-body-sm font-body-sm text-red-500 flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">warning</span> Tersisa {{ $item->stock }} unit
                             </p>
</div>
</div>
</div>
@empty
<p class="text-body-sm text-on-surface-variant text-center py-4">Semua stok aman.</p>
@endforelse
</div>
<a href="{{ route('inventory.index') }}" class="w-full py-2 px-4 bg-primary-container text-on-primary text-label-lg font-label-lg rounded-lg hover:bg-primary transition-colors flex items-center justify-center gap-2">
<span class="material-symbols-outlined" data-icon="inventory" data-weight="fill">inventory</span>
                 Lihat Inventaris
             </a>
</div>
</div>
<!-- Chart Scripts -->
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set default font to Inter
            Chart.defaults.font.family = 'Inter';
            Chart.defaults.color = '#434655'; // on-surface-variant

            // Sales Chart (Line Chart)
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($salesChartLabels) !!},
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: {!! json_encode($salesChartData) !!},
                        backgroundColor: 'rgba(37, 99, 235, 0.1)', // primary-container with opacity
                        borderColor: '#2563eb', // primary-container
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#2563eb'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#eaf1ff', // inverse-on-surface (light grid lines)
                                drawBorder: false,
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000) + 'k';
                                }
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });

            // Category Chart (Bar Chart)
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($categoryChartLabels) !!},
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: {!! json_encode($categoryChartData) !!},
                        backgroundColor: [
                            '#004ac6', // primary
                            '#4edea3', // secondary-fixed-dim
                            '#ffb95f', // tertiary-fixed-dim
                            '#dbe1ff',  // primary-fixed
                            '#006c49',
                            '#2563eb'
                        ],
                        borderRadius: 4,
                        barThickness: 24
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#eaf1ff', // inverse-on-surface
                                drawBorder: false,
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection