<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCollection;
use App\Models\DeliveryPayout;
use App\Models\Municipality;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryMainController extends Controller
{
    public function index()
    {
        $months = collect();
        $monthlyCommissionEarnings = collect(); // To store sum of delivery_guy_commission per month
        $monthlyDeliveredOrdersCount = collect(); // To store count of delivered orders by delivery guys per month

        $now = Carbon::now();

        for ($i = 11; $i >= 0; $i--) {
            $monthDate = $now->copy()->subMonths($i); // Use ->copy() to prevent modifying $now

            // Format month for display (e.g., "Jan", "Feb")
            $months->push($monthDate->format('M'));

            // Query for monthly commission earnings
            $commissionEarnings = Order::whereYear('delivered_at', $monthDate->year)
                ->where('delivered_by', Auth::user()->id) // Ensure the order was delivered by the current delivery person
                ->whereMonth('delivered_at', $monthDate->month)
                ->where('order_status', 'Delivered') // Only consider delivered orders for commission
                ->whereNotNull('delivery_guy_commission') // Only orders with a commission set
                ->sum('delivery_guy_commission'); // Sum the commission amounts

            $monthlyCommissionEarnings->push($commissionEarnings);

            // Query for monthly delivered orders count by delivery guys
            $deliveredOrdersCount = Order::whereYear('delivered_at', $monthDate->year)
                ->where('delivered_by', Auth::user()->id) // Ensure the order was delivered by the current delivery person
                ->whereMonth('delivered_at', $monthDate->month)
                ->where('order_status', 'Delivered') // Only count delivered orders
                ->whereNotNull('delivered_by') // Ensure it was delivered by a person (not self-pickup etc.)
                ->count();

            $monthlyDeliveredOrdersCount->push($deliveredOrdersCount);
        }


        $deliveryLocationCounts = DB::table('orders')
            ->select('municipality', DB::raw('COUNT(*) as count'))
            ->where('delivered_by', Auth::user()->id) // Ensure the order was delivered by the current delivery person
            ->where('order_status', 'delivered') // Only consider delivered orders
            ->whereMonth('delivered_at', Carbon::now()->month)
            ->whereYear('delivered_at', Carbon::now()->year)
            ->groupBy('municipality')
            ->get();

        $deliveryLocationLabels = $deliveryLocationCounts->pluck('municipality');
        $deliveryLocationCountsData = $deliveryLocationCounts->pluck('count');

        // --- NEW: Generate dynamic colors for the pie chart ---
        $pieChartColors = [];
        // Define a comprehensive list of distinct colors
        $predefinedColors = [
            '#4e73df', // Bootstrap Primary / Theme Blue
            '#f6c23e', // Bootstrap Warning / Theme Yellow
            '#e74a3b', // Bootstrap Danger / Theme Red
            '#36b9cc', // Bootstrap Info / Theme Cyan
            '#1cc88a', // Bootstrap Success / Theme Green
            '#858796', // Bootstrap Secondary / Theme Grey
            '#fd7e14', // Bootstrap Orange
            '#6f42c1', // Bootstrap Purple
            '#20c997', // Bootstrap Teal
            '#6610f2', // Bootstrap Indigo
            '#d63384', // Bootstrap Pink
            '#6c757d', // Dark Grey (a darker secondary)
            '#adb5bd', // Light Grey (a lighter secondary)
            '#28a745', // Stronger Green
            '#007bff', // Stronger Blue
            '#dc3545', // Stronger Red
            '#ffc107', // Stronger Yellow
            '#17a2b8', // Stronger Cyan
            '#663399', // A custom purple
            '#CC6666', // Muted Red
            '#FF9900', // Bright Orange
            '#99CC99', // Light Green
            '#6699CC', // Medium Blue
            '#FFCC00', // Gold
            '#CCFFCC', // Very Light Green
            // Add many more hex codes here if you expect a very large number of distinct municipalities
        ];

        $numberOfSlices = $deliveryLocationLabels->count();
        for ($i = 0; $i < $numberOfSlices; $i++) {
            // Use modulo operator to cycle through predefinedColors if there are more slices than colors
            $pieChartColors[] = $predefinedColors[$i % count($predefinedColors)];
        }
        // --- END: Generate dynamic colors ---



        return view('delivery.delivery', compact(
            'months',
            'monthlyCommissionEarnings',
            'monthlyDeliveredOrdersCount',
            'deliveryLocationLabels',
            'deliveryLocationCountsData',
            'pieChartColors' // Pass the new color array to the view
        ));
    }



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
                    $query->orderBy('delivered_at', 'desc');
                    break;
                case 'date_oldest':
                    $query->orderBy('delivered_at', 'asc');
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

    public function go_to_other_orders(Request $request)
    {
        $query = Order::where('delivered_by', Auth::user()->id)
        ->whereIn('order_status', ['returned', 'cancelled']);
    


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
                    $query->orderBy('delivered_at', 'desc');
                    break;
                case 'date_oldest':
                    $query->orderBy('delivered_at', 'asc');
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

        $orderStatuses = ['pending', 'processing', 'shpipped', 'delivered'];
        $paymentStatuses = ['unapid','paid'];
        $municipalities = Municipality::orderBy('municipality_name')->get();
        return view(
            'delivery.orders.others',
            compact(
                'orders',
                'orderStatuses',
                'paymentStatuses',
                'municipalities',
                'searchQuery',
                'municipalityQuery',
                'sortQuery'
            )
        );
    }

    public function go_to_collections(Request $request)
    {
        $collections = DeliveryCollection::where('delivery_person_id', Auth::user()->id);

        //filter by date by start date
        if ($request->has('start_date') && $request->start_date != '') {
            $collections->whereDate('created_at', '>=', $request->start_date);
        }
        //filter by date by end date
        if ($request->has('end_date') && $request->end_date != '') {
            $collections->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->has('sort') && $request->sort != '') {
            switch ($request->sort) {
                case 'amount_asc':
                    $collections->orderBy('amount_collected', 'asc');
                    break;
                case 'amount_desc':
                    $collections->orderBy('amount_collected', 'desc');
                    break;
                case 'date_latest':
                    $collections->orderBy('created_at', 'desc');
                    break;
                case 'date_oldest':
                    $collections->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            // Default sorting
            $collections->orderBy('created_at', 'desc');
        }


        // ✅ Add pagination (e.g., 10 per page)
        $collections = $collections->paginate(10);
        return view(
            'delivery.earnings.collections',
            compact(
                'collections',
                'request'
            )
        );
    }

    public function go_to_payouts(Request $request)
    {

        $payouts = DeliveryPayout::where('delivery_person_id', Auth::user()->id);

        //filter by date by start date
        if ($request->has('start_date') && $request->start_date != '') {
            $payouts->whereDate('created_at', '>=', $request->start_date);
        }
        //filter by date by end date
        if ($request->has('end_date') && $request->end_date != '') {
            $payouts->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->has('sort') && $request->sort != '') {
            switch ($request->sort) {
                case 'amount_asc':
                    $payouts->orderBy('amount', 'asc');
                    break;
                case 'amount_desc':
                    $payouts->orderBy('amount', 'desc');
                    break;
                case 'date_latest':
                    $payouts->orderBy('created_at', 'desc');
                    break;
                case 'date_oldest':
                    $payouts->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            // Default sorting
            $payouts->orderBy('created_at', 'desc');
        }


        // ✅ Add pagination (e.g., 10 per page)
        $payouts = $payouts->paginate(10);



        return view('delivery.earnings.payouts', compact(
            'payouts',
            'request'
        ));
    }
}
