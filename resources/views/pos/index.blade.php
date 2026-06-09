<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sistem POS - Storelink</title>
    <!-- Tailwind & Alpine -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "on-secondary-fixed": "#002113",
              "secondary-fixed": "#6ffbbe",
              "secondary-container": "#6cf8bb",
              outline: "#737686",
              "on-surface": "#121c2a",
              "surface-container-low": "#eff4ff",
              background: "#f8f9ff",
              "on-secondary": "#ffffff",
              tertiary: "#784b00",
              "on-tertiary-fixed-variant": "#653e00",
              "surface-container-high": "#dee9fc",
              "tertiary-fixed": "#ffddb8",
              "surface-container-highest": "#d9e3f6",
              "on-error-container": "#93000a",
              "on-error": "#ffffff",
              "on-background": "#121c2a",
              "primary-fixed-dim": "#b4c5ff",
              "surface-dim": "#d0dbed",
              "secondary-fixed-dim": "#4edea3",
              "on-primary-fixed-variant": "#003ea8",
              "outline-variant": "#c3c6d7",
              "on-primary-fixed": "#00174b",
              "inverse-surface": "#27313f",
              "surface-container-lowest": "#ffffff",
              "on-tertiary-fixed": "#2a1700",
              "on-primary-container": "#eeefff",
              "on-surface-variant": "#434655",
              "on-secondary-container": "#00714d",
              "tertiary-fixed-dim": "#ffb95f",
              "on-primary": "#ffffff",
              "on-secondary-fixed-variant": "#005236",
              "surface-tint": "#0053db",
              error: "#ba1a1a",
              surface: "#f8f9ff",
              primary: "#004ac6",
              "surface-container": "#e6eeff",
              "surface-bright": "#f8f9ff",
              "on-tertiary": "#ffffff",
              "surface-variant": "#d9e3f6",
              "inverse-primary": "#b4c5ff",
              "tertiary-container": "#996100",
              "primary-fixed": "#dbe1ff",
              secondary: "#006c49",
              "primary-container": "#2563eb",
              "inverse-on-surface": "#eaf1ff",
              "error-container": "#ffdad6",
              "on-tertiary-container": "#ffeedd",
            },
            borderRadius: {
              DEFAULT: "0.25rem",
              lg: "0.5rem",
              xl: "0.75rem",
              full: "9999px",
            },
            spacing: {
              "cart-panel-width": "380px",
              gutter: "16px",
              unit: "4px",
              "margin-desktop": "24px",
              "margin-mobile": "16px",
              "sidebar-width": "80px",
            },
            fontFamily: {
              "headline-sm": ["Inter"],
              "body-sm": ["Inter"],
              "headline-md": ["Inter"],
              "headline-lg": ["Inter"],
              "body-md": ["Inter"],
              "label-lg": ["Inter"],
              "mono-label": ["Inter"],
              "label-md": ["Inter"],
              "body-lg": ["Inter"],
            },
            fontSize: {
              "headline-sm": ["20px", { lineHeight: "28px", fontWeight: "600" }],
              "body-sm": ["14px", { lineHeight: "20px", fontWeight: "400" }],
              "headline-md": ["24px", { lineHeight: "32px", letterSpacing: "-0.01em", fontWeight: "600" }],
              "headline-lg": ["30px", { lineHeight: "38px", letterSpacing: "-0.02em", fontWeight: "700" }],
              "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
              "label-lg": ["14px", { lineHeight: "20px", fontWeight: "600" }],
              "mono-label": ["13px", { lineHeight: "18px", letterSpacing: "0.05em", fontWeight: "500" }],
              "label-md": ["12px", { lineHeight: "16px", fontWeight: "500" }],
              "body-lg": ["18px", { lineHeight: "26px", fontWeight: "400" }],
            },
          },
        },
      };
    </script>
    <style>
      .ambient-shadow-1 { box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); }
      .ambient-shadow-2 { box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); }
      .ambient-shadow-3 { box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12); }
      .hide-scroll::-webkit-scrollbar { display: none; }
      .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
      
      @media print {
          body * {
              visibility: hidden;
          }
          #printable-receipt, #printable-receipt * {
              visibility: visible;
          }
          #printable-receipt {
              position: absolute;
              left: 0;
              top: 0;
              width: 100%;
              transform: none !important;
              box-shadow: none !important;
          }
          .no-print {
              display: none !important;
          }
      }
    </style>
