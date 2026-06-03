<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Storelink',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Kasir Storelink',
            'username' => 'kasir',
            'password' => bcrypt('password'),
            'role' => 'kasir',
        ]);

        $product1 = \App\Models\Product::create([
            'name' => 'Kemeja Flanel Pria',
            'category' => 'Baju',
            'description' => 'Kemeja flanel lengan panjang',
            'image_url' => 'https://i.ibb.co/L5Q2ZfB/flanel.jpg'
        ]);
        \App\Models\ProductVariation::create([
            'product_id' => $product1->id,
            'size' => 'L',
            'color' => 'Kotak Merah',
            'price_capital' => 150000,
            'price_sell' => 210000,
            'stock' => 50,
            'barcode' => '8991234567890'
        ]);

        $product2 = \App\Models\Product::create([
            'name' => 'Tas Selempang Wanita',
            'category' => 'Tas',
            'description' => 'Tas selempang bahan kulit sintetis',
            'image_url' => 'https://i.ibb.co/308D69m/tas.jpg'
        ]);
        \App\Models\ProductVariation::create([
            'product_id' => $product2->id,
            'size' => 'All Size',
            'color' => 'Coklat',
            'price_capital' => 200000,
            'price_sell' => 350000,
            'stock' => 10,
            'barcode' => '8999876543210'
        ]);

        $product3 = \App\Models\Product::create([
            'name' => 'Kalung Emas 18K',
            'category' => 'Aksesoris',
            'description' => 'Kalung emas asli 18 karat',
            'image_url' => 'https://i.ibb.co/K2Z3J6x/kalung.jpg'
        ]);
        \App\Models\ProductVariation::create([
            'product_id' => $product3->id,
            'size' => 'Standar',
            'color' => 'Gold',
            'price_capital' => 250000,
            'price_sell' => 350000,
            'stock' => 5,
            'barcode' => '8991112223334'
        ]);
    }
}
