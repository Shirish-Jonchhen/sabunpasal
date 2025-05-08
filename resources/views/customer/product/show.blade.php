@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - {{ $product->name }}')

@section('user_content')
    <style>
        .star-rating {
            display: inline-block;
        }

        .star {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star.hover,
        .star.selected {
            color: gold;
        }
    </style>
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

                    <div class="reviews-summary" >
                        <h4>Overall Rating</h4>
                        <div class="average-rating">
                            <span class="rating-value">{{ number_format($averageReviews, 2) }}</span>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($averageReviews))
                                        <i class="fas fa-star rated"></i>
                                    @elseif ($i - $averageReviews < 1)
                                        <i class="fas fa-star-half-alt rated"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span>Based on {{ $totalReviews }} Reviews</span>
                        </div>
                        <div class="rating-breakdown">
                            <!-- Static Breakdown -->

                            <span>5 Stars <progress value="{{ $fiveStars }}" max="{{ $totalReviews }}"></progress>
                                ({{ $fiveStars }})</span>
                            <span>4 Stars <progress value="{{ $fourStars }}" max="{{ $totalReviews }}"></progress>
                                ({{ $fourStars }})</span>
                            <span>3 Stars <progress value="{{ $threeStars }}" max="{{ $totalReviews }}"></progress>
                                ({{ $threeStars }})</span>
                            <span>2 Stars <progress value="{{ $twoStars }}" max="{{ $totalReviews }}"></progress>
                                ({{ $twoStars }})</span>
                            <span>1 Stars <progress value="{{ $oneStars }}" max="{{ $totalReviews }}"></progress>
                                ({{ $oneStars }})</span>


                        </div>
                    </div>

                    <div class="write-review">
                        <h4>Have you used this product before?</h4>
                        <form action="{{ route('product.review', $product->slug) }}" class="review-form" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="review-rating">Your Rating:</label>
                                <div class="star-rating" id="star-rating">
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                </div>
                                <input type="hidden" name="star" id="rating" value="0">
                            </div>

                            <div class="form-group">
                                <label for="review-text">Your Review:</label>
                                <textarea id="review-text" name="review" rows="4" placeholder="Tell us what you think..."></textarea>
                            </div>
                            @if (Auth::user())
                            <button type="submit" class="btn btn-secondary">Submit Review</button>
                            @else
                            <button type="button" class="btn btn-secondary" onclick="event.preventDefault(); openLoginModal();">Submit Review</button>

                            @endif

                            
                        </form>
                    </div>

                    <div class="customer-reviews-list">
                        <h3>Customer Reviews</h3>
                        <!-- Static Review Examples -->

                        @if ($reviews->isEmpty())
                        <div class="no-reviews-message text-center p-4 border rounded bg-light">
                            <p class="mb-0 text-muted">
                                <i class="fas fa-comment-dots me-2 text-secondary"></i>
                                No reviews yet. <strong>Be the first to review this product!</strong>
                            </p>
                        </div>
                        @else
                            @foreach ($reviews as $review)
                                <div class="review-item">
                                    <div class="review-header">
                                        <span class="review-author">{{ $review->user->name }}</span>
                                        <span
                                            class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}</span>
                                        <div class="review-rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->star)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="review-text">{{ $review->review }}</p>
                                </div>
                            @endforeach
                             <!-- Add more static reviews -->
                        <a href="#" class="view-all-link">View All Reviews</a>
                        @endif


                       
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
    <script>
        const stars = document.querySelectorAll('.star-rating .star');
        const ratingInput = document.getElementById('rating');

        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('mouseover', () => {
                const val = parseInt(star.getAttribute('data-value'));
                highlightStars(val);
            });

            star.addEventListener('mouseout', () => {
                highlightStars(selectedRating);
            });

            star.addEventListener('click', () => {
                selectedRating = parseInt(star.getAttribute('data-value'));
                ratingInput.value = selectedRating;
                highlightStars(selectedRating);
            });
        });

        function highlightStars(rating) {
            stars.forEach(star => {
                const val = parseInt(star.getAttribute('data-value'));
                star.classList.toggle('selected', val <= rating);
            });
        }
    </script>

@endsection
