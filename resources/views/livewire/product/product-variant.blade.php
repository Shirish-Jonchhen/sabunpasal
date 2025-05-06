<div>
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
                <button class="wishlist-button product-detail-wishlist" title="Add to Wishlist"
                    aria-label="Toggle Wishlist" data-product-id="prod_001">
                    <i class="fas fa-heart"></i>
                </button>
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
            document.addEventListener("DOMContentLoaded", function() {
                // Automatically select the first image on page load
                var firstThumbnail = document.querySelector('.thumbnail');
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
                thumbnails.forEach(function(thumb) {
                    thumb.classList.remove('selected');
                });

                // Add 'selected' class to the clicked thumbnail
                thumbnail.classList.add('selected');
            }

            // This function updates the image when variant changes
            Livewire.on('variantChanged', (imagePath) => {
                var mainImage = document.getElementById('main-product-image');
                mainImage.src = imagePath;

                // Remove 'selected' class from all thumbnails
                var thumbnails = document.querySelectorAll('.thumbnail');
                thumbnails.forEach(function(thumb) {
                    thumb.classList.remove('selected');
                });

                // Set the first thumbnail as selected by default
                var firstThumbnail = document.querySelector('.thumbnail');
                if (firstThumbnail) {
                    firstThumbnail.classList.add('selected');
                }
            });
        </script>

        <!-- Product Information -->
        <div class="product-info-details">
            <h1 class="product-title">{{ $product->name }}</h1>
            <div class="product-rating">
                <!-- Static Stars Example -->
                <i class="fas fa-star rated"></i>
                <i class="fas fa-star rated"></i>
                <i class="fas fa-star rated"></i>
                <i class="fas fa-star rated"></i>
                <i class="fas fa-star"></i>
                <a href="#reviews" class="review-link">(15 Reviews)</a>
                <span class="separator">|</span>
                <a href="#reviews" class="write-review-link">Write a Review</a>
            </div>
            <div class="product-price-block">
                <span class="discounted-price">NRs. {{ $old_price }}</span>
                <span class="current-price">NRs. {{ $price }}</span>
                <!-- <span class="original-price">$6.99</span> -->
                <!-- <span class="discount-tag">-28%</span> -->
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





            <div class="quantity-selector">
                <label for="quantity">Quantity:</label>
                <div class="quantity-controls">
                    <button class="quantity-decrease" title="Decrease quantity"
                        aria-label="Decrease quantity">-</button>
                    <input type="number" id="quantity" name="quantity" value="1" min="1"
                        class="quantity-input" aria-label="Quantity">
                    <button class="quantity-increase" title="Increase quantity"
                        aria-label="Increase quantity">+</button>
                </div>
                <span class="stock-status">In Stock</span>
            </div>

            <div class="product-actions-detail">
                <button class="btn btn-primary btn-buy-now">Buy Now</button>
                <!-- Add data-product-id to the add to cart button -->
                <button class="btn btn-secondary add-to-cart-button" data-product-id="prod_001">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </div>
            <a href="#" class="add-to-wishlist-link" data-product-id="prod_001"><i class="fas fa-heart"></i> Add
                to Wishlist</a>


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
                <span>Sold By: <a href="#">CleanSweep Mart Official</a></span>
                <span>Warranty: N/A</span>
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
