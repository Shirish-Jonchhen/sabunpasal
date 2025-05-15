<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Order;
use App\Models\Payment;
use App\Models\StoreOrder;
use App\Models\StoreOrderProduct;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('home')->with('error', 'You are not allowed to access this page.');
        } else {
            $districts = District::all();
            $municipalities = Municipality::all();

            $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
           
            return view('customer.checkout.checkout', compact('districts', 'municipalities', 'cartItems'));
        }
    }


    public function create_order(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'district' => 'required|exists:districts,id',
            'municipality' => 'required|exists:municipalities,id',
            'ward' => 'required|exists:wards,id',
            'country' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'shipping_method' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            'delivery_charge' => 'nullable|numeric',
        ]);

        $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->variantPrice->old_price * $item->quantity;
        }
        $totalTax = 0;
        foreach ($cartItems as $item) {
            $totalTax += (($item->variantPrice->variant->product->tax_rate / 100) * $item->variantPrice->price) * $item->quantity;
        }
        $discountAmount = 0; // Set discount amount if applicable
        foreach ($cartItems as $item) {
            $discountAmount += ($item->variantPrice->old_price - $item->variantPrice->price) * $item->quantity;
        }


        $order = Order::create([

            'user_id' => Auth::user()->id,
            // 'user_address_id' => $request->address,
            'delivery_method' => $request->shipping_method,
            'place_name' => $request->address,
            'municipality' => Municipality::find($request->municipality)->municipality_name,
            'ward' => Ward::find($request->ward)->ward_name,
            'street' => $request->address,
            'additional_info' => $request->note,
            'delivery_charge' => $request->delivery_charge, // Set delivery charge if applicable
            'subtotal' => $subtotal,
            'discount' => $discountAmount,
            'tax' => $totalTax,
            'total_amount' => $subtotal + $totalTax - $discountAmount,
            'payment_status' => 'unpaid', // Set payment status if applicable
            'order_status' => 'pending', // Set order status if applicable
            'notes' => $request->note,
            'order_tracking_number' => Order::generateTrackingNumber(Auth::user()->id),
            'district' => District::find($request->district)->district_name,
            'country' => $request->country,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
        ]);


        $groupedByStore = $cartItems->groupBy(function ($item) {
            return $item->variantPrice->variant->product->store->id ?? null;
        })->filter();

        foreach ($groupedByStore as $storeId => $items) {
            $storeSubtotal = 0;
            $storeTax = 0;
            $storeDiscount = 0;
        
            foreach ($items as $item) {
                $price = $item->variantPrice->price;
                $oldPrice = $item->variantPrice->old_price;
                $quantity = $item->quantity;
                $taxRate = $item->variantPrice->variant->product->tax_rate;
        
                $storeSubtotal += $oldPrice * $quantity;
                $storeTax += (($taxRate / 100) * $price) * $quantity;
                $storeDiscount += ($oldPrice - $price) * $quantity;
            }
        
            $storeTotal = $storeSubtotal + $storeTax - $storeDiscount;
        
            $storeOrder = StoreOrder::create([
                'order_id' => $order->id,
                'store_id' => $storeId,
                'user_id' => Auth::user()->id,
                'subtotal' => $storeSubtotal,
                'tax' => $storeTax,
                'discount' => $storeDiscount,
                'total' => $storeTotal,
                'status' => 'pending',
            ]);
            foreach ($items as $item) {
               StoreOrderProduct::create([
                    'store_order_id' => $storeOrder->id,
                    'variant_price_id' => $item->variant_price_id,
                    'quantity' => $item->quantity,
                    'price_at_order_time' => $item->variantPrice->price,
                ]);
            }
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'method' => $request->payment_method,
            'payment_status' => 'pending', // Set payment status if applicable
            'payment_reference' => null, // Set payment reference if applicable
            // 'notes' => $request->note,
            'status' => 'pending',
            // Add other payment-related fields as needed
        ]);

        // Clear the cart after order creation
        foreach ($cartItems as $item) {
            $item->delete();
        }

        //reduce variantPrice quantity by order quantity
        foreach ($cartItems as $item) {
            $variantPrice = $item->variantPrice;
            $variantPrice->stock -= $item->quantity;
            $variantPrice->save();
        }

        return redirect()->route("user.orders")->with('success', 'Order created successfully.');
    }
}
