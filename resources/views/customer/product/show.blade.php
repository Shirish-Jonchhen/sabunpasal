@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Product Detail')

@section('user_content')
    <div class='container'>

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">{{ $product->category->category_name }}</a></li>
                <li><a href="#">{{ $product->subcategory->subcategory_name }}</a></li>
                <li aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Product Display Area -->

        <!-- Product Display Area -->
        <livewire:product.product-variant :slug="$product->slug" />

        <!-- Offer Section (Static Example) -->
        <section class="offer-banner-section container">
            <div class="offer-banner">
                <div class="offer-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="offer-details">
                    <h3>SPECIAL OFFER!</h3>
                    <p>Get 10% off when you buy 3 or more cleaning sprays.</p>
                </div>
                <a href="#" class="btn btn-primary btn-sm">Shop Sprays</a>
            </div>
        </section>

        <!-- Detailed Information Section -->
        <section class="product-detailed-info container">
            <div class="info-tabs">
                <!-- Using simple headers instead of functional tabs for static version -->
                <h2 id="description" class="info-tab-header active">Description</h2>
                <div class="info-tab-content active">
                    <p>
                        {{ $product->description }}
                    </p>
                </div>

                <h2 id="reviews" class="info-tab-header">Reviews</h2>
                <div class="info-tab-content reviews-section">
                    <div class="reviews-summary">
                        <h4>Overall Rating</h4>
                        <div class="average-rating">
                            <span class="rating-value">4.0</span>
                            <div class="stars">
                                <i class="fas fa-star rated"></i>
                                <i class="fas fa-star rated"></i>
                                <i class="fas fa-star rated"></i>
                                <i class="fas fa-star rated"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span>Based on 15 Reviews</span>
                        </div>
                        <div class="rating-breakdown">
                            <!-- Static Breakdown -->
                            <span>5 Stars <progress value="60" max="100"></progress> (9)</span>
                            <span>4 Stars <progress value="20" max="100"></progress> (3)</span>
                            <span>3 Stars <progress value="13" max="100"></progress> (2)</span>
                            <span>2 Stars <progress value="7" max="100"></progress> (1)</span>
                            <span>1 Star <progress value="0" max="100"></progress> (0)</span>
                        </div>
                    </div>
                    <div class="write-review">
                        <h4>Have you used this product before?</h4>
                        <form action="#" class="review-form"> <!-- Action points to backend route -->
                            <div class="form-group">
                                <label for="review-rating">Your Rating:</label>
                                <!-- Simple static stars for display, real rating requires JS -->
                                <div class="static-stars"> ★★★★★ </div>
                            </div>
                            <div class="form-group">
                                <label for="review-text">Your Review:</label>
                                <textarea id="review-text" name="review" rows="4" placeholder="Tell us what you think..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary">Submit Review</button>
                        </form>
                    </div>

                    <div class="customer-reviews-list">
                        <h3>Customer Reviews</h3>
                        <!-- Static Review Examples -->
                        <div class="review-item">
                            <div class="review-header">
                                <span class="review-author">Jane D.</span>
                                <span class="review-date">July 22, 2024</span>
                                <div class="review-rating-stars">★★★★☆</div>
                            </div>
                            <p class="review-text">Works really well on my kitchen counters. Smells great too!</p>
                        </div>
                        <div class="review-item">
                            <div class="review-header">
                                <span class="review-author">Mark S.</span>
                                <span class="review-date">July 18, 2024</span>
                                <div class="review-rating-stars">★★★★★</div>
                            </div>
                            <p class="review-text">My favorite all-purpose cleaner. Gets the job done.</p>
                        </div>
                        <!-- Add more static reviews -->
                        <a href="#" class="view-all-link">View All Reviews</a>
                    </div>
                </div>

                <!-- Add more tabs/headers like Shipping & Returns if needed -->
            </div>

            <!-- Sidebar for Similar Products (Static) -->
            <aside class="similar-products-sidebar">
                <h3>Similar Products</h3>
                <!-- Re-use product card styling -->
                <div class="product-card similar-product" data-product-id="prod_007">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_007/200/200" alt="EcoClean All-Purpose Wipes"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">EcoClean Wipes</h3>
                        <p class="product-price">$6.49</p>
                    </div>
                    <div class="product-actions">
                        <!-- Link to the product detail page -->
                        <a href="product-detail.html?id=prod_007" class="btn btn-outline-primary btn-sm">View</a>
                    </div>
                </div>

                <div class="product-card similar-product" data-product-id="prod_014">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_014/200/200" alt="Glass Gleam Window Cleaner"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Glass Gleam</h3>
                        <p class="product-price">$5.29</p>
                    </div>
                    <div class="product-actions">
                        <a href="product-detail.html?id=prod_014" class="btn btn-outline-primary btn-sm">View</a>
                    </div>
                </div>
                <!-- Add more similar products -->
                <a href="/category/all-purpose-cleaners" class="view-all-link">View More Similar <i
                        class="fas fa-arrow-right"></i></a>
            </aside>
        </section>

        <!-- You Might Also Like Section -->
        <section id="related-products" class="products-section container">
            <div class="section-header">
                <h2>You Might Also Like</h2>
                <a href="/products" class="view-all-link">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="product-grid product-grid-horizontal" id="product-grid-related">
                <!-- Static Example Product Cards (Use same structure as index) -->
                <div class="product-card" data-product-id="prod_003">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_003/300/300" alt="Scrub Free Kitchen Degreaser"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Kitchen Cleaners</span>
                        <h3 class="product-name">Scrub Free Degreaser</h3>
                        <p class="product-price">$6.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button"><i class="fas fa-cart-plus"></i> Add to
                            Cart</button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_002">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_002/300/300" alt="Gleam Bathroom Cleaner"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Bathroom Cleaners</span>
                        <h3 class="product-name">Gleam Bathroom Cleaner</h3>
                        <p class="product-price">$5.49</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button"><i class="fas fa-cart-plus"></i> Add to
                            Cart</button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_005">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_005/300/300" alt="PureGuard Disinfectant Spray"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Disinfectants</span>
                        <h3 class="product-name">PureGuard Spray</h3>
                        <p class="product-price">$7.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button"><i class="fas fa-cart-plus"></i> Add to
                            Cart</button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_011">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_011/300/300" alt="GermAway Disinfecting Wipes"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Disinfectants</span>
                        <h3 class="product-name">GermAway Wipes</h3>
                        <p class="product-price">$5.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button"><i class="fas fa-cart-plus"></i> Add to
                            Cart</button>
                    </div>
                </div>
                <!-- Add more static related products -->
            </div>
        </section>

        <!-- Recently Viewed Section (JS/Backend Driven ideally) -->
        <section id="recently-viewed" class="products-section container">
            <div class="section-header">
                <h2>Recently Viewed</h2>
                <!-- Could have a "Clear History" link here -->
            </div>
            <div class="product-grid product-grid-horizontal" id="product-grid-viewed">
                <!-- Static Example - In a real app, JS populates this -->
                <div class="product-card" data-product-id="prod_006">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_006/300/300" alt="Shine Bright Floor Cleaner"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Floor Care</span>
                        <h3 class="product-name">Shine Bright Floor Cleaner</h3>
                        <p class="product-price">$9.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button"><i class="fas fa-cart-plus"></i> Add to
                            Cart</button>
                    </div>
                </div>
                <div class="product-card-placeholder" style="min-height: 350px;">
                    <p>Your recently viewed items will appear here.</p>
                </div>
                <!-- JS would add more cards here -->
            </div>
        </section>

        <!-- Toast Notification Placeholder -->
        <div id="toast-notification" class="toast">
            <span id="toast-message"></span>
        </div>
    </div>

@endsection
