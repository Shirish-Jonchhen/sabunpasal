@extends('delivery.layouts.layout')
@section('delivery_page_title', 'Active Deliveries - Delivery Panel')
@section('delivery_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Active Deliveries</h5>
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

                        <div
                            style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #dee2e6; border-radius: 0.375rem; background-color: #fff; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                            <!-- Search Bar -->
                            <form method="GET"
                                style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center; width: 100%; max-width: 100%;">


                                <input type="text" name="search" placeholder="Search by tracking number..."
                                    value="{{ $search ?? '' }}"
                                    style="width: 20%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);" />

                                <!-- Filter payment Dropdown -->
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
                                <select name="payment_status"
                                    style="width: 20%; padding: 0.375rem 0.75rem; border: 1px solid #ccc; border-radius: 0.375rem;">
                                    <option value="">Payment Status</option>
                                    <option value="unpaid" {{ ($paymentStatus ?? '') == 'unpaid' ? 'selected' : '' }}>Unpaid
                                    </option>
                                    <option value="partial" {{ ($paymentStatus ?? '') == 'partial' ? 'selected' : '' }}>
                                        Partially Paid</option>
                                    <option value="paid" {{ ($paymentStatus ?? '') == 'paid' ? 'selected' : '' }}>paid
                                    </option>
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

                                <a href="{{ route('admin.orders') }}"
                                    style="padding: 0.375rem 0.75rem; border: 1px solid #6c757d; color: #6c757d; border-radius: 0.375rem; text-decoration: none; display: inline-block;">
                                    Reset
                                </a>
                            </form>
                        </div>



                        {{-- @foreach ($orders as $order) --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Delivery Address</th>
                                        <th>Total Amount</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>Delivery Person</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_tracking_number }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</td>
                                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                                            <td>
                                                {{-- Full Delivery Address --}}
                                                @if($order->place_name){{ $order->place_name }}<br>@endif
                                                @if($order->ward)Ward: {{ $order->ward }}<br>@endif
                                                Municipality: {{ $order->municipality }}<br>
                                                @if($order->district)District: {{ $order->district }}<br>@endif
                                                Country: {{ $order->country }}
                                                @if($order->additional_info)(Additional Info: {{ $order->additional_info }})@endif
                                            </td>
                                            <td>NRs. {{ number_format($order->total_amount, 2) }}</td>
                        
                                            {{-- Order Status Dropdown (Display Only) --}}
                                            <td>
                                                {{-- No form tags or onchange event --}}
                                                <select class="form-select" disabled> {{-- 'disabled' makes it non-interactive for display --}}
                                                    @foreach($orderStatuses as $status)
                                                        <option value="{{ $status }}" {{ $order->order_status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                        
                                            {{-- Payment Status Dropdown (Display Only) --}}
                                            <td>
                                                {{-- No form tags or onchange event --}}
                                                <select class="form-select" disabled> {{-- 'disabled' makes it non-interactive for display --}}
                                                    @foreach($paymentStatuses as $status)
                                                        <option value="{{ $status }}" {{ $order->payment_status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>{{ $order->deliveryPerson->name ?? 'Not Assigned' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- No JavaScript required --}}
                        
                        <style>
                            /* Basic styling for status spans (if you still use them elsewhere) */
                            .status {
                                padding: 4px 8px;
                                border-radius: 4px;
                                font-size: 0.8em;
                                white-space: nowrap;
                                display: inline-block;
                            }
                            .status-pending { background-color: #ffe0b2; color: #fb8c00; }
                            .status-processing { background-color: #bbdefb; color: #2196f3; }
                            .status-shipped { background-color: #c8e6c9; color: #43a047; }
                            .status-delivered { background-color: #d1c4e9; color: #673ab7; }
                            .status-cancelled, .status-refunded, .status-returned { background-color: #ffcdd2; color: #e53935; }
                        </style>
                        
                        {{-- @endforeach --}}



                        <!-- This message's visibility is controlled by JS based on whether .order-item exists -->
                        {{-- <p id="no-orders-message" style="display: none;">You have no past orders.</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
