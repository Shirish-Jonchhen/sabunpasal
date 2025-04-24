<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_address_id',
        'delivery_method',
        'place_name',
        'municipality',
        'ward',
        'street',
        'additional_info',
        'delivery_charge',
        'subtotal',
        'discount',
        'tax',
        'total_amount',
        'payment_status',
        'order_status',
        'notes',
        'order_tracking_number',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    // You may add more relationships for order items, payments, etc. if needed
}
