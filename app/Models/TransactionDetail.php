<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = ['transaction_id', 'variation_id', 'quantity', 'price_capital', 'price_sell'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class)->withTrashed();
    }
}
