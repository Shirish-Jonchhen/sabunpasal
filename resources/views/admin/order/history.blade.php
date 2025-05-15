@extends('admin.layouts.layout')
@section('admin_page_title', 'Order History - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Orders</h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show">
                            @foreach ($errors->all() as $error)
                                *{{ $error }} <br>
                            @endforeach
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="order-list">
                        <!-- Static Orders Example (Replace with Blade in Laravel) -->
                        <!-- Filter, Sort, and Search Section -->
                        <div style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #dee2e6; border-radius: 0.375rem; background-color: #fff; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                            <!-- Search Bar -->
                            <form method="GET" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center; width: 100%; max-width: 100%;">


                                <input type="text" name="search" placeholder="Search by tracking number..."
                                    value="{{ $search ?? '' }}"
                                    style="width: 25%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);" />
                        
                                <!-- Filter Dropdown -->
                                <select name="status"
                                    style="width: 25%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem;">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ ($status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ ($status ?? '') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ ($status ?? '') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ ($status ?? '') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ ($status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                        
                                <!-- Sort Dropdown -->
                                <select name="sort"
                                    style="width: 25%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem;">
                                    <option value="">Sort By</option>
                                    <option value="price_asc" {{ ($sort ?? '') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ ($sort ?? '') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="date_latest" {{ ($sort ?? '') == 'date_latest' ? 'selected' : '' }}>Date: Latest</option>
                                    <option value="date_oldest" {{ ($sort ?? '') == 'date_oldest' ? 'selected' : '' }}>Date: Oldest</option>
                                </select>
                        
                                <button type="submit"
                                    style="padding: 0.375rem 0.75rem; background-color: #0d6efd; color: white; border: none; border-radius: 0.375rem; cursor: pointer;">
                                    Apply
                                </button>
                        
                                <a href="{{ route('admin.orders') }}"
                                    style="padding: 0.375rem 0.75rem; border: 1px solid #6c757d; color: #6c757d; border-radius: 0.375rem; text-decoration: none; display: inline-block;">
                                    Reset
                                </a>
                            </form>
                        </div>
                        


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
                                            <li> <strong>{{ $store_order->store->store_name }} </strong>
                                                @php
                                                    $storeStatusClass = match ($store_order->status) {
                                                        'pending' => 'status-pending',
                                                        'processing' => 'status-processing',
                                                        'shipped' => 'status-shipped',
                                                        'delivered' => 'status-delivered',
                                                        'cancelled' => 'status-cancelled',
                                                        default => '',
                                                    };
                                                @endphp

                                                <span class="status {{ $storeStatusClass }}">
                                                    Status: {{ $store_order->status }}
                                                </span>

                                                <ol>

                                                    @foreach ($store_order->storeOrederProducts as $product)
                                                        <li>{{ $product->variantPrice->variant->product->name }} |
                                                            {{ $product->variantPrice->variant->variant_name }} |
                                                            {{ $product->variantPrice->variant->size }}
                                                            (x{{ $product->quantity }}
                                                            {{ $product->variantPrice->unit->attribute_value }})
                                                        </li>
                                                    @endforeach
                                                </ol>

                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="order-actions-list">
                                        <a href="{{ route('admin.order.show', $order->order_tracking_number) }}"
                                            class="btn btn-secondary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                        <!-- This message's visibility is controlled by JS based on whether .order-item exists -->
                        {{-- <p id="no-orders-message" style="display: none;">You have no past orders.</p> --}}
                    </div>



                </div>
            </div>
        </div>
    </div>

@endsection
