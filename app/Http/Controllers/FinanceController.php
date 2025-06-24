<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function goToRemainingCollections(Request $request){
        $deliveryPersons = User::where('role', 4)->orderBy('name')->get();

        // Build the base query for uncollected COD orders
        $query = Order::where('payment_method', 'cod') // Must be Cash on Delivery
                      ->where('order_status', 'Delivered') // Must be delivered
                      ->whereNull('delivery_collection_id'); // Must NOT have been reconciled/collected yet

        // --- Apply Optional Filters from Request ---
        // Filter by specific delivery person
        if ($request->filled('delivery_person_id')) {
            $query->where('delivered_by', $request->input('delivery_person_id'));
        }
        // Filter by delivery date start
        if ($request->filled('start_date')) {
            $query->where('delivered_at', '>=', Carbon::parse($request->input('start_date'))->startOfDay());
        }
        // Filter by delivery date end
        if ($request->filled('end_date')) {
            $query->where('delivered_at', '<=', Carbon::parse($request->input('end_date'))->endOfDay());
        }

        // --- Aggregate Data ---
        // Select the delivery person ID, sum of total_amount, and count of orders
        $uncollectedData = $query->select(
                                    'delivered_by', // The ID of the delivery person
                                    DB::raw('SUM(total_amount) as total_uncollected_amount'), // Sum of all uncollected order amounts
                                    DB::raw('COUNT(id) as total_uncollected_orders') // Count of uncollected orders
                                )
                                ->groupBy('delivered_by') // Group the results by delivery person
                                ->with('deliveryPerson') // Load the related delivery person (User model)
                                ->get(); // Execute the query

        dd($uncollectedData);


        return view('admin.finance.remaining_collection', compact('uncollectedOrders'));
    }

    public function goToRemainingPayouts(){
        $uncollectedOrders = Order::where('payment_method', 'cod')
                                  ->where('order_status', 'Delivered')
                                  ->whereNull('delivery_collection_id')
                                  ->get();

        return view('admin.finance.remaining_payouts', compact('uncollectedOrders'));
    }
}
