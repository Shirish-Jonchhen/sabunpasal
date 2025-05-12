<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="wishlist-grid">
        @if ($wishlistItems->isEmpty())
            <p id="empty-wishlist-message"
                class="text-center text-xl font-semibold text-red-600 bg-red-100 p-4 rounded-lg border border-red-300 shadow-md">
                Your wishlist is empty.
            </p>
        @else
            @foreach ($wishlistItems as $item)

                <x-product-card :product="$item->product" />




                {{-- <div class="product-card" data-product-id="{{ $item->id }}">
                    <div class="product-image-container">
                        <img src="{{ asset('storage/' . $item->variantPrice->variant->images[0]->image_path) }}"
                            alt="{{ $item->variantPrice->variant->product->name }}" class="product-image">
                        <button class="wishlist-button active" title="Remove from Wishlist"
                            aria-label="Remove {{ $item->variantPrice->variant->product->name }} from Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">{{ $item->variantPrice->variant->product->category->name }}</span>
                        <h3 class="product-name" title="{{ $item->variantPrice->variant->product->name }}">{{
                            $item->variantPrice->variant->product->name }}</h3>
                        <p class="product-price">NRs.{{ $item->variantPrice->price }}</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button class="btn btn-danger btn-sm remove-wishlist-button" data-product-id="{{ $item->id }}"
                            style="margin-top: 0.5rem;">
                            <i class="fas fa-times"></i> Remove
                        </button>
                    </div>
                </div> --}}
            @endforeach

        @endif
    </div>
</div>