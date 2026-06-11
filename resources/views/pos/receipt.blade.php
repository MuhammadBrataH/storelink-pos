<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi {{ $transaction->invoice_code }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 300px; margin: 0 auto; font-size: 12px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .border-bottom { border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px; }
        .w-full { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
    </style>
</head>
<body onload="window.print()"> <div class="text-center border-bottom">
        <h2>STORELINK</h2>
        <p>Struk Belanja Digital</p>
    </div>

    <div class="border-bottom">
        <p>No: {{ $transaction->invoice_code }}</p>
        <p>Tgl: {{ $transaction->created_at->format('d M Y H:i') }} WIB</p>
        <p>Metode: {{ strtoupper($transaction->payment_method ?? 'TUNAI') }}</p>
    </div>

    <table class="border-bottom">
        @foreach($transaction->details as $item)
        <tr>
            <td colspan="3">{{ $item->variation->product->name }} ({{ $item->variation->size }})</td>
        </tr>
        <tr>
            <td>{{ $item->quantity }}x</td>
            <td>Rp {{ number_format($item->price_sell, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($item->quantity * $item->price_sell, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <table class="border-bottom">
        <tr>
            <td>Subtotal</td>
            <td class="text-right">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td class="text-right">Rp {{ number_format($transaction->discount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td><strong>Total</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <div class="text-center">
        <p>Terima Kasih!</p>
    </div>

</body>
</html>