<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::with('variations')->get();
        return view('pos.index', compact('products'));
    }

    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();

            $subtotal = 0;
            $transaction = Transaction::create([
                'invoice_code' => 'INV-' . time() . '-' . rand(100, 999),
                'user_id' => Auth::id(),
                'discount' => $request->discount,
                'payment_method' => $request->paymentMethod,
                'subtotal' => 0,
                'total_amount' => 0
            ]);

            foreach ($request->cart as $item) {
                $variation = ProductVariation::lockForUpdate()->findOrFail($item['variation_id']);
                
                if ($variation->stock < $item['quantity']) {
                    throw new \Exception('Stok tidak mencukupi untuk ' . ($variation->product->name ?? 'Produk'));
                }

                $variation->stock -= $item['quantity'];
                $variation->save();

                $itemTotal = $variation->price_sell * $item['quantity'];
                $subtotal += $itemTotal;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'variation_id' => $variation->id,
                    'quantity' => $item['quantity'],
                    'price_capital' => $variation->price_capital,
                    'price_sell' => $variation->price_sell
                ]);
            }

            $transaction->subtotal = $subtotal;
            $transaction->total_amount = $subtotal - $request->discount;
            $transaction->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'transaction_id' => $transaction->id,
                'invoice_code' => $transaction->invoice_code,
                'message' => 'Transaksi Berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function receipt($id)
    {
        return "Halaman Cetak Struk untuk ID: " . $id;
    }
}