<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'size', 'color', 'price_capital', 'price_sell', 'stock', 'barcode'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
