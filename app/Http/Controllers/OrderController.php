<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('home')->with('error', 'You are not allowed to access this page.');
        } else {
            $orders = Order::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('customer.order.order_list', compact('orders'));
        }
    }

    public function show_single_order($trackingNumber)
    {
        if (!Auth::user()) {
            return redirect()->route('home')->with('error', 'You are not allowed to access this page.');
        } else {
            $order = Order::where('user_id', Auth::user()->id)
                ->where('order_tracking_number', $trackingNumber)
                ->first();
            if ($order) {
                return view('customer.order.order_detail', compact('order'));
            } else {
                return redirect()->back()->with('error', 'Order not found.');
            }
        }
    }
}
