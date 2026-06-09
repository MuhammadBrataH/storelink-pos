<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('variations')->get();
        return view('admin.inventory.index', compact('products'));
    }

    public function create()
    {
        return view('admin.inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'image' => 'nullable|image',
            'variations' => 'required|array'
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $response = Http::asForm()->post('https://api.imgbb.com/1/upload', [
                'key' => env('IMGBB_API_KEY'),
                'image' => base64_encode(file_get_contents($image->path()))
            ]);
            if ($response->successful()) {
                $imageUrl = $response->json('data.url');
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'image_url' => $imageUrl
        ]);

        foreach($request->variations as $var) {
            ProductVariation::create([
                'product_id' => $product->id,
                'size' => $var['size'],
                'color' => $var['color'],
                'price_capital' => $var['price_capital'],
                'price_sell' => $var['price_sell'],
                'stock' => $var['stock'],
                'barcode' => $var['barcode'] ?? null
            ]);
        }

        return redirect()->route('admin.inventory.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.inventory.index')->with('success', 'Produk dihapus');
    }
}
