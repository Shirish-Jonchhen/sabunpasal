<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DeliveryCommissionService
{
    public function getCommissionRate(int $dailyDeliveryCount): float
    {
        if ($dailyDeliveryCount <= 5) {
            return 0.70;
        } elseif ($dailyDeliveryCount <= 10) {
            return 0.80;
        } elseif ($dailyDeliveryCount <= 15) {
            return 0.90;
        } else {
            return 1.00;
        }
    }

    public function calculateCommissionForOrder(User $deliveryPerson, Carbon $date, float $deliveryCharge): float
{
    $deliveredCountToday = Order::where('delivered_by', $deliveryPerson->id)
                                ->whereDate('delivered_at', $date)
                                ->where('order_status', 'delivered')
                                ->count();

    // This is for the order being marked as delivered now
    $dailyCount = $deliveredCountToday + 1;

    $rate = $this->getCommissionRate($dailyCount);

    return round($deliveryCharge * $rate, 2);
}
}