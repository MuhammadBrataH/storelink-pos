<!DOCTYPE html>
<html lang="id">
<head>
    <title>Sistem POS - Storelink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 p-6" x-data="posSystem()">

    <div class="flex gap-6">
        <div class="w-2/3 bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Daftar Produk</h2>
            <input type="text" x-model="searchQuery" placeholder="Cari barcode / nama produk..." class="w-full p-2 border rounded mb-4">
            
            <div class="grid grid-cols-3 gap-4">
                <template x-for="product in filteredProducts" :key="product.id">
                    <div class="border p-4 rounded cursor-pointer hover:bg-blue-50" @click="addToCart(product)">
                        <h3 class="font-semibold text-sm" x-text="product.name"></h3>
                        <p class="text-xs text-gray-500">Stok: <span x-text="product.stock"></span></p>
                        <p class="text-blue-600 font-bold" x-text="formatRupiah(product.price)"></p>
                    </div>
                </template>
            </div>
        </div>

        <div class="w-1/3 bg-white p-4 rounded-lg shadow flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-bold mb-4">Keranjang</h2>
                
                <template x-if="cart.length === 0">
                    <p class="text-gray-400 text-center">Keranjang kosong</p>
                </template>

                <ul>
                    <template x-for="(item, index) in cart" :key="item.id">
                        <li class="flex justify-between items-center border-b py-2">
                            <div>
                                <p class="text-sm font-semibold" x-text="item.name"></p>
                                <p class="text-xs" x-text="formatRupiah(item.price)"></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="decreaseQty(index)" class="bg-red-500 text-white px-2 rounded">-</button>
                                <span x-text="item.qty"></span>
                                <button @click="increaseQty(index)" class="bg-green-500 text-white px-2 rounded">+</button>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>

            <div class="mt-4 border-t pt-4">
                <div class="flex justify-between text-sm">
                    <span>Subtotal:</span>
                    <span x-text="formatRupiah(subtotal)"></span>
                </div>
                <div class="flex justify-between text-sm items-center mt-2">
                    <span>Diskon (Rp):</span>
                    <input type="number" x-model.number="discount" class="border w-24 text-right p-1 rounded">
                </div>
                <div class="flex justify-between font-bold text-lg mt-2 text-green-600">
                    <span>Total Bayar:</span>
                    <span x-text="formatRupiah(totalAmount)"></span>
                </div>

                <select x-model="paymentMethod" class="w-full mt-4 p-2 border rounded">
                    <option value="">Pilih Pembayaran...</option>
                    <option value="tunai">Tunai</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="qris_dummy">QRIS (Dummy)</option>
                </select>

                <button @click="checkout" class="w-full bg-blue-600 text-white py-2 rounded mt-4 font-bold hover:bg-blue-700">
                    Selesaikan Transaksi
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('posSystem', () => ({
                // Data produk dilempar dari Controller Backend
                products: @json($products->map(function($v) {
                    return [
                        'id' => $v->id, 
                        'name' => $v->product->name . ' - ' . $v->size, 
                        'price' => $v->price_sell, 
                        'stock' => $v->stock,
                        'barcode' => $v->barcode
                    ];
                })),
                cart: [],
                searchQuery: '',
                discount: 0,
                paymentMethod: '',

                get filteredProducts() {
                    if (this.searchQuery === '') return this.products;
                    return this.products.filter(p => p.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || (p.barcode && p.barcode.includes(this.searchQuery)));
                },

                get subtotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },

                get totalAmount() {
                    let total = this.subtotal - this.discount;
                    return total < 0 ? 0 : total; // Mencegah total minus [cite: 108]
                },

                addToCart(product) {
                    let existing = this.cart.find(item => item.id === product.id);
                    if (existing) {
                        if(existing.qty < product.stock) {
                            existing.qty++;
                        } else {
                            alert('Stok maksimal tercapai!');
                        }
                    } else {
                        this.cart.push({ ...product, qty: 1 });
                    }
                },

                increaseQty(index) {
                    if(this.cart[index].qty < this.cart[index].stock) {
                        this.cart[index].qty++;
                    } else {
                        alert('Stok tidak cukup!');
                    }
                },

                decreaseQty(index) {
                    if (this.cart[index].qty > 1) {
                        this.cart[index].qty--;
                    } else {
                        this.cart.splice(index, 1); // Hapus jika qty = 0
                    }
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
                },

                checkout() {
                    if(this.cart.length === 0) return alert('Keranjang kosong!');
                    if(!this.paymentMethod) return alert('Pilih metode pembayaran!');
                    if(!confirm('Konfirmasi transaksi?')) return; // Konfirmasi finalisasi [cite: 109]

                    // Format data untuk dikirim ke Backend
                    let payload = {
                        cart: this.cart.map(item => ({ variation_id: item.id, quantity: item.qty })),
                        discount: this.discount,
                        paymentMethod: this.paymentMethod,
                        _token: '{{ csrf_token() }}'
                    };

                    fetch('{{ route("pos.checkout") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            alert('Transaksi Berhasil!');
                            // Buka struk di tab baru [cite: 78, 80]
                            window.open('/pos/receipt/' + data.transaction_id, '_blank');
                            window.location.reload(); // Refresh kasir
                        } else {
                            alert('Gagal: ' + data.message);
                        }
                    }).catch(error => alert('Terjadi kesalahan sistem.'));
                }
            }))
        });
    </script>
</body>
</html>