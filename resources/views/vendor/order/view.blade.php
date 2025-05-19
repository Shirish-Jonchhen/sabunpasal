@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Order History - Admin Panel')
@section('vendor_layout')
@php
    use App\Models\User;

@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Order {{ $order->order->order_tracking_number }}</h5>
            </div>
            @if (session()->has('message'))
            <span class="text-green-500 text-sm">{{ session('message') }}</span>
        @endif
            <div class="order-detail-layout">
                <section class="order-main-details">
                    <div class="order-detail-header">
                        <h2>{{ $order->order->order_tracking_number }}</h2>



                        <livewire:vendor.order-status-updater :sorder="$order" />
                    
                    </div>
                    <p class="order-date">Placed on: {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}
                    </p>

                    <div class="order-items-summary">
                        <h3>Items Ordered</h3>
                        <div class="order-item-list">
                            <!-- Example Item 1 -->

    
                                @foreach ($order->storeOrederProducts as $product)
                                    <div class="order-summary-item">
                                        <img src="{{ asset('storage/' . $product->variantPrice->variant->images[0]->image_path) }}"
                                            alt="Sparkle All-Purpose Cleaner" class="item-image">
                                        <div class="item-info">
                                            <span class="item-name">{{ $product->variantPrice->variant->product->name }}
                                            </span>
                                            <span class="item-sku">Variant:
                                                {{ $product->variantPrice->variant->variant_name }}
                                                | Size: {{ $product->variantPrice->variant->size }} | Unit:
                                                {{ $product->variantPrice->unit->attribute_value }} </span>
                                            <span class="item-sku" style="font-size: 0.6rem">SKU:
                                                {{ $product->variantPrice->variant->sku }}</span>

                                        </div>
                                        <div class="item-price-qty">
                                            <span class="item-price">NRs. <small
                                                    style="text-decoration: line-through;">{{ $product->variantPrice->old_price }}</small>
                                                {{ $product->variantPrice->price }}x {{ $product->quantity }}</span>
                                        </div>
                                        <div class="item-subtotal">
                                            <span>NRs.
                                                {{ number_format($product->variantPrice->price * $product->quantity, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach

                        </div>
                    </div>

                    <div class="order-totals-summary">
                        <div class="summary-line"><span>Subtotal:</span> <span>NRs. {{ $order->subtotal }}</span></div>
                        <div class="summary-line"><span>Discount:</span> <span>NRs. {{ $order->discount }}</span></div>
                        {{-- <div class="summary-line"><span>Shipping:</span> <span>NRs.
                                {{ $order->delivery_charge }}</span></div> --}}
                        <div class="summary-line"><span>Tax (Est.):</span> <span>NRs. {{ $order->tax }}</span></div>
                        <div class="summary-line total"><strong>Grand Total:</strong> <strong>NRs.
                                {{ $order->total }}</strong></div>
                    </div>
                </section>

                <aside class="order-sidebar-details">
                    <div class="detail-card">
                        <h4>Shipping Address</h4>
                        @if ($order->order->delivery_method == 'pickup')
                            <p>Store Pick-Up</p>
                        @else
                            <p>{{ User::find($order->order->user_id)->name  }}<br>
                                {{ $order->order->street }}, {{ $order->order->ward }}<br>
                                {{ $order->order->municipality }}, {{ $order->order->district }}<br>
                                {{ $order->order->country }}</p>
                        @endif
                    </div>
                    <div class="detail-card">
                        <h4>Billing Address</h4>
                        <p>{{ User::find($order->order->user_id)->name }}<br>
                            {{ $order->order->street }}, {{ $order->order->ward }}<br>
                            {{ $order->order->municipality }}, {{ $order->order->district }}<br>
                            {{ $order->order->country }}</p>
                    </div>
                    {{-- <div class="detail-card">
                        <h4>Payment Method</h4>
                        <p>{{ $order->order->payment_method == 'cod' ? 'Cash On Delivery' : $order->order->payment_method }}</p>
                    </div>

                    <div class="detail-card">
                        <h4>Contanct Info</h4>
                        <p>{{ $order->phone }}</p>
                    </div> --}}
                    <div class="order-actions-detail">
                        <button class="btn btn-secondary btn-block w-[100%]">Print Invoice</button>
                        {{-- @if ($order->order_status == 'pending' || $order->order_status == 'processing')
                            <button id="cancel-order-btn" class="btn btn-primary btn-block">Cancel
                                Order</button>
                        @else
                            <button class="btn btn-block bg-gray-300 text-gray-600"
                                style=" cursor: not-allowed; " disabled>
                                Cancel order
                            </button>
                        @endif --}}
                    </div>
                </aside>
            </div>


        </div>
    </div>
</div>

@endsection
