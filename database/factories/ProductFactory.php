<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $names = [
            'Kaos',
            'Kemeja',
            'Hoodie',
            'Jaket',
            'Celana',
            'Rok',
            'Sweater',
            'Cardigan',
            'Tas',
            'Topi',
            'Sepatu',
            'Aksesoris',
        ];

        return [
            'name' => $this->faker->randomElement($names) . ' ' . $this->faker->words(2, true),
            'category' => $this->faker->randomElement(['Baju', 'Celana', 'Aksesoris', 'Tas']),
            'description' => $this->faker->sentence(12),
            'image_url' => null,
        ];
    }
}
