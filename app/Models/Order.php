<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        'district',
        'country',
        'phone',
        'email',
        'name',
        'payment_method',
        'delivered_by',            // ID of the user who delivered the order
        'delivered_at',            // Timestamp when the order was delivered
        'delivery_guy_commission', // Commission earned by the delivery guy for THIS order
        'delivery_payout_id',      // Foreign key to DeliveryPayout, indicates if commission is paid
    ];

    protected $casts = [
        'delivered_at'          => 'datetime',
        'delivery_guy_commission' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function storeOrders()
    {
        return $this->hasMany(StoreOrder::class);
    }

    public function deliveryPerson()
    {
        return $this->belongsTo(User::class, 'delivered_by');
    }

    public function payout()
    {
        return $this->belongsTo(DeliveryPayout::class, 'delivery_payout_id');
    }

    public static function generateTrackingNumber($userId)
    {
        $prefix = 'ORD';
        $datetime = Carbon::now()->format('Ymd-Hisv');
        $random = Str::upper(Str::random(4));
        $userPart = str_pad($userId, 4, '0', STR_PAD_LEFT);

        return "{$prefix}-{$userPart}-{$datetime}-{$random}";
    }
}