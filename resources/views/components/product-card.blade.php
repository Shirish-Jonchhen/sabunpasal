<a href="{{ route('product.show', $product->slug) }}" class="product-link">
    <div class="product-card" data-product-id="prod_001">
        <div class="product-image-container">
            <img src="{{ asset('storage/' . $product->variants->first()->images->first()?->image_path) }}"
                alt="Sparkle All-Purpose Cleaner" class="product-image ">
            @if ($product->is_on_sale)
                <div class="sale-tag">
                    SALE 🔥
                </div>
            @endif

        </div>
        <div class="product-info">
            <span class="product-category">{{ $product->category->category_name }} -
                {{ $product->subcategory->subcategory_name }}</span>
            <h3 class="product-name" title="Sparkle All-Purpose Cleaner">
                {{ $product->name }}
            </h3>
            <h6 class="" title="Sparkle All-Purpose Cleaner">
                <i class="fas fa-star rated" style="color: #F0A800;"></i>
                {{ $averageReviews }} ({{ $product->reviews->count() }})
            </h6>
            <p class="product-old-price">
                @php
                    $lowestOldPrice =
                        $product->variants->flatMap->prices->sortBy('old_price')->first()
                            ->old_price ?? '0.00';
                    $highestOldPrice =
                        $product->variants->flatMap->prices->sortByDesc('old_price')->first()
                            ->old_price ?? '0.00';
                @endphp

                @if ($lowestOldPrice == $highestOldPrice)
                    NRs.{{ $lowestOldPrice }}
                @else
                    NRs.{{ $lowestOldPrice }} - NRs.{{ $highestOldPrice }}
                @endif
            </p>
            <p class="product-price">
                @php
                    $lowestPrice =
                        $product->variants->flatMap->prices->sortBy('price')->first()->price ??
                        '0.00';
                    $highestPrice =
                        $product->variants->flatMap->prices->sortByDesc('price')->first()->price ??
                        '0.00';
                @endphp

                @if ($lowestPrice == $highestPrice)
                    NRs.{{ $lowestPrice }}
                @else
                    NRs.{{ $lowestPrice }} - NRs.{{ $highestPrice }}
                @endif
            </p>
        </div>

        {{-- <div class="product-actions">
            <button class="btn btn-primary add-to-cart-button">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </div> --}}
    </div>
</a>