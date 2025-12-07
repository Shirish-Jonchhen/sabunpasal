<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\CartItem;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\StoreOrder;
use App\Models\StoreOrderProduct;
use App\Models\VariantPrice;
use App\Models\Ward;
use App\Services\KhaltiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class CheckoutController extends Controller
{
    public function __construct(private KhaltiService $khaltiService)
    {
    }

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

        $isKhalti = $request->payment_method === 'khalti';
        $cartItems = CartItem::where('user_id', Auth::user()->id)->get();

        foreach ($cartItems as $item) {
            if ($item->variantPrice->variant->stock < $item->quantity * $item->variantPrice->pieces_per_unit) {
                
                return redirect()->back()->with('error', 'Insufficient stock for product: ' . $item->variantPrice->variant->product->name);
            }
        }

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

        // attach transient customer info to the order instance (not persisted) for payment payloads
        $order->setAttribute('customer_name', $request->name);
        $order->setAttribute('customer_email', $request->email);
        $order->setAttribute('customer_phone', $request->phone);


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

        if ($isKhalti) {
            try {
                $initiate = $this->khaltiService->initiate($order, (int) round($order->total_amount * 100));
            } catch (Throwable $exception) {
                return redirect()->route('user.checkout')->with('error', 'Unable to initiate Khalti payment. Please try again.');
            }

            Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total_amount,
                'method' => $request->payment_method,
                'payment_status' => 'pending',
                'payment_reference' => $initiate['pidx'] ?? null,
                'notes' => isset($initiate) ? json_encode($initiate) : null,
            ]);

            return redirect()->away($initiate['payment_url']);
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'method' => $request->payment_method,
            'payment_status' => 'pending',
            'payment_reference' => null,
        ]);

        $this->finalizeOrder($order, false);

        return redirect()->route("user.orders")->with('success', 'Order created successfully.');
    }


    public function create_single_order(Request $request)
    {
        // <input type="hidden" name="product_variant_id" value="{{ $productVariantPriceId }}">
        // <input type="hidden" name="quantity" value="{{ $quantity }}">
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
            'product_variant_price_id' => 'required|exists:variant_prices,id',
            'quantity' => 'required|integer|min:1',
            'delivery_charge' => 'nullable|numeric',
        ]);

        $isKhalti = $request->payment_method === 'khalti';

        $variantPrice = VariantPrice::findOrFail($request->product_variant_price_id);
        $subtotal = $variantPrice->old_price * $request->quantity;
        $totalTax = (($variantPrice->variant->product->tax_rate / 100) * $variantPrice->price) * $request->quantity;
        $discountAmount = ($variantPrice->old_price - $variantPrice->price) * $request->quantity;


        if ($variantPrice->variant->stock < ($request->quantity * $variantPrice->pieces_per_unit)) {
            return redirect()->back()->with('error', 'Insufficient stock for product: ' . $variantPrice->variant->product->name);
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

        $storeId = $variantPrice->variant->product->store->id ?? null;
        if ($storeId) {
            $storeSubtotal = $subtotal;
            $storeTax = $totalTax;
            $storeDiscount = $discountAmount;

            $storeOrder = StoreOrder::create([
                'order_id' => $order->id,
                'store_id' => $storeId,
                'user_id' => Auth::user()->id,
                'subtotal' => $storeSubtotal,
                'tax' => $storeTax,
                'discount' => $storeDiscount,
                'total' => $storeSubtotal + $storeTax - $storeDiscount,
                'status' => 'pending',
            ]);

            StoreOrderProduct::create([
                'store_order_id' => $storeOrder->id,
                'variant_price_id' => $variantPrice->id,
                'quantity' => $request->quantity,
                'price_at_order_time' => $variantPrice->price,
            ]);
        }

        // attach transient customer info to the order instance (not persisted) for payment payloads
        $order->setAttribute('customer_name', $request->name);
        $order->setAttribute('customer_email', $request->email);
        $order->setAttribute('customer_phone', $request->phone);

        if ($isKhalti) {
            try {
    
                $initiate = $this->khaltiService->initiate($order, (int) round($order->total_amount * 100));
            } catch (Throwable $exception) {
                return redirect()->route('user.checkout')->with('error', 'Unable to initiate Khalti payment. Please try again.');
            }

            Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total_amount,
                'method' => $request->payment_method,
                'payment_status' => 'pending',
                'payment_reference' => $initiate['pidx'] ?? null,
                'notes' => isset($initiate) ? json_encode($initiate) : null,
            ]);

            return redirect()->away($initiate['payment_url']);
        }

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'method' => $request->payment_method,
            'payment_status' => 'pending',
            'payment_reference' => null,
        ]);

        $this->finalizeOrder($order, false);

        return redirect()->route("user.orders")->with('success', 'Order created successfully.');
    }





    public function single_checkout($slug, Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('home')->with('error', 'You are not allowed to access this page.');
        }

        $product = Product::where('slug', $slug)->firstOrFail();

        $variantPrice = VariantPrice::where('id', $request->variant_price_id)
            ->firstOrFail();

        $quantity = $request->quantity ?? 1;

        return view('customer.checkout.single_checkout', ['slug' => $slug, 'product' => $product, 'variantPrice' => $variantPrice, 'quantity' => $quantity]);
    }

    public function handleKhaltiReturn(Request $request)
    {
        $pidx = $request->query('pidx');

        if (!$pidx) {
            return redirect()->route('user.orders')->with('error', 'Payment reference missing.');
        }

        $payment = Payment::where('payment_reference', $pidx)
            ->with('order.storeOrders.storeOrederProducts.variantPrice.variant', 'order.user')
            ->first();

        if (!$payment || !$payment->order) {
            return redirect()->route('user.orders')->with('error', 'Payment not found.');
        }

        if ($payment->payment_status === 'completed' || $payment->order->payment_status === 'paid') {
            return redirect()->route('user.orders')->with('success', 'Payment already verified.');
        }

        try {
            $lookup = $this->khaltiService->lookup($pidx);
        } catch (Throwable $exception) {
            return redirect()->route('user.orders')->with('error', 'Unable to verify payment at the moment.');
        }
        $expectedAmount = (int) round($payment->order->total_amount * 100);
        $paidAmount = (int) ($lookup['total_amount'] ?? 0);

        if (($lookup['status'] ?? null) === 'Completed' && $paidAmount === $expectedAmount) {
            $payment->update([
                'payment_status' => 'completed',
                'notes' => json_encode($lookup),
            ]);

            $payment->order->update([
                'payment_status' => 'paid',
                'payment_method' => 'khalti',
            ]);

            foreach ($payment->order->storeOrders as $storeOrder) {
                $storeOrder->update(['payment_status' => 'paid']);
            }

            $this->finalizeOrder($payment->order, true, $pidx);

            return redirect()->route('user.orders')->with('success', 'Payment successful.');
        }

        $payment->update([
            'payment_status' => 'failed',
            'notes' => json_encode($lookup),
        ]);

        return redirect()->route('user.orders')->with('error', 'Payment could not be verified.');
    }

    private function finalizeOrder(Order $order, bool $markPaid = false, ?string $paymentReference = null): void
    {
        $order->loadMissing('storeOrders.storeOrederProducts.variantPrice.variant', 'user');

        $variantPriceIds = [];
        foreach ($order->storeOrders as $storeOrder) {
            foreach ($storeOrder->storeOrederProducts as $product) {
                $variant = $product->variantPrice->variant;
                $variant->stock -= ($product->quantity * $product->variantPrice->pieces_per_unit);
                $variant->save();
                $variantPriceIds[] = $product->variant_price_id;
            }

            if ($markPaid && $storeOrder->payment_status !== 'paid') {
                $storeOrder->update(['payment_status' => 'paid']);
            }
        }

        if (!empty($variantPriceIds)) {
            CartItem::where('user_id', $order->user_id)
                ->whereIn('variant_price_id', $variantPriceIds)
                ->delete();
        }

        $updates = ['order_status' => 'processing'];
        if ($markPaid) {
            $updates['payment_status'] = 'paid';
        }
        $order->update($updates);

        if ($markPaid && $paymentReference) {
            $payment = Payment::where('order_id', $order->id)
                ->where('payment_reference', $paymentReference)
                ->latest()
                ->first();

            if ($payment && $payment->payment_status !== 'completed') {
                $payment->update(['payment_status' => 'completed']);
            }
        }

        $recipient = optional($order->user)->email;

        if ($recipient) {
            try {
                Mail::to($recipient)->send(new OrderConfirmation($order));
            } catch (Throwable $exception) {
                Log::warning('Order confirmation email failed', [
                    'order_id' => $order->id,
                    'recipient' => $recipient,
                    'message' => $exception->getMessage(),
                ]);
            }
        }
    }
}
