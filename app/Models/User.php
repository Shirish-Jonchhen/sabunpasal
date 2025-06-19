<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id', 
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * A user (as a customer) can have many orders.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id'); // Explicitly define foreign key if not default
    }

    /**
     * A user (as a delivery person) can deliver many orders.
     */
    public function deliveredOrders()
    {
        return $this->hasMany(Order::class, 'delivered_by'); // 'delivered_by' is the foreign key in the Order model
    }

    // You can uncomment and use the `deliveries()` method as you had it,
    // but `deliveredOrders()` might be more semantically clear
    // public function deliveries()
    // {
    //     return $this->hasMany(Order::class, 'delivered_by');
    // }

    // --- Existing Relationships ---
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}