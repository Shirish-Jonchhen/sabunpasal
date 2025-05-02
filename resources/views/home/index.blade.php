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
                    <img src="{{ asset('storage/' . $banners->first()->image_path) }}" alt="Main Promotion Banner">
                    <div class="hero-banner-content">
                        <h2>{{ $banners->first()->title }}</h2>
                        {{-- <p>Get your home ready for any season.</p> --}}
                        <a href="/products" class="btn btn-primary">Shop Now</a> <!-- Link to products page -->
                    </div>
                </div>
                {{-- <div class="hero-side-banners">
                    <div class="side-banner">
                        <img src="https://picsum.photos/seed/side1/400/220" alt="Side Promotion 1">
                        <div class="side-banner-content">
                            <h4>Eco Savers</h4>
                            <a href="/category/eco-friendly" class="btn btn-secondary btn-sm">View Range</a>
                        </div>
                    </div>
                    <div class="side-banner">
                        <img src="https://picsum.photos/seed/side2/400/220" alt="Side Promotion 2">
                        <div class="side-banner-content">
                            <h4>Laundry Day</h4>
                            <a href="/category/laundry-detergents" class="btn btn-secondary btn-sm">Shop Detergents</a>
                        </div>
                    </div>
                </div> --}}
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

            {{-- <a href="/category/bathroom-cleaners" class="icon-nav-item">
                <i class="fas fa-shower"></i>
                <span>Bathroom</span>
            </a>
            <a href="/category/kitchen-cleaners" class="icon-nav-item">
                <i class="fas fa-utensils"></i>
                <span>Kitchen</span>
            </a>
            <a href="/category/laundry-detergents" class="icon-nav-item">
                <i class="fas fa-tshirt"></i>
                <span>Laundry</span>
            </a>
            <a href="/category/disinfectants" class="icon-nav-item">
                <i class="fas fa-shield-virus"></i>
                <span>Disinfectants</span>
            </a>
            <a href="/category/floor-care" class="icon-nav-item">
                <i class="fas fa-broom"></i>
                <span>Floor Care</span>
            </a>
            <a href="/products" class="icon-nav-item"> <!-- Link to main products page -->
                <i class="fas fa-ellipsis-h"></i>
                <span>View All</span>
            </a> --}}
        </section>
        <!-- End Icon Navigation -->

        <!-- Full Width Banner -->
        <section class="full-width-banner-section container">
            <div class="full-width-banner">
                <img src="https://picsum.photos/seed/fullbanner1/1200/200" alt="Full Width Promotion Banner">
                <div class="full-width-banner-content">
                    <h3>Limited Time Offer: Buy 2 Get 1 Free on Select Wipes!</h3>
                    <a href="/category/all-purpose-cleaners/cleaning-wipes" class="btn btn-secondary">Shop Wipes</a>
                </div>
            </div>
        </section>
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
                <div class="product-card" data-product-id="prod_001">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_001/300/300" alt="Sparkle All-Purpose Cleaner"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist" aria-label="Toggle Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">All Purpose Cleaners</span>
                        <h3 class="product-name" title="Sparkle All-Purpose Cleaner">Sparkle All-Purpose Cleaner</h3>
                        <p class="product-price">$4.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_004">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_004/300/300" alt="Ocean Breeze Laundry Detergent"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist" aria-label="Toggle Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Laundry Detergents</span>
                        <h3 class="product-name" title="Ocean Breeze Laundry Detergent">Ocean Breeze Laundry Detergent
                        </h3>
                        <p class="product-price">$12.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_006">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_006/300/300" alt="Shine Bright Floor Cleaner"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist" aria-label="Toggle Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Floor Care</span>
                        <h3 class="product-name" title="Shine Bright Floor Cleaner">Shine Bright Floor Cleaner</h3>
                        <p class="product-price">$9.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_007">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_007/300/300" alt="EcoClean All-Purpose Wipes"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist" aria-label="Toggle Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">All Purpose Cleaners</span>
                        <h3 class="product-name" title="EcoClean All-Purpose Wipes">EcoClean All-Purpose Wipes</h3>
                        <p class="product-price">$6.49</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <!-- Add more static featured products as needed -->
            </div>
        </section>
        <!-- End Featured Products Section 1 -->

        <!-- Full Width Banner 2 -->
        <section class="full-width-banner-section container">
            <div class="full-width-banner full-width-banner-dark">
                <img src="https://picsum.photos/seed/fullbanner2/1200/180" alt="New Arrivals Banner">
                <div class="full-width-banner-content">
                    <h3>Explore Our New Arrivals</h3>
                    <p>Discover the latest innovations in cleaning technology.</p>
                    <a href="/products?tag=new" class="btn btn-primary">See What's New</a>
                </div>
            </div>
        </section>
        <!-- End Full Width Banner 2 -->

        <!-- Featured Products Section 2 (Kitchen Essentials - Static Example) -->
        <section id="featured-products-2" class="products-section container">
            <div class="section-header">
                <h2>Kitchen Essentials</h2>
                <a href="/category/kitchen-cleaners" class="view-all-link">Shop Kitchen <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="product-grid product-grid-horizontal" id="product-grid-featured-2">
                <!-- Static Example Product Cards -->
                <div class="product-card" data-product-id="prod_003">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_003/300/300" alt="Scrub Free Kitchen Degreaser"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist" aria-label="Toggle Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Kitchen Cleaners</span>
                        <h3 class="product-name" title="Scrub Free Kitchen Degreaser">Scrub Free Kitchen Degreaser</h3>
                        <p class="product-price">$6.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_009">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_009/300/300" alt="Stainless Steel Shine"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist" aria-label="Toggle Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Kitchen Cleaners</span>
                        <h3 class="product-name" title="Stainless Steel Shine">Stainless Steel Shine</h3>
                        <p class="product-price">$8.99</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <div class="product-card" data-product-id="prod_013">
                    <div class="product-image-container">
                        <img src="https://picsum.photos/seed/prod_013/300/300" alt="BioBlast Drain Cleaner"
                            class="product-image">
                        <button class="wishlist-button" title="Add to Wishlist" aria-label="Toggle Wishlist">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Kitchen Cleaners</span>
                        <h3 class="product-name" title="BioBlast Drain Cleaner">BioBlast Drain Cleaner</h3>
                        <p class="product-price">$8.49</p>
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-primary add-to-cart-button">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                <!-- Add more static featured products as needed -->
            </div>
        </section>
        <!-- End Featured Products Section 2 -->

        <!-- Large Single Product Feature (Static Example) -->
        <section class="large-product-feature container">
            <div class="large-product-image">
                <img src="https://picsum.photos/seed/largeprod/600/500" alt="Featured Product">
            </div>
            <div class="large-product-info">
                <span class="tag">Staff Pick</span>
                <h2>Heavy Duty Degreaser Pro</h2>
                <p>Tackle the toughest grease and grime with our professional-strength formula. Ideal for ovens, grills, and
                    industrial kitchens.</p>
                <span class="price">$15.99</span>
                <!-- Link to a specific product page (replace # with actual link) -->
                <a href="/product/prod_feat" class="btn btn-primary">Learn More</a>
            </div>
        </section>
        <!-- End Large Single Product Feature -->

        <!-- Brands Section (Static Example) -->
        <section class="brands-section container">
            <h2>Our Trusted Brands</h2>
            <div class="brand-logos">
                <!-- Static Brand Logos -->
                @foreach ($brands as $brand)
                    <img src="{{ asset('storage/' . $brand->logo_path) }}" alt="{{ $brand->name }} Logo">
                    
                @endforeach
                {{-- <img src="https://picsum.photos/seed/brand1/150/80?grayscale" alt="Brand Logo 1">
                <img src="https://picsum.photos/seed/brand2/150/80?grayscale" alt="Brand Logo 2">
                <img src="https://picsum.photos/seed/brand3/150/80?grayscale" alt="Brand Logo 3">
                <img src="https://picsum.photos/seed/brand4/150/80?grayscale" alt="Brand Logo 4">
                <img src="https://picsum.photos/seed/brand5/150/80?grayscale" alt="Brand Logo 5">
                <img src="https://picsum.photos/seed/brand6/150/80?grayscale" alt="Brand Logo 6"> --}}
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

@endsection
