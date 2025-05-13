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
        'user_id', 'user_address_id', 'delivery_method', 'place_name', 'municipality', 'ward', 'street',
        'additional_info', 'delivery_charge', 'subtotal', 'discount', 'tax', 'total_amount',
        'payment_status', 'order_status', 'notes', 'order_tracking_number', 'district', 'country','phone', 'email', 'name', 'payment_method'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function vendorOrders() { return $this->hasMany(StoreOrder::class); }
    
    public static function generateTrackingNumber($userId)
    {
        $prefix = 'ORD';
        $datetime = Carbon::now()->format('Ymd-Hisv'); // Ymd-Hisv → 20250512-134522123
        $random = Str::upper(Str::random(4));          // 4-char random string
        $userPart = str_pad($userId, 4, '0', STR_PAD_LEFT); // e.g., 42 → 0042
    
        return "{$prefix}-{$userPart}-{$datetime}-{$random}";
    }
    
}
