<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCollection;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{


    //collections
    public function goToRemainingCollections(Request $request)
    {
        $deliveryPersons = User::where('role', 3)->orderBy('name')->get();

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
            'delivered_by',
            DB::raw('SUM(total_amount) as total_uncollected_amount'),
            DB::raw('COUNT(id) as total_uncollected_orders')
        )
            ->groupBy('delivered_by')
            ->with('deliveryPerson')
            ->paginate(10); // Execute the query

        // Corrected: Pass $uncollectedData to the view
        return view('admin.finance.remaining_collection', compact('uncollectedData', 'deliveryPersons', 'request'));
    }

    public function collectDeliverypayments(Request $request){
        $request->validate([
            'delivery_person_id' => 'required|exists:users,id',
            'amount_collected'   => 'required|numeric|min:0',
            'period_start_date'  => 'nullable|date', // Allow null input from form
            'period_end_date'    => 'nullable|date|after_or_equal:period_start_date', // Allow null input from form
            'notes'              => 'nullable|string|max:500',
        ]);

        $deliveryPersonId = $request->input('delivery_person_id');
        $amountCollected  = $request->input('amount_collected');

        // Resolve the effective period_start_date and period_end_date
        // These will be the actual values used for insertion and order linking

        $effectivePeriodStartDate = $request->filled('period_start_date')
                                    ? Carbon::parse($request->input('period_start_date'))->startOfDay()
                                    : null; // Temporarily allow null for resolution

        $effectivePeriodEndDate = $request->filled('period_end_date')
                                  ? Carbon::parse($request->input('period_end_date'))->endOfDay()
                                  : null; // Temporarily allow null for resolution


        DB::transaction(function () use ($deliveryPersonId, $amountCollected, $effectivePeriodStartDate, $effectivePeriodEndDate, $request) {

            // --- Determine the actual date range for linking orders and for the collection record ---
            $ordersToLinkQuery = Order::where('payment_method', 'cod')
                                     ->where('order_status', 'Delivered')
                                     ->where('delivered_by', $deliveryPersonId)
                                     ->whereNull('delivery_collection_id'); // Only uncollected orders

            // If effectivePeriodStartDate is null, find the minimum delivered_at among potential orders
            if (is_null($effectivePeriodStartDate)) {
                $minDeliveredAt = (clone $ordersToLinkQuery)->min('delivered_at');
                // Set effective start date to the earliest delivered order if found, else a sensible default (e.g., a very old date or today)
                $effectivePeriodStartDate = $minDeliveredAt ? Carbon::parse($minDeliveredAt)->startOfDay() : Carbon::createFromDate(2000, 1, 1)->startOfDay(); // Default to a very old date if no orders found, or adjust as needed
            }

            // If effectivePeriodEndDate is null, set it to now
            if (is_null($effectivePeriodEndDate)) {
                $effectivePeriodEndDate = Carbon::now()->endOfDay();
            }

            // Ensure start date is not after end date for the collection record itself
            if ($effectivePeriodStartDate->greaterThan($effectivePeriodEndDate)) {
                $effectivePeriodStartDate = $effectivePeriodEndDate->copy()->subDay(); // Or handle error
            }

            // 1. Create the new DeliveryCollection record with resolved dates
            $collection = DeliveryCollection::create([
                'delivery_person_id'   => $deliveryPersonId,
                'amount_collected'     => $amountCollected,
                'collection_date'      => Carbon::now(),
                'status'               => 'Recorded',
                'collected_by_user_id' => Auth::user()->id,
                'notes'                => $request->input('notes'),
                'period_start_date'    => $effectivePeriodStartDate, // Use resolved date
                'period_end_date'      => $effectivePeriodEndDate,   // Use resolved date
            ]);

            // 2. Link relevant COD orders to this new collection using the resolved date range
            // (Clone the base query again to apply date range filters without affecting previous min/max calculations)
            $ordersToLinkQuery = Order::where('payment_method', 'cod')
                                     ->where('order_status', 'Delivered')
                                     ->where('delivered_by', $deliveryPersonId)
                                     ->whereNull('delivery_collection_id')
                                     ->whereBetween('delivered_at', [$effectivePeriodStartDate, $effectivePeriodEndDate]); // Use resolved dates

            $ordersToLinkQuery->update(['delivery_collection_id' => $collection->id]);

            // Optional: Verification logic (as discussed previously)
            // ...
        });

        return redirect()->back()->with('success', 'Delivery collection recorded successfully.');

    }

    public function goToCollections(Request $request){
        $deliveryPersons = User::where('role', 3)->orderBy('name')->get();

        // Build the base query for all collections
        $query = DeliveryCollection::with('deliveryPerson')
            ->orderBy('collection_date', 'desc'); // Default to latest first

        // --- Apply Optional Filters from Request ---
        // Filter by specific delivery person
        if ($request->filled('delivery_person_id')) {
            $query->where('delivery_person_id', $request->input('delivery_person_id'));
        }
        // Filter by collection date start
        if ($request->filled('start_date')) {
            $query->where('collection_date', '>=', Carbon::parse($request->input('start_date'))->startOfDay());
        }
        // Filter by collection date end
        if ($request->filled('end_date')) {
            $query->where('collection_date', '<=', Carbon::parse($request->input('end_date'))->endOfDay());
        }

        // --- Execute Query and Paginate ---
        $collections = $query->paginate(10);

        return view('admin.finance.collection', compact('collections', 'deliveryPersons', 'request'));

    }






    //payouts functions
    public function goToRemainingPayouts()
    {
        $uncollectedOrders = Order::where('payment_method', 'cod')
            ->where('order_status', 'Delivered')
            ->whereNull('delivery_collection_id')
            ->get();

        return view('admin.finance.remaining_payouts', compact('uncollectedOrders'));
    }
}
