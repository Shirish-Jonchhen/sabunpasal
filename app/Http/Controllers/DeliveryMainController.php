<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\Order;
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

    public function go_to_active_orders(Request $request)
    {
        $query = Order::where('delivered_by', Auth::user()->id)
            ->where('order_status', '!=', 'delivered')
            ->where('order_status', '!=', 'returned')
            ->where('order_status', '!=', 'cancelled')
            ->where('delivery_method', 'delivery');

        if ($request->has('search') && $request->search != '') {
            $query->where('order_tracking_number', 'like', '%' . $request->search . '%');
        }

        if ($request->has('municipality') && $request->municipality != '') {
            $query->where('municipality', $request->municipality);
        }

        if ($request->has('sort') && $request->sort != '') {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'date_latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'date_oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        // ✅ Add pagination (e.g., 10 per page)
        $orders = $query->paginate(10);

        // Pass filters back to view
        $searchQuery = $request->query('search', '');
        $municipalityQuery = $request->query('municipality', '');
        $sortQuery = $request->query('sort', '');

        // To preserve query parameters in pagination links
        $orders->appends($request->all());

        $orderStatuses = ['pending', 'processing', 'shpipped', 'delivered', 'cancelled', 'returned'];
        $paymentStatuses = ['unapid', 'partial', 'paid'];
        $municipalities = Municipality::orderBy('municipality_name')->get();

        return view('delivery.orders.active', compact(
            'orders',
            'orderStatuses',
            'paymentStatuses',
            'municipalities',
            'searchQuery',
            'municipalityQuery',
            'sortQuery'
        ));
    }


    public function go_to_completed_orders(Request $request)
    {
        $query = Order::where('delivered_by', Auth::user()->id)
            ->where('order_status', 'delivered');

        if ($request->has('search') && $request->search != '') {
            $query->where('order_tracking_number', 'like', '%' . $request->search . '%');
        }

        if ($request->has('municipality') && $request->municipality != '') {
            $query->where('municipality', $request->municipality);
        }

        if ($request->has('sort') && $request->sort != '') {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'date_latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'date_oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        // ✅ Add pagination (e.g., 10 per page)
        $orders = $query->paginate(10);

        // Pass filters back to view
        $searchQuery = $request->query('search', '');
        $municipalityQuery = $request->query('municipality', '');
        $sortQuery = $request->query('sort', '');

        // To preserve query parameters in pagination links
        $orders->appends($request->all());

        $orderStatuses = ['pending', 'processing', 'shpipped', 'delivered', 'cancelled', 'returned'];
        $paymentStatuses = ['unapid', 'partial', 'paid'];
        $municipalities = Municipality::orderBy('municipality_name')->get();

        return view('delivery.orders.completed', compact(
            'orders',
            'orderStatuses',
            'paymentStatuses',
            'municipalities',
            'searchQuery',
            'municipalityQuery',
            'sortQuery'
        ));
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
