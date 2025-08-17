@extends('delivery.layouts.layout')
@section('delivery_page_title', 'Completed Deliveries - Delivery Panel')
@section('delivery_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Completed Deliveries</h5>
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

                    {{-- - - --}}
                    {{-- Search and Filter Section --}}
                    <div class="mb-4 p-3 border rounded bg-light">
                        <form method="GET" class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
                            <input type="text" name="search" placeholder="Search by tracking number..."
                                value="{{ $searchQuery ?? '' }}" class="form-control form-control-sm flex-grow-1" />

                            <select name="municipality" class="form-select form-select-sm flex-grow-1">
                                <option value="">Municipality</option>
                                @foreach ($municipalities as $m)
                                    <option value="{{ $m->municipality_name }}"
                                        {{ ($municipalityQuery ?? '') == $m->municipality_name ? 'selected' : '' }}>
                                        {{ $m->municipality_name }}
                                    </option>
                                @endforeach

                            </select>

                            <select name="sort" class="form-select form-select-sm flex-grow-1">
                                <option value="">Sort By</option>
                                <option value="price_asc" {{ ($sortQuery ?? '') == 'price_asc' ? 'selected' : '' }}>Price:
                                    Low
                                    to High</option>
                                <option value="price_desc" {{ ($sortQuery ?? '') == 'price_desc' ? 'selected' : '' }}>Price:
                                    High to Low</option>
                                <option value="date_latest" {{ ($sortQuery ?? '') == 'date_latest' ? 'selected' : '' }}>
                                    Date:
                                    Latest</option>
                                <option value="date_oldest" {{ ($sortQuery ?? '') == 'date_oldest' ? 'selected' : '' }}>
                                    Date:
                                    Oldest</option>
                            </select>

                            <button type="submit" class="btn btn-primary btn-sm flex-grow-1">Apply</button>
                            <a href="{{ route('delivery.active') }}" class="btn btn-secondary btn-sm flex-grow-1">Reset</a>
                        </form>
                    </div>


                    <div class="order-cards-container d-grid gap-3">
                        @forelse($orders as $order)
                            <div class="card shadow-sm border">
                                <div
                                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2">
                                    <h6 class="mb-0 text-white">#{{ $order->order_tracking_number }}</h6>


                                    <span class="badge bg-light text-primary fs-6">
                                        {{ $order->delivery_collection_id ? 'collected' : 'Not Collected' }}</span>

                                    <span class="badge bg-light text-primary fs-6">
                                        {{ $order->delivery_payout_id ? 'Paid' : 'Not Paid' }}</span>


                                    <span class="badge bg-light text-primary fs-6">My Pay:
                                        {{ number_format($order->delivery_guy_commission, 2) }}</span>


                                    <span class="badge bg-light text-primary fs-6">NRs.
                                        {{ number_format($order->total_amount, 2) }}</span>


                                </div>
                                <div class="card-body">
                                    <div
                                        class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-3">
                                        <div class="mb-2 mb-md-0">
                                            <p class="mb-0 text-muted small">Date:
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</p>
                                            <p class="mb-0 text-muted small">Customer:
                                                <strong>{{ $order->user->name ?? 'N/A' }}</strong>
                                            </p>
                                            <p class="mb-0 text-muted small">Delivery By:
                                                <strong>{{ $order->DeliveryPerson->name ?? 'Not Assigned' }}</strong>
                                            </p>
                                            <p class="mb-0 text-muted small">Delivery At:
                                                <strong>{{ $order->delivered_at ?? 'Not Delivered' }}</strong>
                                            </p>
                                        </div>
                                        <div class="text-md-end">
                                            @php
                                                $orderStatusClass = match ($order->order_status) {
                                                    'pending' => 'bg-warning text-dark',
                                                    'processing' => 'bg-info',
                                                    'shipped' => 'bg-primary',
                                                    'delivered' => 'bg-success',
                                                    'cancelled', 'returned' => 'bg-danger',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span
                                                class="badge {{ $orderStatusClass }} mb-1 p-2">{{ ucfirst($order->order_status) }}</span>

                                            @php
                                                $paymentStatusClass = match ($order->payment_status) {
                                                    'unpaid' => 'bg-danger',
                                                    'partial' => 'bg-warning text-dark',
                                                    'paid' => 'bg-success',
                                                    'refunded' => 'bg-secondary',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span
                                                class="badge {{ $paymentStatusClass }} p-2">{{ ucfirst($order->payment_status) }}</span>
                                        </div>
                                    </div>

                                    {{-- Delivery Address & Navigate Button --}}
                                    <h6 class="text-primary mt-2">Delivery Location:</h6>
                                    <p class="mb-2 small">
                                        @if ($order->place_name)
                                            {{ $order->place_name }}<br>
                                        @endif
                                        @if ($order->ward)
                                            Ward: {{ $order->ward }}<br>
                                        @endif
                                        Municipality: {{ $order->municipality }}<br>
                                        @if ($order->district)
                                            District: {{ $order->district }}<br>
                                        @endif
                                        Country: {{ $order->country }}

                                    </p>
                                    <p class="mb-2 small">
                                        Phone: <a href="tel:{{ $order->phone ?? '' }}"
                                            class="text-decoration-none">{{ $order->phone ?? 'N/A' }}</a>
                                    </p>
                                    @if ($order->notes)
                                        <p class="mb-2 small text-danger"><strong>Order Notes:</strong> {{ $order->notes }}
                                        </p>
                                    @endif

                                    @php
                                        $fullAddressForMap = implode(
                                            ', ',
                                            array_filter([
                                                $order->place_name,
                                                $order->ward ? 'Ward: ' . $order->ward : null,
                                                $order->municipality,
                                                $order->district,
                                                $order->country,
                                            ]),
                                        );
                                    @endphp
                                    {{-- <a href="http://maps.google.com/?q={{ urlencode($fullAddressForMap) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm w-100 mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i> Navigate to Location
                                    </a> --}}

                                    {{-- Collapsible Order Items --}}
                                    <p>
                                        <button class="btn btn-link btn-sm p-0" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#orderItems{{ $order->id }}" aria-expanded="false"
                                            aria-controls="orderItems{{ $order->id }}">
                                            View Order Items <i class="fas fa-chevron-down ms-1"></i>
                                        </button>
                                    </p>
                                    <div class="collapse" id="orderItems{{ $order->id }}">
                                        <div class="card card-body bg-light p-2">
                                            <h6>Items:</h6>
                                            <ul class="list-unstyled mb-0 small">
                                                @forelse ($order->storeOrders as $store_order)
                                                    <li>
                                                        <strong>{{ $store_order->store->store_name ?? 'Unknown Store' }}</strong>
                                                        <ol class="mb-0">
                                                            @foreach ($store_order->storeOrederProducts as $product)
                                                                <li>
                                                                    {{ $product->variantPrice->variant->product->name ?? 'N/A' }}
                                                                    |
                                                                    {{ $product->variantPrice->variant->variant_name ?? 'N/A' }}
                                                                    |
                                                                    {{ $product->variantPrice->variant->size ?? 'N/A' }}
                                                                    (x{{ $product->quantity ?? '0' }}
                                                                    {{ $product->variantPrice->unit->attribute_value ?? '' }})
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    </li>
                                                @empty
                                                    <li>No items found for this order.</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Status Update Dropdowns (Display Only) --}}
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <hr class="my-3">
                                        <div class="d-flex flex-column gap-2">

                                            <div class="d-flex align-items-center gap-2">
                                                <label for="orderStatus{{ $order->id }}"
                                                    class="form-label mb-0 small text-muted w-25">Order Status:</label>
                                                <select disabled id="orderStatus{{ $order->id }}"
                                                    class="form-select form-select-sm flex-grow-1">
                                                    @foreach ($orderStatuses as $statusOption)
                                                        <option value="{{ $statusOption }}"
                                                            {{ $order->order_status == $statusOption ? 'selected' : '' }}>
                                                            {{ ucfirst($statusOption) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="d-flex align-items-center gap-2">
                                                <label for="paymentStatus{{ $order->id }}"
                                                    class="form-label mb-0 small text-muted w-25">Payment Status:</label>
                                                <select disabled id="paymentStatus{{ $order->id }}"
                                                    class="form-select form-select-sm flex-grow-1 ">
                                                    @foreach ($paymentStatuses as $statusOption)
                                                        <option value="{{ $statusOption }}"
                                                            {{ $order->payment_status == $statusOption ? 'selected' : '' }}>
                                                            {{ ucfirst($statusOption) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info text-center mt-3" role="alert">
                                No completed deliveries found.
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $orders->links('vendor.pagination.default') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
