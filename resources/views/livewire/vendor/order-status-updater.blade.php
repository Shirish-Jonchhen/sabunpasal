<div class="flex flex-col gap-2">

    {{-- Payment Status Dropdown --}}
{{-- <label for="payment-status">Payment Status</label> --}}
<select wire:model.live="spaymentStatus" class="order-status rounded {{ paymentStatusClass($spaymentStatus) }}">
    <option value="unpaid">Unpaid</option>
    <option value="partial">Partial</option>
    <option value="paid">Paid</option>
    <option value="refunded">Refunded</option>
</select>
{{-- Order Status Dropdown --}}
{{-- <label for="order-status">Order Status</label> --}}
<select wire:model.live="sorderStatus" class="order-status rounded {{ statusClass($sorderStatus) }}">
    <option value="pending">Pending</option>
    <option value="processing">Processing</option>
    <option value="shipped">Shipped</option>
    <option value="delivered">Delivered</option>
    <option value="cancelled">Cancelled</option>
    <option value="returned">Returned</option>
</select>



{{-- @if (session()->has('message'))
    <span class="text-green-500 text-sm">{{ session('message') }}</span>
@endif --}}
</div>

@php
function statusClass($status) {
return match($status) {
    'pending' => 'status-pending',
    'processing' => 'status-processing',
    'shipped' => 'status-shipped',
    'delivered' => 'status-delivered',
    'cancelled' => 'status-cancelled',
    'returned' => 'status-cancelled',
    default => '',
};
}

function paymentStatusClass($status) {
return match($status) {
    'unpaid' => 'status-pending',
    'partial' => 'status-processing',
    'paid' => 'status-delivered',
    'refunded' => 'status-cancelled',
    default => '',
};
}
@endphp