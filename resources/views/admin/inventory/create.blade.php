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
                                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                                </div>
                                <input class="bg-gray-100 border border-gray-200 text-gray-600 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full pl-8 p-2 cursor-not-allowed" disabled="" id="id-produk" type="text" value="AUTO" />
                            </div>
                        </div>
                        <!-- Nama Produk -->
                        <div>
                            <label class="block text-sm text-gray-600 mb-1" for="nama-produk">Nama Produk</label>
                            <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" id="nama-produk" name="name" type="text" value="{{ old('name') }}" />
                        </div>
                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm text-gray-600 mb-1" for="kategori">Kategori</label>
                            <select class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" id="kategori" name="category">
                                <option value="Baju" {{ old('category') === 'Baju' ? 'selected' : '' }}>Baju</option>
                                <option value="Celana" {{ old('category') === 'Celana' ? 'selected' : '' }}>Celana</option>
                                <option value="Aksesoris" {{ old('category') === 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>
                            </select>
                        </div>
                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm text-gray-600 mb-1" for="deskripsi">Deskripsi</label>
                            <textarea class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2 resize-none" id="deskripsi" name="description" placeholder="Masukkan deskripsi produk di sini" rows="5">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </section>
                <!-- END: Informasi Utama -->
                <!-- BEGIN: Upload Foto Produk -->
                <section class="lg:col-span-2" data-purpose="upload-foto">
                    <h3 class="font-medium text-gray-800 mb-4">Upload Foto Produk</h3>
                    <div class="flex flex-col gap-4">
                        <!-- Main Upload Area -->
                        <label class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-100 h-48 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50">
                            <img alt="Preview" class="hidden max-h-full object-contain" id="image-preview" />
                            <div class="flex flex-col items-center" id="image-placeholder">
                                <i class="fas fa-camera text-gray-400 text-3xl mb-2"></i>
                                <span class="text-sm text-gray-500">Upload Image</span>
                            </div>
                            <input accept="image/*" class="hidden" id="image-input" name="image" type="file" />
                        </label>
                        <p class="text-sm text-brand-muted">Format: JPG, PNG. Maksimal ukuran 2MB.</p>
                    </div>
                </section>
                <!-- END: Upload Foto Produk -->
            </div>

            <!-- Variasi Produk -->
            <section>
                <h4 class="font-medium text-gray-800 mb-4">Variasi Produk</h4>
                <div class="space-y-4" id="variation-rows">
                    @foreach ($variations as $index => $variation)
                    <div class="grid grid-cols-5 gap-4">
                        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[{{ $index }}][size]" placeholder="Ukuran (S/M/L/XL/XXL)" type="text" value="{{ $variation['size'] ?? '' }}" />
                        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[{{ $index }}][color]" placeholder="Warna" type="text" value="{{ $variation['color'] ?? '' }}" />
                        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[{{ $index }}][price_capital]" placeholder="Harga modal" type="text" value="{{ $variation['price_capital'] ?? '' }}" />
                        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[{{ $index }}][price_sell]" placeholder="Harga jual" type="text" value="{{ $variation['price_sell'] ?? '' }}" />
                        <div class="flex items-center gap-2">
                            <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" min="0" name="variations[{{ $index }}][stock]" placeholder="Stok" type="number" value="{{ $variation['stock'] ?? '' }}" />
                            <button class="text-red-500 hover:text-red-700" type="button" data-remove-variation><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="mt-4 px-4 py-2 border border-gray-300 text-blue-600 text-sm font-medium rounded-md bg-white hover:bg-gray-50 flex items-center" id="add-variation" type="button">
                    <i class="fas fa-plus mr-2 text-xs"></i> Tambah Variasi
                </button>
            </section>

            <!-- Action Buttons Footer -->
            <div class="flex justify-end gap-3">
                <button class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700" type="submit">Submit / Produk</button>
                <a class="px-6 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md bg-white hover:bg-gray-50" href="{{ route('inventory.index') }}">Batal</a>
            </div>
        </form>
    </div>
    <!-- END: FormContainer -->
</main>
<!-- END: MainContent -->

<template id="variation-row-template">
    <div class="grid grid-cols-5 gap-4">
        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[__INDEX__][size]" placeholder="Ukuran (S/M/L/XL/XXL)" type="text" />
        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[__INDEX__][color]" placeholder="Warna" type="text" />
        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[__INDEX__][price_capital]" placeholder="Harga modal" type="text" />
        <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" name="variations[__INDEX__][price_sell]" placeholder="Harga jual" type="text" />
        <div class="flex items-center gap-2">
            <input class="border border-gray-300 text-gray-800 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2" min="0" name="variations[__INDEX__][stock]" placeholder="Stok" type="number" />
            <button class="text-red-500 hover:text-red-700" type="button" data-remove-variation><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
</template>
@endsection

@push('scripts')
<script>
    (function() {
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const imagePlaceholder = document.getElementById('image-placeholder');
        const rowsContainer = document.getElementById('variation-rows');
        const addButton = document.getElementById('add-variation');
        const template = document.getElementById('variation-row-template');

        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', () => {
                const file = imageInput.files && imageInput.files[0];
                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = (event) => {
                    imagePreview.src = event.target?.result;
                    imagePreview.classList.remove('hidden');
                    imagePlaceholder?.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            });
        }

        if (!rowsContainer || !addButton || !template) {
            return;
        }

        const getNextIndex = () => rowsContainer.querySelectorAll('div.grid').length;

        const bindRemoveButtons = () => {
            rowsContainer.querySelectorAll('[data-remove-variation]').forEach((button) => {
                button.onclick = () => {
                    const row = button.closest('div.grid');
                    if (row && rowsContainer.querySelectorAll('div.grid').length > 1) {
                        row.remove();
                    }
                };
            });
        };

        addButton.addEventListener('click', () => {
            const index = getNextIndex();
            const html = template.innerHTML.replaceAll('__INDEX__', index);
            rowsContainer.insertAdjacentHTML('beforeend', html);
            bindRemoveButtons();
        });

        bindRemoveButtons();
    })();
</script>
@endpush