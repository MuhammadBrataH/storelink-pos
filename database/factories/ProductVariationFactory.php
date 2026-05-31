<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductVariation>
 */
class ProductVariationFactory extends Factory
{
    protected $model = ProductVariation::class;

    public function definition(): array
    {
        $priceCapital = $this->faker->numberBetween(50000, 150000);

        return [
            'product_id' => Product::factory(),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'color' => $this->faker->colorName(),
            'price_capital' => $priceCapital,
            'price_sell' => $priceCapital + $this->faker->numberBetween(10000, 50000),
            'stock' => $this->faker->numberBetween(0, 50),
            'barcode' => null,
        ];
    }
}
