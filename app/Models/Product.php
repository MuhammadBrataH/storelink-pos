<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'category', 'description', 'image_url'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
