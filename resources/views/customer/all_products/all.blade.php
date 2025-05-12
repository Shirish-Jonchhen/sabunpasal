@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - ' . "All Products")

@section('user_content')

    <div class='container'>
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li aria-current="page">All Products</li>
            </ol>
        </nav>

        <form method="GET" action="{{ route('user.all.product') }}">
            <div class="category-page-layout">
                <input type="hidden" name="query" value="{{ $search}}">

                <aside class="filter-sidebar">
                    <button class="sidebar-toggle-off-btn" type="button" onclick="toggleSidebar()">X</button>
                    <h3>Filter By</h3>

                    {{-- <!-- Subcategories -->
                    <div class="filter-group">
                        <h4>Sub Categories</h4>
                        <ul class="filter-list">
                            @foreach ($category->subcategories as $subcategory)
                                <li>
                                    <label>
                                        <input type="checkbox" name="subcategories[]" value="{{ $subcategory->slug }}"
                                            {{ in_array($subcategory->slug, request()->get('subcategories', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        {{ $subcategory->subcategory_name }} ({{ $subcategory->products->count() }})
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div> --}}

                    <!-- Price Range -->
                    <div class="filter-group">
                        <h4>Price Range</h4>
                        <div class="price-input-range">
                            <input type="number" name="min_price" placeholder="Min" aria-label="Minimum price"
                                value="{{ request('min_price') }}">
                            <span>-</span>
                            <input type="number" name="max_price" placeholder="Max" aria-label="Maximum price"
                                value="{{ request('max_price') }}">
                            <button class="btn btn-outline-primary btn-sm" type='submit'>Go</button>


                        </div>
                    </div>

                    <!-- Brands -->
                    <div class="filter-group">
                        <h4>Brands</h4>
                        {{-- <input type="text" placeholder="Search Brands" class="filter-search-input" aria-label="Search brands" name/> --}}
                        <ul class="filter-list">
                            @foreach ($brands as $brand)
                                <li>
                                    <label>
                                        <input type="checkbox" name="brands[]" value="{{ $brand->slug }}"
                                            {{ in_array($brand->slug, request()->get('brands', [])) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        {{ $brand->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- <button type="submit" class="btn btn-primary apply-filters-button">Apply Filters</button> --}}
                </aside>



                <section class="product-listing-content">

                    {{-- <div class="category-content-header">
                        <h1>{{ $category->category_name }}</h1>
                        <div class="sidebar-toggle-btn" onclick="toggleSidebar()">
                            <i class="fas fa-filter"></i>
                        </div>

                    </div> --}}
                    <div style="margin-bottom: 20px;"> 
                        Search Result for "{{ $search }}"
                    <div>

                    <div class="sort-view-options">
                        <div class="sort-options">
                            <label for="sort-by">Sort By:</label>
                            <select id="sort-by" name="sort" onchange="this.form.submit()">
                                <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default
                                </option>
                                <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Price: Low
                                    to High</option>
                                <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price:
                                    High to Low</option>
                                <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Name: A to Z
                                </option>
                                <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Name: Z to
                                    A</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals
                                </option>
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
                        @if ($products->isEmpty())
                        <div class="no-products-message">
                            <h2 class="text-2xl font-semibold text-gray-600">No products found.</h2>
                            <p class="mt-2 text-gray-500">Try adjusting your filters or explore other categories.</p>
                        </div>
                        
                        @else
                        @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach

                        @endif
                       



                    </div>

                </section>

            </div>
        </form>

        <div class="d-flex justify-content-end mt-3">
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.filter-sidebar');
            sidebar.classList.toggle('active');
        }
    </script>

@endsection
