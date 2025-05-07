@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Home')

@section('user_content')
    <div>
        <!-- Hero Section with Category Sidebar -->
        <section class="hero-section container">
            <!-- Static Category Sidebar -->
            <aside class="category-sidebar" id="category-sidebar">
                <h3 class="sidebar-title">Categories</h3>
                <ul id="category-sidebar-list" class="category-sidebar-list">
                    @foreach ($categories as $category)
                        <li class="has-sub">
                            <a href="#">{{ $category->category_name }}</a>
                            <ul class="subcategory-dropdown">
                                @foreach ($category->subcategories as $subcategory)
                                    <li><a href="#">{{ $subcategory->subcategory_name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </aside>
            <!-- End Static Category Sidebar -->

            <!-- Main Hero Content (Banners) -->
            <div class="hero-content-main">
                <div class="hero-main-banner">
                    @if ($banners->where('position', 1)->isEmpty())
                        <div class="swiper heroSwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://picsum.photos/seed/hero1/1200/400" alt="Main Promotion Banner">
                                    <div class="hero-banner-content">
                                        <h2>Welcome to CleanSweep Mart</h2>
                                        <a href="/products" class="btn btn-primary">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="swiper heroSwiper">
                            <div class="swiper-wrapper">
                                @foreach ($banners->where('position', 1) as $banner)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}">
                                        <div class="hero-banner-content">
                                            <h2>{{ $banner->title }}</h2>
                                            <a href="/products" class="btn btn-primary">Shop Now</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>



                            <!-- Optional pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    @endif
                </div>

            </div>
            <!-- End Main Hero Content -->
        </section>
        <!-- End Hero Section -->


        <!-- Icon Navigation/Quick Links -->
        <section class="icon-nav-section container">
            <!-- Static links to category pages -->
            @foreach ($featured_subcategories as $subcat)
                <a href="#" class="icon-nav-item">
                    {{-- <i class="fas fa-{{ $subcat->icon }}"></i> --}}
                    <img src="{{ asset('storage/' . $subcat->icon_path) }}" alt="{{ $subcat->subcategory_name }} Icon"
                        class="icon">
                    {{-- <i class="fas fa-{{ $subcat->icon }}"></i> --}}
                    <span>{{ $subcat->subcategory_name }}</span>
                </a>
            @endforeach
        </section>
        <!-- End Icon Navigation -->

        <!-- Full Width Banner -->
        @if ($banners->where('position', 2)->isNotEmpty())
            <section class="full-width-banner-section container">
                <div class="full-width-banner">
                    @foreach ($banners->where('position', 2) as $banner)
                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}">
                        <div class="full-width-banner-content">
                            <h3>{{ $banner->title }}</h3>
                            <a href="/category/all-purpose-cleaners/cleaning-wipes" class="btn btn-secondary">Shop Wipes</a>
                        </div>
                    @endforeach
                </div>

            </section>
        @endif
        <!-- End Full Width Banner -->

        <!-- Featured Products Section 1 (Trending Now - Static Example) -->
        <section id="featured-products-1" class="products-section container">
            <div class="section-header">
                <h2>Trending Now</h2>
                <a href="/products?tag=trending" class="view-all-link">View All Trending <i
                        class="fas fa-arrow-right"></i></a>
            </div>

            <div class="product-grid product-grid-horizontal" id="product-grid-featured-1">
                <!-- Static Example Product Cards (Replace with Blade foreach in Laravel) -->
                @foreach ($sale_products as $product)
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
                                <h3 class="product-name" title="Sparkle All-Purpose Cleaner">Sparkle All-Purpose Cleaner
                                </h3>
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
                @endforeach
                <!-- Add more static featured products as needed -->
            </div>
        </section>
        <!-- End Featured Products Section 1 -->


        @php
            $position = 3;
        @endphp
        @foreach ($randomCategories as $category)
            <!-- Full Width Banner 2 -->
            @if ($banners->where('position', $position)->isNotEmpty())
                <section class="full-width-banner-section container">
                    <div class="full-width-banner full-width-banner-dark">

                        @foreach ($banners->where('position', $position) as $banner)
                            <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}">
                            <div class="full-width-banner-content">
                                <h3>{{ $banner->title }}</h3>
                                {{-- <p>{{ $banner->description }}</p> --}}
                                <a href="/products?tag=new" class="btn btn-primary">See More</a>
                            </div>
                        @endforeach

                    </div>
                </section>
            @endif
            @php
                $position++;
            @endphp
            <!-- End Full Width Banner 2 -->



            <!-- Category wise product -->
            <section id="featured-products-2" class="products-section container">

                <div class="section-header">
                    <h2>{{ $category->category_name }}</h2>
                    <a href="/category/kitchen-cleaners" class="view-all-link">Shop more <i
                            class="fas fa-arrow-right"></i></a>
                </div>
                <div class="product-grid product-grid-horizontal" id="product-grid-featured-2">
                    <!-- Static Example Product Cards -->
                    @if ($category->products->isNotEmpty())
                        @foreach ($category->products->shuffle()->take(4) as $product)
                            <a href="{{ route('product.show', $product->slug) }}" class="product-link">
                                <div class="product-card" data-product-id="prod_003">
                                    <div class="product-image-container">
                                        <img src="{{ asset('storage/' . $product->variants->first()->images->first()?->image_path) }}"
                                            alt="Scrub Free Kitchen Degreaser" class="product-image">
                                        @if ($product->is_on_sale)
                                            <div class="sale-tag">
                                                SALE 🔥
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <span class="product-category">{{ $product->category->category_name }} -
                                            {{ $product->subcategory->subcategory_name }}</span>
                                        <h3 class="product-name" title="Scrub Free Kitchen Degreaser">{{ $product->name }}
                                        </h3>
                                        <p class="product-old-price">
                                            @php
                                                $lowestOldPrice =
                                                    $product->variants->flatMap->prices->sortBy('old_price')->first()
                                                        ->old_price ?? '0.00';
                                                $highestOldPrice =
                                                    $product->variants->flatMap->prices
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
                                                    $product->variants->flatMap->prices->sortBy('price')->first()
                                                        ->price ?? '0.00';
                                                $highestPrice =
                                                    $product->variants->flatMap->prices->sortByDesc('price')->first()
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
                        @endforeach
                    @else
                        <p>No Products in this category</p>
                    @endif
                </div>
            </section>
            <!-- Category Wise Peoduct -->
        @endforeach














        <!-- Brands Section (Static Example) -->
        <section class="brands-section container">
            <h2>Our Trusted Brands</h2>
            <div class="brand-logos">
                <!-- Static Brand Logos -->
                @foreach ($brands as $brand)
                    <img src="{{ asset('storage/' . $brand->logo_path) }}" alt="{{ $brand->name }} Logo">
                @endforeach
            </div>
        </section>
        <!-- End Brands Section -->

        <!-- Removed All Products Section - Moved to products.html or handled by Laravel routes -->
        <section id="products" class="products-section container" style="text-align: center; padding: 2rem 0;">
            <div class="section-header" style="justify-content: center; border-bottom: none;">
                <h2>Explore All Our Products</h2>
            </div>
            <p style="margin-bottom: 1.5rem;">Find everything you need for a spotless space.</p>
            <a href="/products" class="btn btn-secondary">View All Products</a>
            <!-- Link to the dedicated products page -->
        </section>


        <!-- Info/About Section -->
        <section class="info-section container">
            <div class="info-content">
                <h3>Your Partner in Cleanliness</h3>
                <p>At CleanSweep Mart, we believe a clean space is a happy space. We offer a curated selection of
                    high-quality
                    cleaning supplies for every need, from everyday home cleaning to professional-grade solutions. We are
                    committed to providing effective products, excellent customer service, and fast shipping.</p>
                <p>Explore our categories, discover new arrivals, and enjoy exclusive deals. Thank you for choosing
                    CleanSweep
                    Mart!</p>
            </div>
        </section>
        <!-- End Info/About Section -->


        <!-- Toast Notification Placeholder -->
        <div id="toast-notification" class="toast">
            <span id="toast-message"></span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.heroSwiper', {
                loop: true,
                autoplay: {
                    delay: 6000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script>

@endsection
