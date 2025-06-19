<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryMainController extends Controller
{
    public function index()
    {
        return view('delivery.delivery');
    }

    // Route::get('/dashboard', 'index')->name('delivery');
    // Route::get('/orders/active', 'go_to_active_orders')->name('delivery.active');
    // Route::get('/orders/completed', 'go_to_completed_orders')->name('delivery.completed');
    // Route::get('/orders/other', 'go_to_other_orders')->name('delivery.other');
    // Route::get('/earnings', 'go_to_earnings')->name('delivery.earnings');
    // Route::get('/payouts', 'go_to_payouts')->name('delivery.payouts');

    public function go_to_active_orders()
    {

        $orders = Auth::user()->deliveredOrders()
        ->whereNot('order_status', 'delivered')
        ->orderBy('created_at', 'desc')
        ->get();

        $orderStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'];
$paymentStatuses = ['unpaid', 'partial', 'paid', 'refunded'];
    

        return view('delivery.orders.active', compact('orders', 'orderStatuses', 'paymentStatuses'));
    }

    public function go_to_completed_orders()
    {
        return view('delivery.orders.completed');
    }

    public function go_to_other_orders()
    {
        return view('delivery.orders.others');
    }
    
    public function go_to_earnings()
    {
        return view('delivery.earnings.earnings');
    }
    
    public function go_to_payouts()
    {
        return view('delivery.earnings.payouts');
    }


}
