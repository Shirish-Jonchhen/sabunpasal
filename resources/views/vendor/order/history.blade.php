@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Order History - Vendor Panel')
@section('vendor_layout')
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
                        <div
                            style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #dee2e6; border-radius: 0.375rem; background-color: #fff; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                            <!-- Search Bar -->
                            <form method="GET" action='{{ route('vendor.orders') }}'
                                style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center; width: 100%; max-width: 100%;">


                                <input type="text" name="search" placeholder="Search by tracking number..."
                                    value="{{ $search ?? '' }}"
                                    style="width: 20%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);" />

                                <!-- Filter Dropdown -->
                                <select name="status"
                                    style="width: 20%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem;">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ ($status ?? '') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="processing" {{ ($status ?? '') == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="shipped" {{ ($status ?? '') == 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="delivered" {{ ($status ?? '') == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                    <option value="cancelled" {{ ($status ?? '') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>

                                <!-- Filter Dropdown -->
                                <select name="admin_status"
                                    style="width: 20%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem;">
                                    <option value="">Admin Status</option>
                                    <option value="pending" {{ ($adminStatus ?? '') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="processing"
                                        {{ ($adminStatus ?? '') == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="shipped" {{ ($adminStatus ?? '') == 'shipped' ? 'selected' : '' }}>
                                        Shipped
                                    </option>
                                    <option value="delivered" {{ ($adminStatus ?? '') == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                    <option value="cancelled"
                                        {{ ($staadminStatusus ?? '') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>


                                <!-- Sort Dropdown -->
                                <select name="sort"
                                    style="width: 20%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem;">
                                    <option value="">Sort By</option>
                                    <option value="price_asc" {{ ($sort ?? '') == 'price_asc' ? 'selected' : '' }}>Price:
                                        Low to High</option>
                                    <option value="price_desc" {{ ($sort ?? '') == 'price_desc' ? 'selected' : '' }}>Price:
                                        High to Low</option>
                                    <option value="date_latest" {{ ($sort ?? '') == 'date_latest' ? 'selected' : '' }}>
                                        Date: Latest</option>
                                    <option value="date_oldest" {{ ($sort ?? '') == 'date_oldest' ? 'selected' : '' }}>
                                        Date: Oldest</option>
                                </select>



                                <button type="submit"
                                    style="padding: 0.375rem 0.75rem; background-color: #0d6efd; color: white; border: none; border-radius: 0.375rem; cursor: pointer;">
                                    Apply
                                </button>

                                <a href="{{ route('vendor.orders') }}"
                                    style="padding: 0.375rem 0.75rem; border: 1px solid #6c757d; color: #6c757d; border-radius: 0.375rem; text-decoration: none; display: inline-block;">
                                    Reset
                                </a>
                            </form>
                        </div>



                        @foreach ($orders as $storeOrder)
                            <div class="order-item">
                                <div class="order-header">
                                    <h3>{{ $storeOrder->order->order_tracking_number ?? 'N/A' }}</h3>
                                    <span>Date:
                                        {{ \Carbon\Carbon::parse($storeOrder->created_at)->format('F j, Y') }}</span>
                                    <span>Total: NRs. {{ $storeOrder->total }}</span>
                                    @php
                                        $statusClass = match ($storeOrder->status) {
                                            'pending' => 'status-pending',
                                            'processing' => 'status-processing',
                                            'shipped' => 'status-shipped',
                                            'delivered' => 'status-delivered',
                                            'cancelled' => 'status-cancelled',
                                            'returned' => 'status-cancelled',
                                            default => '',
                                        };
                                    @endphp

                                    <span class="status {{ $statusClass }}">
                                        Store-Status: {{ $storeOrder->status }}
                                    </span>


                                    @php
                                        $statusClass = match ($storeOrder->order->order_status ?? 'N/A') {
                                            'pending' => 'status-pending',
                                            'processing' => 'status-processing',
                                            'shipped' => 'status-shipped',
                                            'delivered' => 'status-delivered',
                                            'cancelled' => 'status-cancelled',
                                            'returned' => 'status-cancelled',
                                            default => '',
                                        };
                                    @endphp

                                    <span class="status {{ $statusClass }}">
                                        Admin-Status: {{ $storeOrder->order->order_status ?? 'N/A' }}
                                    </span>


                                </div>
                                <div class="order-details">
                                    <h4>Items:</h4>
                                    <ul>


                                        @foreach ($storeOrder->storeOrederProducts as $product)
                                            <li>{{ $product->variantPrice->variant->product->name ?? 'N/A' }} |
                                                {{ $product->variantPrice->variant->variant_name ?? 'N/A' }} |
                                                {{ $product->variantPrice->variant->size ?? 'N/A' }}
                                                (x{{ $product->quantity }}
                                                {{ $product->variantPrice->unit->attribute_value }})
                                            </li>
                                        @endforeach
                                        {{-- </ol>

                                            </li>
                                        @endforeach --}}

                                    </ul>
                                    @if ($storeOrder->order->order_status == 'processing')
                                        <div class="order-actions">

                                            <a href="{{ route('vendor.order.show', $storeOrder->order->order_tracking_number) }}"
                                                class="btn btn-secondary btn-sm">View Details</a>

                                        </div>
                                    @endif
                                    {{-- <div class="order-actions-list">
                                        <a href="{{ route('vendor.order.show', $storeOrder->order->order_tracking_number) }}"
                                            class="btn btn-secondary btn-sm">View Details</a>
                                    </div> --}}
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
