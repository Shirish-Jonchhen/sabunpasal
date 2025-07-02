<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeliveryPayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_person_id',
        'amount',
        'payment_date',
        'status',          // e.g., 'Pending', 'Paid', 'Cancelled'
        'paid_by_user_id', // The admin user who processed the payout
        'notes',
        'period_start_date',
        'period_end_date',
    ];

    protected $casts = [
        'payment_date'      => 'datetime',
        'period_start_date' => 'date',
        'period_end_date'   => 'date',
        'amount'            => 'decimal:2',
    ];

    public function deliveryPerson()
    {
        return $this->belongsTo(User::class, 'delivery_person_id');
    }

    public function paidBy()
    {
        return $this->belongsTo(User::class, 'paid_by_user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'delivery_payout_id');
    }
}