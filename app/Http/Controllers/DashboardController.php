<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $bestSellingProduct = TransactionDetail::select('products.name', DB::raw('SUM(transaction_details.quantity) as total_sold'))
            ->join('products_variations', 'transaction_details.variation_id', '=', 'products_variations.id')
            ->join('products', 'products_variations.product_id', '=', 'products.id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->first();  
        $lowStockCount = ProductVariation::where('stock', '<=', 5)->where('stock', '>', 0)->count();
        $today = Carbon::today();
        $todaySalesAmount = Transaction::whereDate('created_at', $today)->sum('total_amount');
        $todayTransactionsCount = Transaction::whereDate('created_at', $today)->count();
        $salesChartData = [];
        $salesChartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $salesChartLabels[] = $date->locale('id')->translatedFormat('l');
            $salesChartData[] = Transaction::whereDate('created_at', $date)->sum('total_amount');
        }
        $categoryChartDataRaw = TransactionDetail::select('products.category', DB::raw('SUM(transaction_details.quantity) as total_qty'))
            ->join('products_variations', 'transaction_details.variation_id', '=', 'products_variations.id')
            ->join('products', 'products_variations.product_id', '=', 'products.id')
            ->groupBy('products.category')
            ->get();
            
        $categoryChartLabels = $categoryChartDataRaw->pluck('category')->toArray();
        $categoryChartData = $categoryChartDataRaw->pluck('total_qty')->toArray();
        $recentTransactions = Transaction::with(['user', 'details.variation.product'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        // Menggunakan with('product') untuk melakukan eager loading relasi 'product'.
        // Ini sangat penting karena kita akan memanggil properti dari product induk (seperti nama dan image_url)
        // di dalam perulangan pada file Blade. Tanpa eager loading, Laravel akan menjalankan query terpisah
        // ke tabel products untuk setiap baris variasi (N+1 query problem) yang membuat aplikasi menjadi sangat lambat.
        $lowStockProducts = ProductVariation::with('product')
            ->where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->take(5)
            ->get();
        return view('dashboard.index', compact(
            'totalProducts',
            'bestSellingProduct',
            'lowStockCount',
            'todaySalesAmount',
            'todayTransactionsCount',
            'salesChartLabels',
            'salesChartData',
            'categoryChartLabels',
            'categoryChartData',
            'recentTransactions',
            'lowStockProducts'
        ));
    }
}
