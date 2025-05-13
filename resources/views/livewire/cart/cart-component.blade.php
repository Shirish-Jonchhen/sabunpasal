<div>
    <style>
        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        .modal-actions {
            margin-top: 20px;
        }

        .modal button {
            margin: 5px;
        }
    </style>

    {{-- The best athlete wants his opponent at his best. --}}
    <div class="cart-container">
        <div class="cart-items">
            @if ($cartItems->isEmpty())
                <p id="empty-cart-message"
                    class="text-center text-xl font-semibold text-red-600 bg-red-100 p-4 rounded-lg border border-red-300 shadow-md">
                    Your cart is empty.
                </p>
            @else
                @foreach ($cartItems as $item)
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="{{ asset('storage/' . $item->variantPrice->variant->images[0]->image_path) }}"
                                alt="{{ $item->variantPrice->variant->product->name }}" class="cart-item-image">
                        </div>
                        <div class="cart-item-info">
                            <h4>{{ $item->variantPrice->variant->product->name }}</h4>
                            <span class="old-price"> NRs.{{ $item->variantPrice->old_price }}</span>
                            <span class="price"> NRs.{{ $item->variantPrice->price }}</span>
                        </div>
                        <div class="cart-item-quantity">
                            <button class="quantity-decrease" title="Decrease quantity"
                                aria-label="Decrease quantity of Sparkle All-Purpose Cleaner"
                                wire:click='subtractQuantity({{ $item->id }})'>-</button>
                            <input type="number" value="{{ $item->quantity }}" min="1" class="quantity-input"
                                aria-label="Quantity for Sparkle All-Purpose Cleaner" readonly>
                            <button class="quantity-increase" title="Increase quantity"
                                aria-label="Increase quantity of Sparkle All-Purpose Cleaner"
                                wire:click='addQuantity({{ $item->id }})'>+</button>
                        </div>
                        <div class="cart-item-subtotal">
                            <span>NRs.{{ $item->variantPrice->price * $item->quantity }}</span>
                        </div>
                        <div class="cart-item-remove">
                            <button class="remove-from-cart-button" title="Remove item"
                                aria-label="Remove {{ $item->variantPrice->variant->product->name }} from cart"
                                onclick="confirmRemoveItem({{ $item->id }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif



            <!-- End Static Examples -->

        </div>

        <div class="cart-summary"> <!-- JS controls visibility and values -->
            <h3>Cart Summary</h3>
            <div class="summary-row">
                <span>Subtotal:</span>
                <span id="cart-subtotal">{{ $subtotalPrice }}</span> <!-- JS updates this -->
            </div>
            <div class="summary-row">
                <span>Discount:</span>
                <span id="cart-subtotal">{{ $totalDiscount }}</span> <!-- JS updates this -->
            </div>
            <div class="summary-row">
                <span>Tax:</span>
                <span id="cart-subtotal">{{ $totalTax }}</span> <!-- JS updates this -->
            </div>

            <div class="summary-row total">
                <span>Total:</span>
                <span id="cart-total">NRs. {{ $totalPrice }}</span> <!-- JS updates this -->
            </div>
            <div class="cart-actions">
                <button class="btn btn-danger" id="clear-cart-button">Clear Cart</button>
                <!-- Link to checkout page -->
                <a href="{{ route('user.checkout') }}" class="btn btn-secondary" id="checkout-button">Proceed to Checkout</a>
            </div>
        </div>
    </div>


    {{-- Confirmation modal --}}
    <div id="confirmation-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <h4 id="modal-title">Are you sure?</h4>
            <p id="modal-message">This action cannot be undone.</p>
            <div class="modal-actions">
                <button id="confirm-action" class="btn btn-danger">Yes</button>
                <button id="cancel-action" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let itemToRemove = null;
        let clearCartFlag = false;

        function confirmRemoveItem(itemId) {
            itemToRemove = itemId;
            clearCartFlag = false;

            document.getElementById('modal-title').innerText = "Remove Item from Cart?";
            document.getElementById('modal-message').innerText = "Are you sure you want to remove this item?";
            document.getElementById('confirmation-modal').style.display = 'flex';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const clearCartButton = document.getElementById('clear-cart-button');
            const confirmationModal = document.getElementById('confirmation-modal');
            const confirmActionButton = document.getElementById('confirm-action');
            const cancelActionButton = document.getElementById('cancel-action');

            // Clear cart setup
            clearCartButton.addEventListener('click', function () {
                clearCartFlag = true;
                itemToRemove = null;

                document.getElementById('modal-title').innerText = "Clear Cart?";
                document.getElementById('modal-message').innerText = "Are you sure you want to clear your cart?";
                confirmationModal.style.display = 'flex';
            });

            // Confirm action
            confirmActionButton.addEventListener('click', function () {
                if (clearCartFlag) {
                    @this.call('clearCart');
                } else if (itemToRemove !== null) {
                    @this.call('removeItem', itemToRemove);
                }

                confirmationModal.style.display = 'none';
                itemToRemove = null;
                clearCartFlag = false;
            });

            // Cancel action
            cancelActionButton.addEventListener('click', function () {
                confirmationModal.style.display = 'none';
                itemToRemove = null;
                clearCartFlag = false;
            });
        });
    </script>

</div>