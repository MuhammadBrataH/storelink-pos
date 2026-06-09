@extends('layouts.app')

@section('content')
    @php
        $variations = old(
            'variations',
            $product->variations
                ->map(fn($variation) => [
                    'size' => $variation->size,
                    'color' => $variation->color,
                    'price_capital' => $variation->price_capital,
                    'price_sell' => $variation->price_sell,
                    'stock' => $variation->stock,
                ])
                ->toArray()
        );
    @endphp

    <!-- BEGIN: MainContent -->
    <main class="max-w-6xl mx-auto p-8">
        <!-- Page Header -->
        <h1 class="text-3xl font-semibold text-brand-text mb-6">Manajemen Inventaris: Edit Produk Fashion</h1>
        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold mb-2">Ada data yang belum sesuai:</p>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Form Container -->
        <div class="bg-white rounded-xl border border-brand-border p-6 shadow-sm">
            <h2 class="text-xl font-bold text-brand-text mb-6">Form Data Produk Baru</h2>
            <!-- Grid Layout for Form Fields -->
            <form action="{{ route('inventory.update', $product) }}" class="space-y-8" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                    <!-- Column 1: Informasi Utama -->
                    <!-- BEGIN: PrimaryInfo -->
                    <div class="space-y-4 lg:col-span-3">
                        <h3 class="font-semibold text-brand-text text-lg">Informasi Utama</h3>
                        <div>
                            <label class="block text-sm font-medium text-brand-text mb-1">ID Produk</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-brand-muted"></i>
                                </div>
                                <input class="pl-10 w-full rounded-md border-brand-border bg-gray-100 text-brand-muted cursor-not-allowed focus:ring-0 focus:border-brand-border sm:text-sm h-10" readonly="" type="text" value="{{ $product->id }}" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-text mb-1">Nama Produk</label>
                            <input class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm h-10" name="name" type="text" value="{{ old('name', $product->name) }}" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-text mb-1">Kategori</label>
                            <select class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm h-10" name="category">
                                <option value="Baju" {{ old('category', $product->category) === 'Baju' ? 'selected' : '' }}>Baju</option>
                                <option value="Celana" {{ old('category', $product->category) === 'Celana' ? 'selected' : '' }}>Celana</option>
                                <option value="Aksesoris" {{ old('category', $product->category) === 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-brand-text mb-1">Deskripsi</label>
                            <textarea class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm resize-none" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                    <!-- END: PrimaryInfo -->
                    <!-- Column 2: Upload Foto Produk -->
                    <!-- BEGIN: PhotoUpload -->
                    <div class="space-y-4 lg:col-span-2" x-data="{ imageUrl: '{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : 'https://via.placeholder.com/240x240' }}', fileChosen(event) { const file = event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => this.imageUrl = e.target.result; reader.readAsDataURL(file); } } }">
                        <h3 class="font-semibold text-brand-text text-lg">Upload Foto Produk</h3>
                        <label class="border-2 border-dashed border-brand-border rounded-xl bg-gray-100 p-4 flex justify-center items-center h-64 cursor-pointer hover:bg-gray-50 overflow-hidden relative">
                            <img alt="Foto Produk" class="max-h-full object-contain mix-blend-multiply" :src="imageUrl" />
                            <input accept="image/*" class="hidden" name="image" type="file" @change="fileChosen" />
                        </label>
                        <p class="text-sm text-brand-muted">Format: JPG, PNG. Maksimal ukuran 2MB.</p>
                    </div>
                    <!-- END: PhotoUpload -->
                </div>

                <section x-data="{ variations: {{ json_encode($variations) }} }">
                    <h3 class="font-semibold text-brand-text text-lg mb-4">Variasi Produk</h3>
                    <div class="space-y-4">
                        <template x-for="(variation, index) in variations" :key="index">
                            <div class="grid grid-cols-5 gap-4">
                                <input class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm h-10" :name="`variations[${index}][size]`" placeholder="Ukuran (S/M/L)" type="text" x-model="variation.size" />
                                <input class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm h-10" :name="`variations[${index}][color]`" placeholder="Warna" type="text" x-model="variation.color" />
                                <input class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm h-10" :name="`variations[${index}][price_capital]`" placeholder="Harga modal" type="text" x-model="variation.price_capital" />
                                <input class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm h-10" :name="`variations[${index}][price_sell]`" placeholder="Harga jual" type="text" x-model="variation.price_sell" />
                                <div class="flex items-center gap-2">
                                    <input class="w-full rounded-md border-brand-border focus:ring-brand-blue focus:border-brand-blue sm:text-sm h-10" min="0" :name="`variations[${index}][stock]`" placeholder="Stok" type="number" x-model="variation.stock" />
                                    <button class="text-red-500 hover:text-red-700 disabled:opacity-50" type="button" @click="if(variations.length > 1) variations.splice(index, 1)" :disabled="variations.length === 1"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <button class="mt-3 inline-flex items-center px-4 py-2 border border-brand-border rounded-md shadow-sm text-sm font-medium text-brand-text bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue" type="button" @click="variations.push({size: '', color: '', price_capital: '', price_sell: '', stock: ''})">
                        <i class="fa-solid fa-plus mr-2 text-brand-muted"></i> Tambah Variasi
                    </button>
                </section>

                <!-- Action Buttons -->
                <!-- BEGIN: FormActions -->
                <div class="mt-2 pt-6 border-t border-brand-border flex justify-end space-x-3">
                    <a class="px-6 py-2.5 border border-brand-border rounded-lg shadow-sm text-sm font-medium text-brand-text bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue transition-colors" href="{{ route('inventory.index') }}">
                        Batal
                    </a>
                    <button class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700" type="submit">
                        Simpan Perubahan
                    </button>
                </div>
                <!-- END: FormActions -->
            </form>
    </main>

@endsection