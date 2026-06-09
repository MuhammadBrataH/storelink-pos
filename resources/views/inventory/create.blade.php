@extends('layouts.app')

@section('content')
    @php
        $variations = old('variations', [
            ['size' => '', 'color' => '', 'price_capital' => '', 'price_sell' => '', 'stock' => ''],
        ]);
    @endphp

    <!-- BEGIN: MainContent -->
    <main class="max-w-6xl mx-auto p-6">
        <!-- Page Header -->
        <h1 class="text-2xl font-semibold mb-6 text-gray-800">Manajemen Inventaris: Tambah Produk Fashion Baru</h1>
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
        <!-- BEGIN: FormContainer -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6" data-purpose="form-container">
            <h2 class="text-lg font-semibold mb-6 text-gray-800">Form Data Produk Baru</h2>
            <!-- Form Grid -->
            <form action="{{ route('inventory.store') }}" class="space-y-8" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                    <!-- BEGIN: Informasi Utama -->
                    <section class="lg:col-span-3" data-purpose="informasi-utama">
                        <h3 class="font-medium text-gray-800 mb-4">Informasi Utama</h3>
                        <div class="space-y-4">
                            <!-- ID Produk -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-1" for="id-produk">ID Produk</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <input
                                        class="bg-gray-100 border border-gray-200 text-gray-600 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-8 p-2 cursor-not-allowed"
                                        disabled="" id="id-produk" type="text" value="AUTO" />
                                </div>
                            </div>
                            <!-- Nama Produk -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-1" for="nama-produk">Nama Produk</label>
                                <input
                                    class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                    id="nama-produk" name="name" type="text" value="{{ old('name') }}" />
                            </div>
                            <!-- Kategori -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-1" for="kategori">Kategori</label>
                                <select
                                    class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                    id="kategori" name="category">
                                    <option value="Baju" {{ old('category') === 'Baju' ? 'selected' : '' }}>Baju</option>
                                    <option value="Celana" {{ old('category') === 'Celana' ? 'selected' : '' }}>Celana
                                    </option>
                                    <option value="Aksesoris" {{ old('category') === 'Aksesoris' ? 'selected' : '' }}>
                                        Aksesoris</option>
                                </select>
                            </div>
                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm text-gray-600 mb-1" for="deskripsi">Deskripsi</label>
                                <textarea
                                    class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2 resize-none"
                                    id="deskripsi" name="description" placeholder="Masukkan deskripsi produk di sini"
                                    rows="5">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </section>
                    <!-- END: Informasi Utama -->
                    <!-- BEGIN: Upload Foto Produk -->
                    <section class="lg:col-span-2" data-purpose="upload-foto"
                        x-data="{ imageUrl: null, fileChosen(event) { const file = event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => this.imageUrl = e.target.result; reader.readAsDataURL(file); } } }">
                        <h3 class="font-medium text-gray-800 mb-4">Upload Foto Produk</h3>
                        <div class="flex flex-col gap-4">
                            <!-- Main Upload Area -->
                            <label
                                class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-100 h-48 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 overflow-hidden relative">
                                <img alt="Preview" class="max-h-full object-contain" x-show="imageUrl" :src="imageUrl" style="display: none;" />
                                <div class="flex flex-col items-center" x-show="!imageUrl">
                                    <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="text-sm text-gray-500">Upload Image</span>
                                </div>
                                <input accept="image/*" class="hidden" name="image" type="file" @change="fileChosen" />
                            </label>
                            <p class="text-sm text-brand-muted">Format: JPG, PNG. Maksimal ukuran 2MB.</p>
                        </div>
                    </section>
                    <!-- END: Upload Foto Produk -->
                </div>

                <!-- Variasi Produk -->
                <section x-data="{ variations: {{ json_encode($variations) }} }">
                    <h4 class="font-medium text-gray-800 mb-4">Variasi Produk</h4>
                    <div class="space-y-4">
                        <template x-for="(variation, index) in variations" :key="index">
                            <div class="grid grid-cols-5 gap-4">
                                <input
                                    class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                    :name="`variations[${index}][size]`" placeholder="Ukuran (S/M/L/XL/XXL)" type="text"
                                    x-model="variation.size" />
                                <input
                                    class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                    :name="`variations[${index}][color]`" placeholder="Warna" type="text"
                                    x-model="variation.color" />
                                <input
                                    class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                    :name="`variations[${index}][price_capital]`" placeholder="Harga modal" type="text"
                                    x-model="variation.price_capital" />
                                <input
                                    class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                    :name="`variations[${index}][price_sell]`" placeholder="Harga jual" type="text"
                                    x-model="variation.price_sell" />
                                <div class="flex items-center gap-2">
                                    <input
                                        class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                        min="0" :name="`variations[${index}][stock]`" placeholder="Stok" type="number"
                                        x-model="variation.stock" />
                                    <button class="text-red-500 hover:text-red-700 disabled:opacity-50" type="button"
                                        @click="if(variations.length > 1) variations.splice(index, 1)"
                                        :disabled="variations.length === 1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <button
                        class="mt-4 px-4 py-2 border border-gray-300 text-blue-600 text-sm font-medium rounded-md bg-white hover:bg-gray-50 flex items-center"
                        type="button"
                        @click="variations.push({size: '', color: '', price_capital: '', price_sell: '', stock: ''})">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg> Tambah Variasi
                    </button>
                </section>

                <!-- Action Buttons Footer -->
                <div class="flex justify-end gap-3">
                    <button class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700"
                        type="submit">Submit / Produk</button>
                    <a class="px-6 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md bg-white hover:bg-gray-50"
                        href="{{ route('inventory.index') }}">Batal</a>
                </div>
            </form>
        </div>
        <!-- END: FormContainer -->
    </main>
    <!-- END: MainContent -->
@endsection