<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrderProduct extends Model
{

    use HasFactory;
    protected $fillable = [
        'store_order_id', 'variant_price_id', 'quantity', 'price_at_order_time'
    ];
    public function storeOrder() { return $this->belongsTo(StoreOrder::class); }
    public function variantPrice() { return $this->belongsTo(VariantPrice::class); }


}
