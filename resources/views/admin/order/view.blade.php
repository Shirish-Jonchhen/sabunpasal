@extends('admin.layouts.layout')
@section('admin_page_title', 'Order - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order {{$order->order_tracking_number}}</h5>
                </div>
                <div class="order-detail-layout">
                    <section class="order-main-details">
                        <div class="order-detail-header">
                            <h2>{{ $order->order_tracking_number }}</h2>
                            @php
                                $statusClass = match ($order->order_status) {
                                    'pending' => 'status-pending',
                                    'processing' => 'status-processing',
                                    'shipped' => 'status-shipped',
                                    'delivered' => 'status-delivered',
                                    'cancelled' => 'status-cancelled',
                                    default => '',
                                };
                            @endphp
                            <span class="order-status rounded {{ $statusClass }}">{{ $order->order_status }}</span>
                        </div>
                        <p class="order-date">Placed on: {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</p>
        
                        <div class="order-items-summary">
                            <h3>Items Ordered</h3>
                            <div class="order-item-list">
                                <!-- Example Item 1 -->
        
                                @foreach ($order->storeOrders as $store_order)
                                    @foreach ($store_order->storeOrederProducts as $product)
                                        <div class="order-summary-item">
                                            <img src="{{ asset('storage/' . $product->variantPrice->variant->images[0]->image_path) }}"
                                                alt="Sparkle All-Purpose Cleaner" class="item-image">
                                            <div class="item-info">
                                                <span class="item-name">{{ $product->variantPrice->variant->product->name }} </span>
                                                <span class="item-sku">Variant: {{ $product->variantPrice->variant->variant_name }}
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
                                @endforeach
        
                            </div>
                        </div>
        
                        <div class="order-totals-summary">
                            <div class="summary-line"><span>Subtotal:</span> <span>NRs. {{ $order->subtotal }}</span></div>
                            <div class="summary-line"><span>Discount:</span> <span>NRs. {{ $order->discount }}</span></div>
                            <div class="summary-line"><span>Shipping:</span> <span>NRs. {{ $order->delivery_charge }}</span></div>
                            <div class="summary-line"><span>Tax (Est.):</span> <span>NRs. {{ $order->tax }}</span></div>
                            <div class="summary-line total"><strong>Grand Total:</strong> <strong>NRs.
                                    {{ $order->total_amount }}</strong></div>
                        </div>
                    </section>
        
                    <aside class="order-sidebar-details">
                        <div class="detail-card">
                            <h4>Shipping Address</h4>
                            @if ($order->delivery_method == 'pickup')
                                <p>Store Pick-Up</p>
                            @else
                                <p>{{ Auth::user()->name }}<br>
                                    {{ $order->street }}, {{ $order->ward }}<br>
                                    {{ $order->municipality }}, {{ $order->district }}<br>
                                    {{ $order->country }}</p>
                            @endif
                        </div>
                        <div class="detail-card">
                            <h4>Billing Address</h4>
                            <p>{{ Auth::user()->name }}<br>
                                {{ $order->street }}, {{ $order->ward }}<br>
                                {{ $order->municipality }}, {{ $order->district }}<br>
                                {{ $order->country }}</p>
                        </div>
                        <div class="detail-card">
                            <h4>Payment Method</h4>
                            <p>{{ $order->payment_method == 'cod' ? 'Cash On Delivery' : $order->payment_method }}</p>
                        </div>
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
