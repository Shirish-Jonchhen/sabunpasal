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


    public function cancel_order($trackingNumber)
    {
        if (!Auth::user()) {
            return redirect()->route('home')->with('error', 'You are not allowed to access this page.');
        } else {
            $order = Order::where('user_id', Auth::user()->id)
                ->where('order_tracking_number', $trackingNumber)
                ->first();
            if ($order) {
                $order->update(['order_status' => 'cancelled']);
                //restock cancelled items
                foreach ($order->storeOrders as $storeOrder) {
                    $storeOrder->update(['status' => 'cancelled']);
                    foreach ($storeOrder->storeOrederProducts as $product) {
                        $product->variantPrice->increment('stock', $product->quantity);
                    }
                }
                return redirect()->back()->with('success', 'Order cancelled successfully.');
            } else {
                return redirect()->back()->with('error', 'Order not found.');
            }
        }
    }



    //admin
    public function get_all_orders(Request $request){
        $search = $request->input('search');
        $status = $request->input('status');
        $sort = $request->input('sort');
    
        $query = Order::with('storeOrders.store', 'storeOrders.storeOrederProducts.variantPrice.variant.product');
    
        if (!empty($search)) {
            $query->where('order_tracking_number', 'like', "%{$search}%");
        }
    
        if (!empty($status)) {
            $query->where('order_status', $status);
        }
    
        if (!empty($sort)) {
            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('total_amount', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('total_amount', 'desc');
                    break;
                case 'date_latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'date_oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
    
        $orders = $query->paginate(10);


        return view('admin.order.history', compact('orders', 'search', 'status', 'sort'));
    }

    public function show_one_order($trackingNumber)
    {
        $order = Order::where('order_tracking_number', $trackingNumber)
            ->with('storeOrders.store', 'storeOrders.storeOrederProducts.variantPrice.variant.product')
            ->first();
        if ($order) {
            return view('admin.order.view', compact('order'));
        } else {
            return redirect()->back()->with('error', 'Order not found.');
        }
    }
}
