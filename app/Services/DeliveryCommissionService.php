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
        if ($dailyDeliveryCount <= 20) {
            return 0.70;
        } elseif ($dailyDeliveryCount <= 30) {
            return 0.80;
        } elseif ($dailyDeliveryCount <= 50) {
            return 0.90;
        } else {
            return 1.00;
        }
    }

    public function calculateAndSetDailyCommissions(User $deliveryPerson, Carbon $date): void
    {
        $deliveredOrders = Order::where('delivered_by', $deliveryPerson->id)
                                ->whereDate('delivered_at', $date)
                                ->where('order_status', 'Delivered')
                                ->orderBy('delivered_at')
                                ->lockForUpdate()
                                ->get();

        $dailyCount = 0;
        foreach ($deliveredOrders as $order) {
            $dailyCount++;
            $rate = $this->getCommissionRate($dailyCount);
            $commission = round($order->delivery_charge * $rate, 2);

            if ($order->delivery_guy_commission === null || abs($order->delivery_guy_commission - $commission) > 0.001) {
                $order->delivery_guy_commission = $commission;
                $order->save();
            }
        }
    }
}