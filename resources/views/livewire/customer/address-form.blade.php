<div class="checkout-layout">
    <div class="checkout-form">
        <h2>Shipping Information</h2>
        <form id="checkout-form" action="{{ route('user.create.order') }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value='{{ Auth::user()->name }}' readonly required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value='{{ Auth::user()->email }}' readonly required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="number" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Street Address</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="city">District</label>
                    {{-- <input type="text" id="district" name="district" required> --}}
                    <select id="district" name="district" class="form-select mb-2" wire:model.live = 'district_id'
                        required>
                        <option value="" selected>Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="state">Municipality</label>
                    {{-- <input type="text" id="municipality" name="municipality" required> --}}
                    <select id="municipality" name="municipality" class="form-select mb-2"
                        wire:model.live = 'municipality_id' required>
                        <option value="" selected>Select Municipality</option>
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->id }}">{{ $municipality->municipality_name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="zip">Ward</label>
                    {{-- <input type="text" id="ward" name="ward" required> --}}
                    <select id="ward" name="ward" class="form-select mb-2" wire:model.live = 'ward_id' required>
                        <option value="" selected>Select Municipality</option>

                        @foreach ($wards as $ward)
                            <option value="{{ $ward->id }}">{{ $ward->ward_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" value="Nepal" readonly required>
            </div>
            <div class="form-group">
                <label for="country">Note</label>
                <textarea type="text" id="note" name="note" placeholder="Eg, Landmarks, Special Instructions"></textarea>
                </textarea>
            </div>
            <h2>Payment Method</h2>
            <div class="form-group" style="display: flex; flex-direction: row;">
                <label>
                    <input type="radio" name="payment_method" value="cod" checked>
                    Cash on Delivery
                </label>
            </div>

            <h2>Shipping Method</h2>
            <div class="form-group" style="display: flex; flex-direction: row;">
                <label class="shipping-method">
                    <input type="radio" name="shipping_method" value="delivery" wire:model.live="shipping_method">
                    Delivery
                </label>
            
                <label class="shipping-method" style="margin-left: 10px;">
                    <input type="radio" name="shipping_method" value="pickup" wire:model.live="shipping_method">
                    Store Pickup
                </label>
            </div>

            <input type="hidden" name="delivery_charge" value="{{ $delivery_charge }}" >


            <button type="submit" class="btn btn-primary btn-block">Place Order</button>
        </form>
    </div>

    <div class="order-summary">
        <h2>Order Summary</h2>
        <div id="summary-items">
            @foreach ($cartItems as $item)
                <div class="summary-item">
                    <span class="item-name">
                        {{ $item->variantPrice->variant->product->name }} <br>
                        <small>{{ $item->variantPrice->variant->variant_name }}
                            {{ $item->variantPrice->variant->size }}</small>
                    </span>
                    <span class="item-qty">x{{ $item->quantity }}</span>
                    <span class="item-old-price">NRs.{{ $item->variantPrice->old_price * $item->quantity }}</span>
                    <span class="item-price">NRs.{{ $item->variantPrice->price * $item->quantity }}</span>
                </div>
            @endforeach
        </div>
        <div class="summary-sub-total">
            <span>Sub-Total:</span>
            <strong id="summary-sub-total-amount">NRs. {{ $subtotal }}</strong>
        </div>

        <div class="summary-tax">
            <span>Tax Amount:</span>
            <strong id="summary-tax-amount">NRs. {{ $totalTax }}</strong>
        </div>

        <div class="summary-tax">
            <span>Delivery Fees:</span>
            <strong id="summary-tax-amount">NRs. {{ $delivery_charge }}</strong>
        </div>


        <div class
        ="summary-total">
            <span>Total:</span>
            <strong id="summary-total-amount">NRs. {{ $subtotal + $totalTax + $delivery_charge }}</strong>
        </div>
    </div>
</div>
