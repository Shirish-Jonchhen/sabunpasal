<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\StoreOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VendorMainController extends Controller
{
    public function index()
    {


        $months = collect();
        $ordersData = collect(); // You should fill this with your actual data per month
        $orderSales = collect(); // You should fill this with your actual sales data per month

        for ($i = 11; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $months->push($monthDate->format('M'));

            $orderCount = StoreOrder::whereIn('store_id', function ($query) {
                $query->select('id')
                    ->from('stores')
                    ->where('user_id', Auth::user()->id);
            })->whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->count();

            $orderSalesCount = StoreOrder::whereIn('store_id', function ($query) {
                $query->select('id')
                    ->from('stores')
                    ->where('user_id', Auth::user()->id);
            })->whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->sum('total');
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

        return view('vendor.dashboard', compact('months', 'ordersData', 'orderSales', 'deliveryMethodLabels', 'deliveryMethodCountsData'));
    }

    public function order_history()
    {
        return view('vendor.order_history');
    }
}
