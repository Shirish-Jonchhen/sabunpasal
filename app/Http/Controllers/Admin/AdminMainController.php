<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMainController extends Controller
{
    public function index()
    {

        //orders variables for bar chart
        $months = collect();
        $ordersData = collect(); // You should fill this with your actual data per month
        $orderSales = collect(); // You should fill this with your actual sales data per month

        for ($i = 11; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $months->push($monthDate->format('M'));

            $orderCount = Order::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->count();

            $orderSalesCount = Order::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->sum('total_amount');
            $orderSales->push($orderSalesCount);

            $ordersData->push($orderCount);
        }


        //delivery method variables for pie chart
        $deliveryMethodCounts = DB::table('orders')
            ->select('delivery_method', DB::raw('COUNT(*) as count'))
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('delivery_method')
            ->get();

        $deliveryMethodLabels = $deliveryMethodCounts->pluck('delivery_method');
        $deliveryMethodCountsData = $deliveryMethodCounts->pluck('count');




        return view('admin.admin', compact('months', 'ordersData', 'orderSales', 'deliveryMethodLabels', 'deliveryMethodCountsData'));
    }

    public function setting()
    {
        return view('admin.settings');
    }

    public function manage_user()
    {
        //fetch all the user fom bd
        $users = User::latest()->paginate(10);
        return view('admin.user.manage', compact('users'));
    }

    public function manage_stores()
    {
        return view('admin.store.manage');
    }

    public function cart_history()
    {
        return view('admin.cart.history');
    }

    public function order_history()
    {
        return view('admin.order.history');
    }
}
