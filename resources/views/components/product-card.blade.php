<a href="{{ route('product.show', $product->slug) }}" class="product-link">
    <div class="product-card" data-product-id="prod_001">
        @php
            $images = [];
            foreach ($product->variants as $variant) {
                foreach ($variant->images as $image) {
                    $images[] = $image->image_path;
                }
            }
        @endphp

        <div class="product-image-container" data-images='@json($images)'>
            <img loading="lazy" src="{{ asset('storage/' . ($images[0] ?? 'default-image.jpg')) }}"
                alt="{{ $product->name }}" class="product-image">

            @if ($product->is_on_sale)
                <div class="sale-tag">SALE 🔥</div>
            @endif

            <div class="dots-container">
                @foreach ($images as $img)
                    <span class="dot"></span>
                @endforeach
            </div>
        </div>

        <script>
            document.querySelectorAll('.product-image-container').forEach(container => {
                const images = JSON.parse(container.dataset.images);
                if (images.length <= 1) return;

                const imgTag = container.querySelector('.product-image');
                const dots = container.querySelectorAll('.dot');
                let index = 0;

                function updateDots(activeIndex) {
                    dots.forEach((dot, i) => dot.classList.toggle('active', i === activeIndex));
                }

                updateDots(index);

                function nextSlide() {
                    const nextIndex = (index + 1) % images.length;

                    // Fade out
                    imgTag.style.opacity = 0;

                    setTimeout(() => {
                        // Change image
                        imgTag.src = `/storage/${images[nextIndex]}`;
                        index = nextIndex;
                        updateDots(index);

                        
                        // Fade in
                        imgTag.style.opacity = 1;

                        // Next slide after 2 or 3 seconds randomly
                        setTimeout(nextSlide, 2500);
                    }, 600); // match transition duration
                }

                nextSlide();
            });
        </script>



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

                @if ($lowestOldPrice == $highestOldPrice || $lowestOldPrice == '0.00')
                    NRs.{{ $highestOldPrice }}
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