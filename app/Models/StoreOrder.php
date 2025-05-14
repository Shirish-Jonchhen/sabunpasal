<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'order_id', "store_id" ,'subtotal', 'tax', 'discount', 'total', 
        'status', 'payment_status', 'notes'
    ];

    public function order() { return $this->belongsTo(Order::class); }
    public function store() { return $this->belongsTo(Store::class); }
    public function storeOrederProducts() { return $this->hasMany(StoreOrderProduct::class); }

}
