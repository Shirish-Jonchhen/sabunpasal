@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Orders')

@section('user_content')

    <div class="container page-content">
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li aria-current="page">Orders</li>
            </ol>
        </nav>
        <h1>Order History</h1>

        <div class="order-list">
            <!-- Static Orders Example (Replace with Blade in Laravel) -->

            @foreach ($orders as $order)
                <div class="order-item">
                    <div class="order-header">
                        <h3>{{ $order->order_tracking_number }}</h3>
                        <span>Date: {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</span>
                        <span>Total: NRs. {{ $order->total_amount }}</span>
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
                    
                    <span class="status {{ $statusClass }}">
                        Status: {{ $order->order_status }}
                    </span>
                    </div>
                    <div class="order-details">
                        <h4>Items:</h4>
                        <ul>
                            @foreach ($order->storeOrders as $store_order)
                                @foreach ($store_order->storeOrederProducts as $product)
                                    <li>{{ $product->variantPrice->variant->product->name }} |
                                        {{ $product->variantPrice->variant->variant_name }} |
                                        {{ $product->variantPrice->variant->size }} (x{{ $product->quantity }}
                                        {{ $product->variantPrice->unit->attribute_value }})</li>
                                @endforeach
                            @endforeach

                        </ul>
                        <div class="order-actions-list">
                            <a href="{{ route('user.show.order', $order->order_tracking_number) }}" class="btn btn-secondary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach



            <!-- This message's visibility is controlled by JS based on whether .order-item exists -->
            {{-- <p id="no-orders-message" style="display: none;">You have no past orders.</p> --}}
        </div>
    </div>
@endsection
