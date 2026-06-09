<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariation;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));

        $productQuery = Product::with('variations')
            ->withSum('variations as total_stock', 'stock')
            ->latest();

        if ($search !== '') {
            $productQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('id', $search);
            });
        }

        $summaryProducts = (clone $productQuery)->get();

        // Hitung total produk unik untuk kartu ringkasan.
        $totalProducts = $summaryProducts->count();

        // Hitung total nilai stok dari semua variasi (harga jual * stok) sesuai filter.
        $productIds = $summaryProducts->pluck('id');
        $totalValue = $productIds->isEmpty()
            ? 0
            : ProductVariation::whereNull('deleted_at')
            ->whereHas('product', fn($query) => $query->whereNull('deleted_at'))
            ->whereIn('product_id', $productIds)
            ->selectRaw('COALESCE(SUM(price_sell * stock), 0) as total')
            ->value('total');

        // Ambil produk beserta variasi dan total stoknya untuk tabel.
        $products = (clone $productQuery)->paginate(5)->withQueryString();

        // Hitung jumlah produk dengan stok rendah (ada varian yang stoknya > 0 tapi <= 5).
        $lowStockProducts = $summaryProducts->filter(function ($product) {
            return $product->variations->contains(fn ($v) => $v->stock > 0 && $v->stock <= 5);
        })->count();

        // Hitung jumlah produk yang stoknya habis (ada varian yang stoknya == 0).
        $outOfStockProducts = $summaryProducts->filter(function ($product) {
            return $product->variations->contains('stock', 0) || $product->variations->isEmpty();
        })->count();

        return view('inventory.index', compact(
            'products',
            'totalProducts',
            'totalValue',
            'lowStockProducts',
            'outOfStockProducts',
            'search'
        ));
    }

    public function create()
    {
        // Tampilkan halaman form tambah produk.
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        // Validasi input sesuai kebutuhan produk dan variasi.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'variations' => ['required', 'array', 'min:1'],
            'variations.*.size' => ['nullable', 'string', 'max:50'],
            'variations.*.color' => ['nullable', 'string', 'max:50'],
            'variations.*.price_capital' => ['required', 'integer', 'min:0'],
            'variations.*.price_sell' => ['required', 'integer', 'min:0'],
            'variations.*.stock' => ['required', 'integer', 'min:0'],
        ]);

        // Upload gambar ke Cloudinary jika user mengirim file.
        $imageUrl = null;
        if ($request->hasFile('image')) {
            // uploadApi()->upload() otomatis upload file fisik ke Cloudinary.
            // secure_url otomatis memberi URL HTTPS dari hasil upload.
            $uploaded = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'storelink_products']
            );
            $imageUrl = $uploaded['secure_url'] ?? null;

            if (! $imageUrl) {
                throw new RuntimeException('Gagal mendapatkan URL gambar dari Cloudinary.');
            }
        }

        DB::transaction(function () use ($validated, $imageUrl) {
            // Simpan data produk utama.
            $product = Product::create([
                'name' => $validated['name'],
                'category' => $validated['category'],
                'description' => $validated['description'] ?? null,
                'image_url' => $imageUrl,
            ]);

            // Loop setiap variasi lalu simpan ke database satu per satu.
            foreach ($validated['variations'] as $variation) {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'size' => $variation['size'] ?? null,
                    'color' => $variation['color'] ?? null,
                    'price_capital' => $variation['price_capital'],
                    'price_sell' => $variation['price_sell'],
                    'stock' => $variation['stock'],
                ]);
            }
        });

        return redirect()->route('inventory.index');
    }

    public function edit(Product $product)
    {
        // Tampilkan form edit dengan data produk dan variasinya.
        $product->load('variations');

        return view('inventory.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validasi input saat update.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'variations' => ['required', 'array', 'min:1'],
            'variations.*.size' => ['nullable', 'string', 'max:50'],
            'variations.*.color' => ['nullable', 'string', 'max:50'],
            'variations.*.price_capital' => ['required', 'integer', 'min:0'],
            'variations.*.price_sell' => ['required', 'integer', 'min:0'],
            'variations.*.stock' => ['required', 'integer', 'min:0'],
        ]);

        // Upload gambar baru jika ada, jika tidak pakai gambar lama.
        $imageUrl = $product->image_url;
        if ($request->hasFile('image')) {
            // uploadApi()->upload() otomatis upload file fisik ke Cloudinary.
            // secure_url otomatis memberi URL HTTPS dari hasil upload.
            $uploaded = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'storelink_products']
            );
            $imageUrl = $uploaded['secure_url'] ?? null;

            if (! $imageUrl) {
                throw new RuntimeException('Gagal mendapatkan URL gambar dari Cloudinary.');
            }
        }

        DB::transaction(function () use ($product, $validated, $imageUrl) {
            // Update data produk utama.
            $product->update([
                'name' => $validated['name'],
                'category' => $validated['category'],
                'description' => $validated['description'] ?? null,
                'image_url' => $imageUrl,
            ]);

            // Hapus variasi lama agar sinkron dengan input terbaru.
            $product->variations()->delete();

            // Loop setiap variasi baru lalu simpan ulang agar sinkron.
            foreach ($validated['variations'] as $variation) {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'size' => $variation['size'] ?? null,
                    'color' => $variation['color'] ?? null,
                    'price_capital' => $variation['price_capital'],
                    'price_sell' => $variation['price_sell'],
                    'stock' => $variation['stock'],
                ]);
            }
        });

        return redirect()->route('inventory.index');
    }

    public function destroy(Product $product)
    {
        // Hapus produk beserta variasinya.
        $product->variations()->delete();
        $product->delete();

        return redirect()->route('inventory.index');
    }
}
