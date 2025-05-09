@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - ' . $category->category_name)

@section('user_content')
    <div class='container page-content'>
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li aria-current="page">{{ $category->category_name }}</li>
            </ol>
        </nav>

        <div class="category-page-layout">
            <aside class="filter-sidebar">
                <h3>Filter By</h3>

                <div class="filter-group">
                    <h4>Sub Categories</h4>
                    <ul class="filter-list">
                        @foreach ($category->subcategories as $subcategory)
                            <li>
                                <a
                                    href="category-detail.html?category={{ $category->slug }}&subcategory={{ $subcategory->slug }}">{{ $subcategory->subcategory_name }}({{ $subcategory->products->count() }})</a>
                                {{-- ({{ $subcategory->products_count }}) --}}
                            </li>

                        @endforeach


                    </ul>
                </div>

                <div class="filter-group">
                    <h4>Price Range</h4>

                    <ul class="filter-list price-filter-list">
                        <li>
                            <label><input type="radio" name="price-range" value="0-5" /> $0 -
                                $5</label>
                        </li>
                        <li>
                            <label><input type="radio" name="price-range" value="5-10" /> $5 -
                                $10</label>
                        </li>
                        <li>
                            <label><input type="radio" name="price-range" value="10-15" /> $10 -
                                $15</label>
                        </li>
                        <li>
                            <label><input type="radio" name="price-range" value="15-999" />
                                $15+</label>
                        </li>
                    </ul>

                    <div class="price-input-range">
                        <input type="number" placeholder="Min" aria-label="Minimum price" />
                        <span>-</span>
                        <input type="number" placeholder="Max" aria-label="Maximum price" />
                        <button class="btn btn-outline-primary btn-sm">Go</button>
                    </div>

                </div>

                <div class="filter-group">
                    <h4>Brands</h4>
                    <input type="text" placeholder="Search Brands" class="filter-search-input" aria-label="Search brands" />
                    <ul class="filter-list scrollable-filter-list">
                        <li>
                            <label><input type="checkbox" name="brand" value="sparkleclean" />
                                SparkleClean</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="brand" value="ecofresh" />
                                EcoFresh</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="brand" value="prostrength" />
                                ProStrength</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="brand" value="gleamit" />
                                GleamIt</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="brand" value="purehome" />
                                PureHome</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="brand" value="evergreen" />
                                Evergreen Essentials</label>
                        </li>
                    </ul>
                </div>

                <div class="filter-group">
                    <h4>Scent</h4>
                    <ul class="filter-list">
                        <li>
                            <label><input type="checkbox" name="scent" value="lemon" />
                                Lemon</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="scent" value="lavender" />
                                Lavender</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="scent" value="pine" />
                                Pine</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="scent" value="unscented" />
                                Unscented</label>
                        </li>
                    </ul>
                </div>

                <div class="filter-group">
                    <h4>Features</h4>
                    <ul class="filter-list">
                        <li>
                            <label><input type="checkbox" name="feature" value="eco-friendly" />
                                Eco-Friendly</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="feature" value="pet-safe" /> Pet
                                Safe</label>
                        </li>
                        <li>
                            <label><input type="checkbox" name="feature" value="concentrate" />
                                Concentrate</label>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-primary apply-filters-button">
                    Apply Filters
                </button>
            </aside>

            <section class="product-listing-content">
                <div class="category-content-header">
                    <h1>{{ $category->category_name }}</h1>
                </div>

                <div class="sort-view-options">
                    <div class="sort-options">
                        <label for="sort-by">Sort By:</label>
                        <select id="sort-by" name="sort-by">
                            <option value="default">Default</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="name-asc">Name: A to Z</option>
                            <option value="name-desc">Name: Z to A</option>
                            <option value="newest">Newest Arrivals</option>
                        </select>
                    </div>
                    {{-- <div class="view-toggle">
                        <button class="view-btn active" aria-label="Grid view" title="Grid view">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" aria-label="List view" title="List view">
                            <i class="fas fa-list"></i>
                        </button>
                    </div> --}}
                </div>

                <div class="product-grid" id="category-product-grid">
                    <!-- Product Card Example 1 -->
                    @foreach ($products as $product)
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




                </div>

            </section>

        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $products->links("vendor.pagination.default") }}
        </div>
    </div>


@endsection