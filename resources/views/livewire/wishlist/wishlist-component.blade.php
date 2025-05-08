<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="wishlist-grid" >
        @if ($wishlistItems->isEmpty())
            <p id="empty-wishlist-message" class="text-center text-xl font-semibold text-red-600 bg-red-100 p-4 rounded-lg border border-red-300 shadow-md">
                Your wishlist is empty.
            </p>
        @else
            @foreach ($wishlistItems as $item)


            <a href="{{ route('product.show', $item->product->slug) }}" class="product-link">
                <div class="product-card" data-product-id="prod_003">
                    <div class="product-image-container">
                        <img src="{{ asset('storage/' . $item->product->variants->first()->images->first()?->image_path) }}"
                            alt="Scrub Free Kitchen Degreaser" class="product-image">
                        @if ($item->product->is_on_sale)
                            <div class="sale-tag">
                                SALE 🔥
                            </div>
                        @endif

                        {{-- <button class="wishlist-button active" title="Remove from Wishlist" wire.click="removeFromWishlist({{ $item->id }})" onclick="event.stopPropagation();">
                            <i class="fas fa-heart"></i>
                        </button> --}}
                    </div>
                    <div class="product-info">
                        <span class="product-category">{{ $item->product->category->category_name }} -
                            {{ $item->product->subcategory->subcategory_name }}</span>
                        <h3 class="product-name" title="Scrub Free Kitchen Degreaser">{{ $item->product->name }}
                        </h3>
                        <p class="product-old-price">
                            @php
                                $lowestOldPrice =
                                $item->product->variants->flatMap->prices->sortBy('old_price')->first()
                                        ->old_price ?? '0.00';
                                $highestOldPrice =
                                $item->product->variants->flatMap->prices
                                        ->sortByDesc('old_price')
                                        ->first()->old_price ?? '0.00';
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
                                $item->product->variants->flatMap->prices->sortBy('price')->first()
                                        ->price ?? '0.00';
                                $highestPrice =
                                $item->product->variants->flatMap->prices->sortByDesc('price')->first()
                                        ->price ?? '0.00';
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



                {{-- <div class="product-card" data-product-id="{{ $item->id }}">
                    <div class="product-image-container">
                        <img src="{{ asset('storage/' . $item->variantPrice->variant->images[0]->image_path) }}" alt="{{ $item->variantPrice->variant->product->name }}" class="product-image">
                        <button class="wishlist-button active" title="Remove from Wishlist" aria-label="Remove {{ $item->variantPrice->variant->product->name }} from Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">{{ $item->variantPrice->variant->product->category->name }}</span>
                        <h3 class="product-name" title="{{ $item->variantPrice->variant->product->name }}">{{ $item->variantPrice->variant->product->name }}</h3>
                        <p class="product-price">NRs.{{ $item->variantPrice->price }}</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button class="btn btn-danger btn-sm remove-wishlist-button" data-product-id="{{ $item->id }}" style="margin-top: 0.5rem;">
                            <i class="fas fa-times"></i> Remove
                        </button>
                    </div>
                </div> --}}
            @endforeach
            
        @endif
   </div>
</div>
