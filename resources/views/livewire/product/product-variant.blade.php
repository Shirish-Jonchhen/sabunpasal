<div>
    <div>
        <!-- Conditional Alert -->
        @if (session()->has('message'))
            <div id="success-alert" class="alert alert-success fade-in show" style="position: relative;">
                {{ session('message') }}
                <button wire:click="closeAlert"
                    style="position: absolute; top: 0.5rem; right: 0.75rem; background: none; border: none; font-size: 1.25rem; cursor: pointer;">&times;</button>
            </div>
        @endif
    </div>
    <section class="product-detail-layout">
        <!-- Product Image Gallery -->
        <div class="product-image-gallery">
            <div class="main-image">
                <!-- Display Main Image of the selected variant -->
                @if ($variantImages->isEmpty())
                    <img src="default-image.jpg" alt="Default Image" id="main-product-image">
                @else
                    <img src="{{ asset('storage/' . $variantImages->first()->image_path) }}" alt="Main Image"
                        id="main-product-image">
                @endif


                <!-- Wishlist button positioned absolutely inside gallery -->

                @if (Auth::user())
                    <button class="wishlist-button product-detail-wishlist" title="Add to Wishlist"
                        aria-label="Toggle Wishlist" data-product-id="{{ $product->id }}" wire:click="addToWishlist">
                        <i class="fas fa-heart" style='color: {{ $isInWishlist ? 'red' : '#666666' }} ;'></i>
                    </button>
                @else
                    <button class="wishlist-button product-detail-wishlist" title="Add to Wishlist"
                        aria-label="Toggle Wishlist" data-product-id="{{ $product->id }}"
                        onclick="event.preventDefault(); openLoginModal();">
                        {{-- <i class="fas fa-heart" style='color: {{ $isInWishlist ? ' red' : '#666666' }} ;'></i> --}}
                        <i class="fas fa-heart" style='color: {{ $isInWishlist ? 'red' : '#666666' }} ;'></i>

                    </button>

                @endif




            </div>
            <div class="thumbnail-images">
                @foreach ($variantImages as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail" class="thumbnail"
                        id="thumbnail-{{ $image->id }}" data-large-src="{{ asset('storage/' . $image->image_path) }}"
                        onclick="changeMainImage(this)">
                @endforeach
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const firstThumbnail = document.querySelector('.thumbnail');
                if (firstThumbnail) {
                    firstThumbnail.classList.add('selected');
                    document.getElementById('main-product-image').src = firstThumbnail.getAttribute('data-large-src');
                }
            });

            function changeMainImage(thumbnail) {
                // Change the main image
                var mainImage = document.getElementById('main-product-image');
                mainImage.src = thumbnail.getAttribute('data-large-src');

                // Remove the 'selected' class from all thumbnails
                var thumbnails = document.querySelectorAll('.thumbnail');
                thumbnails.forEach(function (thumb) {
                    thumb.classList.remove('selected');
                });

                // Add 'selected' class to the clicked thumbnail
                thumbnail.classList.add('selected');
            }

            document.addEventListener("livewire:init", () => {
                Livewire.on("variantChanged", ({
                    imagePath
                }) => {
                    // console.log("Received variantChanged:", imagePath);

                    console.log("imagePath from event:", imagePath);

                    document.querySelectorAll(".thumbnail").forEach((thumb) => {
                        console.log("thumbnail data-large-src:", thumb.getAttribute("data-large-src"));
                    });
                    const mainImage = document.getElementById("main-product-image");
                    if (mainImage && imagePath) {
                        mainImage.src = imagePath;
                    }

                    const thumbnails = document.querySelectorAll(".thumbnail");
                    thumbnails.forEach((thumb) => {
                        thumb.classList.remove("selected");
                    });

                    const selectedThumbnail = Array.from(thumbnails).find(
                        (thumb) => thumb.getAttribute("data-large-src") === imagePath
                    );

                    if (selectedThumbnail) {
                        selectedThumbnail.classList.add("selected");
                    }
                });
            });
        </script>

        <!-- Product Information -->
        <div class="product-info-details">
            <h1 class="product-title">{{ $product->name }}</h1>
            <div class="product-rating">
                <!-- Static Stars Example -->
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($averageReviews))
                        <i class="fas fa-star rated"></i>
                    @elseif ($i - $averageReviews < 1)
                        <i class="fas fa-star-half-alt rated"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
                <a href="#reviews" class="review-link">({{ $product->reviews->count() }} Reviews)</a>
                <span class="separator">|</span>
                <a href="#reviews" class="write-review-link">Write a Review</a>
            </div>
            <div class="product-price-block">
                @if ($old_price != null && $old_price != $price)
                    <span class="discounted-price">NRs. {{ $old_price }}</span>
                @endif
                <span class="current-price">NRs. {{ $price }}</span>
            </div>

            <div class="variant-selector">
                <div class="variant-group">
                    <label for="scent-select">Variant:</label>
                    <select id="scent-select" name="scent" aria-label="Select scent"
                        wire:model.live="selectedVariantId">
                        @foreach ($variants as $variant)
                            <option value="{{ $variant->id }}">{{ $variant->variant_name }} - {{ $variant->size }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="unit-selector">
                <div class="unit-group">
                    <label for="unit-select">Unit:</label>
                    <select id="unit-select" name="unit" aria-label="Select unit" wire:model.live="selectedUnitID">
                        @foreach ($unitList as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->unit->attribute_value }} </option>
                        @endforeach
                    </select>
                </div>
            </div>





            <div>
                <!-- Quantity Selector -->
                <div class="quantity-selector">
                    <label for="quantity">Quantity:</label>
                    <div class="quantity-controls">
                        <button wire:click="decreaseQuantity" class="quantity-decrease" title="Decrease quantity"
                            aria-label="Decrease quantity">-</button>
                        <input type="number" id="quantity" name="quantity" wire:model.live="quantity"
                            value="{{ $quantity }}" min="1" class="quantity-input" aria-label="Quantity">
                        <button wire:click="increaseQuantity" class="quantity-increase" title="Increase quantity"
                            aria-label="Increase quantity">+</button>
                    </div>
                    {{-- <span class="stock-status">In Stock {{ $stock}}</span> --}}
                    @if ($stock != null && $stock > 0)
                        <span class="stock-status">In Stock {{$stock}}</span>
                    @else
                        <span class="stock-status out-of-stock">Out of Stock</span>
                    @endif
                </div>
            </div>


            @if ($stock != null && $stock > 0)
                <div class="product-actions-detail">
                    <button class="btn btn-primary btn-buy-now">Buy Now</button>
                    <!-- Add data-product-id to the add to cart button -->

                    @if (Auth::user())
                        <button class="btn btn-secondary add-to-cart-button" wire:click="addToCart">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    @else
                        <button class="btn btn-secondary add-to-cart-button"
                            onclick="event.preventDefault(); openLoginModal();">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    @endif

                </div>
            @endif


            @if (Auth::user())
                <a href="#" class="add-to-wishlist-link" data-product-id="{{ $product->id }}" wire:click="addToWishlist">
                    <i class="fas fa-heart"></i>
                    @if ($isInWishlist)
                        Remove from Wishlist
                    @else
                        Add to Wishlist
                    @endif
                </a>
            @else
                <a href="#" class="add-to-wishlist-link" data-product-id="{{ $product->id }}"
                    onclick="event.preventDefault(); openLoginModal();">
                    <i class="fas fa-heart"></i>
                    Add to Wishlist

                </a>
            @endif


            <!-- Optional Inquiry/Contact Section -->
            <div class="inquiry-section">
                <span>For Inquiry:</span>
                <a href="tel:+1234567890" aria-label="Call us"><i class="fas fa-phone-alt"></i></a>
                <a href="https://wa.me/1234567890" target="_blank" aria-label="WhatsApp us"><i
                        class="fab fa-whatsapp"></i></a>
                <a href="mailto:info@cleansweep.com" aria-label="Email us"><i class="fas fa-envelope"></i></a>
            </div>

            <div class="product-specifications">
                <h3>Product Specifications:</h3>
                <ul>
                    <li><strong>Volume:</strong> {{ $product->variants->find($selectedVariantId)->size }}</li>
                    <li><strong>Scent:</strong> {{ $product->variants->find($selectedVariantId)->variant_name }}</li>
                    <li><strong>Category:</strong> {{ $product->category->category_name }}</li>
                    <li><strong>Sub-Category:</strong> {{ $product->subcategory->subcategory_name }}</li>
                    <li><strong>Brand:</strong> {{ $product->brand->name }}</li>
                    <li><strong>SKU:</strong> {{ $product->variants->find($selectedVariantId)->sku }}</li>
                </ul>
                <a href="#description" class="view-more-details-link">View more details</a>
            </div>

            <!-- Static Delivery/Info Snippets -->
            <div class="info-snippets">
                <div class="snippet">
                    <i class="fas fa-truck"></i>
                    <span>2-3 Days Normal Delivery</span>
                </div>
                <div class="snippet">
                    <i class="fas fa-clock"></i>
                    <span>24 Hours Express Delivery (Optional)</span>
                </div>
                <div class="snippet">
                    <i class="fas fa-undo-alt"></i>
                    <span>Easy Returns Available (T&C Apply)</span>
                </div>
            </div>

            <div class="seller-info">
                <span>Sold By: <a href="#">{{ $product->store->store_name }}</a></span>
            </div>

            <div class="share-product">
                <span>Share:</span>
                <a href="#" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Share on Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Share on Pinterest"><i class="fab fa-pinterest"></i></a>
                <a href="#" aria-label="Copy Link"><i class="fas fa-link"></i></a>
            </div>
        </div>
    </section>
</div>