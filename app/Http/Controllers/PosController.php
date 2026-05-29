<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariation; // Model disiapkan Developer A
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    // Menampilkan halaman POS
    public function index()
    {
        // Mengambil produk yang stoknya tidak kosong
        $products = ProductVariation::with('product')->where('stock', '>', 0)->get();
        return view('pos.index', compact('products'));
    }

    // Memproses transaksi
    public function checkout(Request $request)
    {
        $request->validate([
            'cart' => 'required|array',
            'cart.*.variation_id' => 'required|exists:product_variations,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'discount' => 'numeric|min:0',
            'payment_method' => 'required|in:tunai,qris_dummy,transfer' // Simulasi pembayaran [cite: 71, 74]
        ]);

        try {
            DB::beginTransaction();

            $subtotal = 0;
            $discount = $request->discount ?? 0;

            // 1. Buat Header Transaksi [cite: 129, 131]
            $transaction = Transaction::create([
                'invoice_code' => 'INV-' . strtoupper(uniqid()),
                'user_id' => auth()->id(),
                'subtotal' => 0, // diupdate nanti
                'discount' => $discount,
                'total_amount' => 0, // diupdate nanti
                'payment_method' => $request->payment_method
            ]);

            // 2. Loop Keranjang & Validasi Stok [cite: 133, 135]
            foreach ($request->cart as $item) {
                $variation = ProductVariation::lockForUpdate()->find($item['variation_id']);

                // Validasi: Stok tidak boleh minus [cite: 107]
                if ($variation->stock < $item['quantity']) {
                    throw new \Exception("Stok produk tidak mencukupi!");
                }

                $itemTotal = $variation->price_sell * $item['quantity'];
                $subtotal += $itemTotal;

                // Catat Detail Transaksi
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'variation_id' => $variation->id,
                    'quantity' => $item['quantity'],
                    'price_capital' => $variation->price_capital,
                    'price_sell' => $variation->price_sell,
                ]);

                // 3. Automasi Stok: Kurangi stok [cite: 76, 77]
                $variation->decrement('stock', $item['quantity']);
            }

            // Update Total di Header Transaksi [cite: 69]
            $transaction->update([
                'subtotal' => $subtotal,
                'total_amount' => $subtotal - $discount
            ]);

            DB::commit();

            return response()->json([
                'success' => true, 
                'transaction_id' => $transaction->id,
                'message' => 'Transaksi Berhasil'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    // Halaman Print Struk [cite: 78, 80]
    public function receipt($id)
    {
        $transaction = Transaction::with('details.variation.product')->findOrFail($id);
        return view('pos.receipt', compact('transaction'));
    }
}