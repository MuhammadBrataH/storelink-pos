<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products_variations';

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'price_capital',
        'price_sell',
        'stock',
        'barcode',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
