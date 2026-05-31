<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 20 produk sebagai data induk (parent).
        for ($i = 0; $i < 20; $i++) {
            // Setiap produk dibuat lewat factory agar field dummy konsisten.
            Product::factory()
                // Has factory relasi untuk menambahkan 3-4 variasi (child) per produk.
                ->has(ProductVariation::factory()->count(fake()->numberBetween(3, 4)), 'variations')
                // create() akan menulis data induk lalu anaknya secara otomatis.
                ->create();
        }
    }
}
