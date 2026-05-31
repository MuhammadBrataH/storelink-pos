<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'description',
        'image_url',
    ];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function getStockStatusAttribute()
    {
        $totalStock = $this->variations->sum('stock');

        if ($totalStock === 0) {
            return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border bg-red-100 text-red-700 border-red-200">Habis</span>';
        }

        if ($totalStock <= 5) {
            return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border bg-orange-100 text-orange-700 border-orange-200">Rendah</span>';
        }

        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border bg-green-100 text-green-700 border-green-200">Aman</span>';
    }
}
