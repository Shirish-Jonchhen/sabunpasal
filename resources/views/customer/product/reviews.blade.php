@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Reviews')

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
    <div class="container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a
                        href="{{ route('user.show.category', $product->category->slug) }}">{{ $product->category->category_name }}</a>
                </li>
                <li><a
                        href="{{ route('user.show.subcategory', $product->subcategory->slug) }}">{{ $product->subcategory->subcategory_name }}</a>
                </li>
                <li><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                </li>
                <li aria-current="page">Reviews</li>
            </ol>
        </nav>

        <div class="product-reviews-page-header">
            <h1>Reviews for {{ $product->name }}</h1>
            <div class="info-tab-content reviews-section">

                <div class="reviews-summary">
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
                            <button type="button" class="btn btn-secondary"
                                onclick="event.preventDefault(); openLoginModal();">Submit Review</button>
                        @endif


                    </form>
                </div>
            </div>

        </div>

        <section class="all-reviews-container">
            <div class="review-filter-sort">
                <div class="sort-options">
                    <form action="{{ route('product.reviews.show', $product->slug) }}" method="GET">
                        <label for="sort-reviews">Sort By:</label>
                        <select id="sort-reviews" name="sort-reviews" onchange="this.form.submit()">
                            <option value="newest" {{ $sortOption == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ $sortOption == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="rating-high" {{ $sortOption == 'rating-high' ? 'selected' : '' }}>Highest Rating
                            </option>
                            <option value="rating-low" {{ $sortOption == 'rating-low' ? 'selected' : '' }}>Lowest Rating
                            </option>
                            {{-- <option value="most-helpful">Most Helpful</option> --}}
                        </select>
                    </form>
                </div>
                <!-- Add filter by rating if needed -->
            </div>

            <div class="review-list-full">
                <!-- Static Review Examples -->
                @foreach ($reviews as $review)
                    <article class="review-item-full">
                        <div class="review-item-full-header">
                            <span class="review-author-full">{{ $review->user->name }}
                                @if ($review->user->email_verified_at)
                                    <i class="fa-regular fa-circle-check" style="font-size: 1em;"></i>
                                @endif
                            </span>
                            <div class="review-rating-stars-full">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->star)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            <span
                                class="review-date-full">{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y') }}</span>
                        </div>
                        {{-- <h4 class="review-title-full">Works great!</h4> --}}
                        <p class="review-text-full">{{ $review->review }}</p>

                        @if ($review->isVerifiedPurchase())
                            <div class="review-meta-full">
                                <span class="verified-purchase"><i class="fas fa-check-circle"></i> Verified Purchase</span>
                            </div>
                        @endif


                    </article>
                @endforeach


                <!-- Add more static reviews as needed -->
            </div>

            {{-- pagenation --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $reviews->links('vendor.pagination.default') }}
            </div>

            {{-- <nav class="pagination" aria-label="Reviews navigation">
            <ul>
                <li><a href="#" class="page-link prev" aria-label="Previous page">&laquo; Prev</a></li>
                <li><a href="#" class="page-link active" aria-current="page">1</a></li>
                <li><a href="#" class="page-link">2</a></li>
                <li><a href="#" class="page-link">3</a></li>
                <li><a href="#" class="page-link next" aria-label="Next page">Next &raquo;</a></li>
            </ul>
        </nav> --}}
        </section>
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