</head>
<body class="bg-background text-on-background font-body-md h-screen overflow-hidden flex flex-col" x-data="posSystem()">
    <!-- Header -->
    <header class="bg-surface-container-lowest border-b border-outline-variant h-16 flex items-center justify-between px-6 shrink-0 no-print ambient-shadow-1 z-10">
        <div class="flex items-center space-x-2 font-bold text-lg tracking-wide text-primary">
            <!-- Logo SVG -->
            <svg class="w-6 h-6 text-[#2563eb]" fill="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
            <span>STORELINK</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center space-x-3 border-r pr-5 border-outline-variant">
                <img alt="User Avatar" class="h-8 w-8 rounded-full object-cover border border-outline-variant bg-surface"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuASaThGtpL0MUG5_G9b0uQ7z1jZRbonGeqvGgJzvhy0QaBok3zCv33d36FEEzkB81Ep0QmHxoyHHuhu0AORseDF7_-5SPJ2UTll04FX1oIa2cNBfLWkZ0-tXUqdGJ_oqFNmrL11bagKrnCT79FGwijKzOu7jzdJ4OVwXupsw330JOnvY32-PWD5UuyAzvvolmIrT-XCTDGbctGpSAme-wxRiZAvTduj3gwL1g4UrtJrjIJ7Bg-vqlZbD_Nmsr5GxAv8sAy8J1Xt-G0" />
                <span class="text-sm font-medium text-on-surface">Kasir: {{ auth()->user()->name ?: auth()->user()->username }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-1 text-error hover:text-error/80 transition-colors text-sm font-bold">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 flex overflow-hidden pl-margin-mobile md:pl-margin-desktop pr-margin-mobile md:pr-margin-desktop pt-margin-mobile pb-margin-mobile gap-gutter">
      
      <!-- Left Column: Product Selection -->
      <section class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Search & Filters -->
        <div class="mb-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center shrink-0">
          <div class="relative w-full sm:w-64">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
            <input x-model="searchQuery" class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-colors text-body-sm font-body-sm text-on-surface" placeholder="Cari Produk..." type="text" />
          </div>
          <div class="flex gap-2 overflow-x-auto hide-scroll pb-1 w-full sm:w-auto">
            <button @click="selectedCategory = 'Semua'" :class="selectedCategory === 'Semua' ? 'bg-surface-container-lowest border-2 border-primary-container text-on-surface ambient-shadow-1' : 'bg-surface border border-outline-variant text-on-surface-variant hover:bg-surface-container-high'" class="px-4 py-1.5 rounded-full text-label-md font-label-md whitespace-nowrap transition-colors">
              Semua
            </button>
            <button @click="selectedCategory = 'Baju'" :class="selectedCategory === 'Baju' ? 'bg-surface-container-lowest border-2 border-primary-container text-on-surface ambient-shadow-1' : 'bg-surface border border-outline-variant text-on-surface-variant hover:bg-surface-container-high'" class="px-4 py-1.5 rounded-full text-label-md font-label-md whitespace-nowrap transition-colors">
              Baju
            </button>
            <button @click="selectedCategory = 'Tas'" :class="selectedCategory === 'Tas' ? 'bg-surface-container-lowest border-2 border-primary-container text-on-surface ambient-shadow-1' : 'bg-surface border border-outline-variant text-on-surface-variant hover:bg-surface-container-high'" class="px-4 py-1.5 rounded-full text-label-md font-label-md whitespace-nowrap transition-colors">
              Tas
            </button>
            <button @click="selectedCategory = 'Aksesoris'" :class="selectedCategory === 'Aksesoris' ? 'bg-surface-container-lowest border-2 border-primary-container text-on-surface ambient-shadow-1' : 'bg-surface border border-outline-variant text-on-surface-variant hover:bg-surface-container-high'" class="px-4 py-1.5 rounded-full text-label-md font-label-md whitespace-nowrap transition-colors">
              Aksesoris
            </button>
          </div>
        </div>

        <!-- Product Grid -->
        <div class="flex-1 overflow-y-auto hide-scroll grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 pb-20 auto-rows-max">
            <template x-for="product in filteredProducts" :key="product.id">
              <article class="bg-surface-container-lowest rounded-xl p-2 flex flex-col gap-2 ambient-shadow-1 border border-surface-variant h-fit">
                <div class="aspect-square rounded-lg overflow-hidden bg-surface-container-highest">
                  <img :alt="product.name" class="w-full h-full object-cover" :src="product.image_url" />
                </div>
                <div class="flex flex-col flex-1">
                  <h3 class="text-label-md font-label-md font-bold text-on-surface line-clamp-1 mb-1" x-text="product.name"></h3>
                  <p class="text-[11px] font-semibold text-on-surface mt-auto" x-text="getPriceRange(product)"></p>
                  <p class="text-[10px] text-on-surface-variant">Total Stok: <span x-text="product.variations.reduce((sum, v) => sum + v.stock, 0)"></span></p>
                </div>
                <button @click="openVariationModal(product)" class="w-full py-1.5 bg-surface border border-primary-container text-primary-container hover:bg-surface-container-high rounded-lg text-label-md font-label-md flex items-center justify-center gap-1 transition-colors mt-1">
                  <span class="material-symbols-outlined text-[16px]">add</span>
                  Tambah
                </button>
              </article>
            </template>
        </div>
      </section>

      <!-- Right Column: Shopping Cart -->
      <aside class="hidden lg:flex w-cart-panel-width bg-surface-container-lowest rounded-2xl flex-col ambient-shadow-2 border border-surface-variant overflow-hidden shrink-0">
        <!-- Cart Header -->
        <div class="p-4 border-b border-outline-variant bg-surface-container-low">
          <h2 class="text-headline-sm font-headline-sm text-on-surface flex items-center gap-2">
            Keranjang Belanja <span class="text-on-surface-variant" x-text="'(' + cart.length + ')'"></span>
          </h2>
        </div>

        <!-- Table Header -->
        <div class="grid grid-cols-[3fr_auto_auto] gap-2 px-4 py-2 bg-surface-container text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">
          <div>Produk</div>
          <div class="text-center w-24">Jumlah</div>
          <div class="text-right w-24">Subtotal</div>
        </div>

        <!-- Cart Items List -->
        <div class="flex-1 overflow-y-auto p-4 flex flex-col gap-4">
            <template x-if="cart.length === 0">
                <p class="text-center text-on-surface-variant text-sm mt-4">Keranjang kosong</p>
            </template>
            <template x-for="(item, index) in cart" :key="item.id">
              <div class="grid grid-cols-[3fr_auto_auto] gap-2 items-center">
                <div class="text-body-sm font-body-sm text-on-surface pr-2" x-text="item.name"></div>
                <div class="flex items-center justify-center border border-outline-variant rounded-md overflow-hidden bg-surface w-24">
                  <button @click="decreaseQty(index)" class="px-2 py-1 text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-[16px]">remove</span>
                  </button>
                  <span class="flex-1 text-center text-body-sm font-body-sm" x-text="item.qty"></span>
                  <button @click="increaseQty(index)" class="px-2 py-1 text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                  </button>
                </div>
                <div class="text-body-sm font-body-sm text-on-surface font-medium text-right w-24" x-text="formatRupiah(item.price * item.qty)">
                </div>
              </div>
            </template>
        </div>

        <!-- Cart Footer / Summary -->
        <div class="p-4 bg-surface-container-low border-t border-outline-variant flex flex-col gap-3">
          <div class="flex justify-between text-body-sm font-body-sm text-on-surface-variant">
            <span>Subtotal</span>
            <span x-text="formatRupiah(subtotal)"></span>
          </div>
          <div class="flex justify-between text-body-sm font-body-sm text-on-surface-variant items-center">
            <span>Diskon (Rp)</span>
            <input type="number" x-model.number="discount" class="border border-outline-variant rounded-md w-24 text-right p-1 text-sm bg-surface">
          </div>
          <div class="flex justify-between text-headline-sm font-headline-sm text-on-surface pt-2 border-t border-outline-variant border-dashed">
            <span>Total Bayar</span>
            <span x-text="formatRupiah(totalAmount)"></span>
          </div>

          <button @click="openPaymentModal" class="w-full py-3 bg-[#10B981] text-white rounded-lg text-label-lg font-label-lg font-bold hover:bg-emerald-600 transition-colors shadow-md mt-2">
            Pilih Pembayaran
          </button>
        </div>
      </aside>
    </main>

    <!-- Modal: Pilih Varian -->
    <div x-show="showVariationModal" class="fixed inset-0 bg-on-surface/30 backdrop-blur-sm z-40 flex items-center justify-center p-4" style="display: none;">
      <div class="bg-surface-container-lowest w-full max-w-md rounded-xl ambient-shadow-3 flex flex-col relative overflow-hidden p-6" @click.away="showVariationModal = false">
        <!-- Close Button -->
        <button @click="showVariationModal = false" class="absolute top-4 right-4 text-on-surface-variant hover:text-on-surface transition-colors p-1 rounded-full hover:bg-surface-container-high">
          <span class="material-symbols-outlined">close</span>
        </button>

        <h2 class="text-headline-sm font-bold text-on-surface mb-2 border-b border-outline-variant pb-3" x-text="'Pilih Varian: ' + (selectedProductForVariation ? selectedProductForVariation.name : '')"></h2>
        
        <div class="flex flex-col gap-3 max-h-[60vh] overflow-y-auto mt-2 hide-scroll">
            <template x-for="variation in (selectedProductForVariation ? selectedProductForVariation.variations : [])" :key="variation.id">
                <div class="flex items-center justify-between p-3 border rounded-lg transition-colors cursor-pointer" 
                     :class="variation.stock > 0 ? 'border-outline-variant hover:bg-surface-container-high' : 'border-outline-variant/50 bg-surface-container opacity-50 cursor-not-allowed'"
                     @click="if(variation.stock > 0) addVariationToCart(variation)">
                    <div class="flex flex-col">
                        <span class="text-label-md font-bold text-on-surface" x-text="(variation.size ? variation.size : '') + (variation.color ? ' - ' + variation.color : '') + (!variation.size && !variation.color ? 'Default' : '')"></span>
                        <span class="text-body-sm text-on-surface-variant" x-text="formatRupiah(variation.price)"></span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-xs mb-1" :class="variation.stock > 0 ? 'text-primary' : 'text-error'" x-text="variation.stock > 0 ? 'Stok: ' + variation.stock : 'Habis'"></span>
                        <button class="px-3 py-1 rounded text-xs font-bold transition-colors"
                                :class="variation.stock > 0 ? 'bg-primary-container text-on-primary-container' : 'bg-surface-variant text-on-surface-variant'"
                                :disabled="variation.stock <= 0">Tambah</button>
                    </div>
                </div>
            </template>
        </div>
      </div>
    </div>

    <!-- Modal: Simulasi Pembayaran -->
    <div x-show="showPaymentModal" class="fixed inset-0 bg-on-surface/30 backdrop-blur-sm z-40 flex items-center justify-center p-4" style="display: none;">
      <div class="bg-surface-container-lowest w-full max-w-md rounded-xl ambient-shadow-3 flex flex-col relative overflow-hidden p-6">
        <!-- Close Button -->
        <button @click="showPaymentModal = false" class="absolute top-4 right-4 text-on-surface-variant hover:text-on-surface transition-colors p-1 rounded-full hover:bg-surface-container-high">
          <span class="material-symbols-outlined">close</span>
        </button>

        <h2 class="text-headline-sm font-bold text-on-surface mb-6 border-b border-outline-variant pb-3">Pilih Pembayaran</h2>
        
        <div class="mb-4 text-center">
            <p class="text-on-surface-variant text-body-md mb-1">Total Tagihan</p>
            <p class="text-display-sm font-bold text-primary" x-text="formatRupiah(totalAmount)"></p>
        </div>

        <!-- Payment Methods -->
        <div class="grid grid-cols-3 gap-3 mb-6">
            <button @click="paymentMethod = 'tunai'" :class="paymentMethod === 'tunai' ? 'bg-primary-container text-on-primary-container border-primary-container' : 'bg-surface border-outline-variant text-on-surface-variant hover:bg-surface-container-high'" class="p-3 border rounded-lg flex flex-col items-center justify-center gap-1 transition-colors">
                <span class="material-symbols-outlined">payments</span>
                <span class="text-label-md font-semibold">Tunai</span>
            </button>
            <button @click="paymentMethod = 'transfer'" :class="paymentMethod === 'transfer' ? 'bg-primary-container text-on-primary-container border-primary-container' : 'bg-surface border-outline-variant text-on-surface-variant hover:bg-surface-container-high'" class="p-3 border rounded-lg flex flex-col items-center justify-center gap-1 transition-colors">
                <span class="material-symbols-outlined">account_balance</span>
                <span class="text-label-md font-semibold">Transfer</span>
            </button>
            <button @click="paymentMethod = 'qris_dummy'" :class="paymentMethod === 'qris_dummy' ? 'bg-primary-container text-on-primary-container border-primary-container' : 'bg-surface border-outline-variant text-on-surface-variant hover:bg-surface-container-high'" class="p-3 border rounded-lg flex flex-col items-center justify-center gap-1 transition-colors">
                <span class="material-symbols-outlined">qr_code_scanner</span>
                <span class="text-label-md font-semibold">QRIS</span>
            </button>
        </div>

        <!-- Dynamic Payment Details -->
        <div class="bg-surface-container-low p-4 rounded-lg mb-6 min-h-[140px] flex flex-col justify-center">
            
            <template x-if="paymentMethod === ''">
                <p class="text-center text-on-surface-variant text-sm">Silakan pilih metode pembayaran di atas.</p>
            </template>

            <!-- Tunai Simulation -->
            <template x-if="paymentMethod === 'tunai'">
                <div class="flex flex-col gap-3">
                    <div>
                        <label class="text-label-sm text-on-surface-variant block mb-1">Uang Diterima (Rp)</label>
                        <input type="number" x-model.number="cashReceived" class="w-full p-2 border border-outline-variant rounded-md bg-surface text-body-lg font-bold">
                    </div>
                    <div class="flex gap-2">
                        <button @click="cashReceived = totalAmount" class="flex-1 py-1 bg-surface-container-high text-on-surface rounded border border-outline-variant text-sm hover:bg-surface-container-highest">Uang Pas</button>
                        <button @click="cashReceived = 50000" class="flex-1 py-1 bg-surface-container-high text-on-surface rounded border border-outline-variant text-sm hover:bg-surface-container-highest">50K</button>
                        <button @click="cashReceived = 100000" class="flex-1 py-1 bg-surface-container-high text-on-surface rounded border border-outline-variant text-sm hover:bg-surface-container-highest">100K</button>
                    </div>
                    <div class="flex justify-between items-center mt-2 border-t border-outline-variant pt-2">
                        <span class="text-on-surface-variant font-medium">Kembalian:</span>
                        <span class="text-lg font-bold" :class="changeAmount < 0 ? 'text-error' : 'text-primary'" x-text="formatRupiah(changeAmount)"></span>
                    </div>
                </div>
            </template>

            <!-- Transfer Simulation -->
            <template x-if="paymentMethod === 'transfer'">
                <div class="text-center">
                    <p class="text-label-md text-on-surface-variant mb-2">Instruksi Transfer</p>
                    <p class="text-body-lg font-bold text-on-surface">BCA 1234567890</p>
                    <p class="text-body-sm text-on-surface-variant">a.n. Toko Fashion Kita</p>
                    <p class="text-xs text-on-surface-variant mt-3 italic">Konfirmasi mutasi rekening sebelum menyelesaikan transaksi.</p>
                </div>
            </template>

            <!-- QRIS Simulation -->
            <template x-if="paymentMethod === 'qris_dummy'">
                <div class="flex flex-col items-center">
                    <p class="text-label-md text-on-surface-variant mb-2">Scan QRIS</p>
                    <!-- Dummy QR Image using a generic placeholder icon -->
                    <div class="w-24 h-24 bg-white p-1 border border-outline-variant flex items-center justify-center">
                        <span class="material-symbols-outlined text-[64px] text-on-surface">qr_code_2</span>
                    </div>
                    <p class="text-xs text-on-surface-variant mt-2 italic">Menunggu pembayaran pelanggan...</p>
                </div>
            </template>
        </div>

        <button @click="checkout" :class="isPaymentValid ? 'bg-[#10B981] hover:bg-emerald-600' : 'bg-surface-container-high text-on-surface-variant'" class="w-full py-3 rounded-lg text-label-lg font-bold transition-colors shadow-md flex justify-center items-center gap-2">
            <span class="material-symbols-outlined text-[20px]" x-show="isPaymentValid">check_circle</span>
            Selesaikan Transaksi
        </button>
      </div>
    </div>

    <!-- Modal: Struk Belanja Digital -->
    <div x-show="showReceipt" class="fixed inset-0 bg-on-surface/20 backdrop-blur-sm z-50 flex items-center justify-center p-4" style="display: none;">
      <div id="printable-receipt" class="bg-surface-container-lowest w-full max-w-[360px] rounded-xl ambient-shadow-3 flex flex-col relative overflow-hidden">
        <!-- Modal Close Button -->
        <button @click="closeReceipt" class="no-print absolute top-3 right-3 text-on-surface-variant hover:text-on-surface transition-colors p-1 rounded-full hover:bg-surface-container-high">
          <span class="material-symbols-outlined">close</span>
        </button>

        <!-- Receipt Header -->
        <div class="p-6 pb-4 flex flex-col items-center border-b border-outline-variant border-dashed bg-surface-container-low rounded-t-xl">
          <h2 class="text-headline-sm font-headline-sm text-on-surface mb-1">
            Struk Belanja Digital
          </h2>
          <div class="flex items-center gap-2 text-[#2563eb] font-headline-md font-bold mb-4">
            <svg class="w-6 h-6" fill="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
            STORELINK
          </div>
          <div class="w-full text-mono-label font-mono-label text-on-surface-variant text-left space-y-1">
            <p>No. Transaksi: <span x-text="transactionId"></span></p>
            <p>Tanggal: <span x-text="new Date().toLocaleString('id-ID')"></span></p>
          </div>
        </div>

        <!-- Receipt Body -->
        <div class="p-6 py-4 flex flex-col">
          <div class="grid grid-cols-[1fr_auto_auto] gap-2 text-label-md font-label-md text-on-surface font-bold pb-2 border-b border-outline-variant">
            <div>Produk</div>
            <div class="text-center w-12">Qty</div>
            <div class="text-right w-24">Subtotal</div>
          </div>
          
          <div class="py-3 flex flex-col gap-2 border-b border-outline-variant border-dashed max-h-40 overflow-y-auto">
            <template x-for="item in receiptCart" :key="item.id">
                <div class="grid grid-cols-[1fr_auto_auto] gap-2 text-body-sm font-body-sm text-on-surface items-start">
                  <div class="pr-2 leading-tight" x-text="item.name"></div>
                  <div class="text-center w-12" x-text="item.qty"></div>
                  <div class="text-right w-24" x-text="formatRupiah(item.price * item.qty)"></div>
                </div>
            </template>
          </div>

          <div class="py-3 flex flex-col gap-1 border-b border-outline-variant">
            <div class="flex justify-between text-body-sm font-body-sm text-on-surface-variant">
              <span>Subtotal:</span>
              <span x-text="formatRupiah(receiptSubtotal)"></span>
            </div>
            <div class="flex justify-between text-body-sm font-body-sm text-on-surface-variant">
              <span>Diskon:</span>
              <span x-text="formatRupiah(receiptDiscount)"></span>
            </div>
            <div class="flex justify-between text-body-md font-body-md font-bold text-on-surface pt-1">
              <span>Total Bayar:</span>
              <span x-text="formatRupiah(receiptTotal)"></span>
            </div>
          </div>

          <!-- Barcode & QR -->
          <div class="pt-6 flex justify-center items-center gap-3 no-print w-full">
             <button @click="printReceipt" class="flex-1 bg-primary-container text-on-primary-container hover:bg-primary hover:text-white px-4 py-2 rounded-lg font-bold transition-colors">Cetak Struk</button>
             <button @click="closeReceipt" class="flex-1 bg-surface-container-highest text-on-surface hover:bg-outline-variant px-4 py-2 rounded-lg font-bold transition-colors">Selesai</button>
          </div>
        </div>

        <div class="h-2 w-full absolute bottom-0 left-0 bg-[radial-gradient(circle,transparent_50%,#ffffff_50%)] bg-[length:10px_10px] bg-bottom"></div>
        <div class="h-1 w-full bg-surface-container-lowest absolute bottom-0 left-0"></div>
      </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('posSystem', () => ({
                products: {!! json_encode($products->map(function($p) {
                    return [
                        'id' => $p->id, 
                        'name' => $p->name, 
                        'category' => $p->category ?? 'Semua',
                        'image_url' => $p->image_url ? asset('storage/' . $p->image_url) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAYP8ONHAevgXtNFNNsp7yMO_PzqwRukdQi4TTEl7rA-NYCwhF8w9XJjw6TeJc-gj1ONvPAwycyhXo70hxLgFkEK1a-d7wZqeX0BKIlkJyOguaNVFSkPcr30Zgi751sAfqOoiVG2-Xs1f26YWoru7JyBJ8qTr8UOCYfHDsVGe26r2n8kOALOkTzTEhTLB786O0oIyZPDLg5XprD_B1vke4efe4IZryaW_Mhll4wL52a55Fj8So9YAVb_bblXm8ib3lleO2FvH6HWJc',
                        'variations' => $p->variations->map(function($v) {
                            return [
                                'id' => $v->id,
                                'size' => $v->size,
                                'color' => $v->color,
                                'price' => $v->price_sell,
                                'stock' => $v->stock,
                                'barcode' => $v->barcode
                            ];
                        })->values()
                    ];
                })) !!},
                cart: [],
                searchQuery: '',
                selectedCategory: 'Semua',
                discount: 0,
                paymentMethod: '',
                
                // Variation Modal State
                showVariationModal: false,
                selectedProductForVariation: null,

                // Payment Simulation State
                showPaymentModal: false,
                cashReceived: 0,

                // Receipt State
                showReceipt: false,
                transactionId: '',
                receiptCart: [],
                receiptSubtotal: 0,
                receiptDiscount: 0,
                receiptTotal: 0,

                get filteredProducts() {
                    let result = this.products;
                    if (this.selectedCategory !== 'Semua') {
                        result = result.filter(p => p.category === this.selectedCategory);
                    }
                    if (this.searchQuery !== '') {
                        result = result.filter(p => p.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || (p.barcode && p.barcode.includes(this.searchQuery)));
                    }
                    return result;
                },

                get subtotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },

                get totalAmount() {
                    let total = this.subtotal - this.discount;
                    return total < 0 ? 0 : total; 
                },

                get changeAmount() {
                    if (this.paymentMethod !== 'tunai') return 0;
                    return this.cashReceived - this.totalAmount;
                },

                get isPaymentValid() {
                    if (this.paymentMethod === '') return false;
                    if (this.paymentMethod === 'tunai' && this.changeAmount < 0) return false;
                    return true;
                },

                openPaymentModal() {
                    if (this.cart.length === 0) {
                        alert('Keranjang masih kosong!');
                        return;
                    }
                    this.cashReceived = this.totalAmount;
                    this.showPaymentModal = true;
                },

                openVariationModal(product) {
                    if (product.variations.length === 0) {
                        alert('Produk ini belum memiliki varian!');
                        return;
                    }
                    if (product.variations.length === 1) {
                        this.selectedProductForVariation = product;
                        this.addVariationToCart(product.variations[0]);
                    } else {
                        this.selectedProductForVariation = product;
                        this.showVariationModal = true;
                    }
                },

                addVariationToCart(variation) {
                    let productName = this.selectedProductForVariation.name;
                    let variationName = (variation.size ? variation.size : '') + (variation.color ? ' - ' + variation.color : '');
                    if (!variationName) variationName = 'Default';
                    
                    let fullName = productName + ' (' + variationName + ')';

                    let existing = this.cart.find(item => item.id === variation.id);
                    if (existing) {
                        if(existing.qty < variation.stock) {
                            existing.qty++;
                        } else {
                            alert('Stok maksimal tercapai untuk varian ini!');
                        }
                    } else {
                        if (variation.stock > 0) {
                            this.cart.push({ 
                                id: variation.id,
                                name: fullName,
                                price: variation.price,
                                stock: variation.stock,
                                qty: 1 
                            });
                        } else {
                            alert('Stok habis!');
                        }
                    }
                    this.showVariationModal = false;
                },

                increaseQty(index) {
                    if(this.cart[index].qty < this.cart[index].stock) {
                        this.cart[index].qty++;
                    } else {
                        alert('Stok tidak mencukupi!');
                    }
                },

                decreaseQty(index) {
                    if (this.cart[index].qty > 1) {
                        this.cart[index].qty--;
                    } else {
                        this.cart.splice(index, 1);
                    }
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
                },

                getPriceRange(product) {
                    if (!product.variations || product.variations.length === 0) return 'Rp0';
                    let prices = product.variations.map(v => parseFloat(v.price) || 0);
                    let minPrice = Math.min(...prices);
                    let maxPrice = Math.max(...prices);
                    if (minPrice === maxPrice) {
                        return this.formatRupiah(minPrice);
                    } else {
                        return this.formatRupiah(minPrice) + ' - ' + this.formatRupiah(maxPrice);
                    }
                },

                checkout() {
                    if (this.cart.length === 0) {
                        alert('Keranjang belanja kosong!');
                        return;
                    }
                    if (!this.paymentMethod) {
                        alert('Silakan pilih metode pembayaran.');
                        return;
                    }
                    if (this.paymentMethod === 'tunai' && this.changeAmount < 0) {
                        alert('Uang yang diterima kurang!');
                        return;
                    }

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
                            // Populate receipt modal data
                            this.transactionId = 'INV-' + data.transaction_id;
                            this.receiptCart = [...this.cart];
                            this.receiptSubtotal = this.subtotal;
                            this.receiptDiscount = this.discount;
                            this.receiptTotal = this.totalAmount;
                                
                            // Close payment modal, show receipt
                            this.showPaymentModal = false;
                            this.showReceipt = true;

                            // Reset Cart
                            this.cart = [];
                            this.discount = 0;
                            this.paymentMethod = '';
                        } else {
                            alert('Gagal: ' + data.message);
                        }
                    }).catch(error => alert('Terjadi kesalahan sistem.'));
                },
                
                closeReceipt() {
                    this.showReceipt = false;
                    window.location.reload(); 
                },

                printReceipt() {
                    window.print();
                }
            }))
        });
    </script>
</body>
</html>