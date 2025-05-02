@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Create Product - Vendor')

@section('vendor_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add Product</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show">
                            @foreach ($errors->all() as $error)
                                *{{ $error }} <br>
                            @endforeach
                        </div>
                    @endif
                    @if (session("success"))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session("success") }}
                        </div>
                    @endif

                    @if (session("error"))
                        <div class="alert alert-danger alert-dismissable fade show">
                            {{ session("error") }}
                        </div>
                    @endif

                    <form action="{{ route('vendor.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <label class="form-label fw-bold mb-2">Product Name</label>
                        <input type="text" class="form-control mb-2" name="product_name" placeholder="Harpic 750Ml">

                        <label class="form-label fw-bold mb-2">Product Description</label>
                        <textarea class="form-control mb-2" name="description" rows="5" placeholder="Describe your product"></textarea>

                        <label class="form-label fw-bold mb-2">SKU</label>
                        <input type="text" class="form-control mb-2" name="sku" placeholder="SKU">

                        <!-- Livewire Category -->
                        <livewire:category-subcategory />

                        <label class="form-label fw-bold mb-2">Brand</label>
                        <select class="form-control mb-2" name="brand_id">
                            <option value="">Select a Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>

                        <label class="form-label fw-bold mb-2">Product Store</label>
                        <select class="form-control mb-2" name="store_id">
                            <option value="">Select a Store</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                            @endforeach
                        </select>

                        <label class="form-label fw-bold mb-2">Tax Rate</label>
                        <input type="number" class="form-control mb-2" name="tax_rate" placeholder="13">

                        <label class="form-label fw-bold mb-2">Meta Title</label>
                        <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta Title">

                        <label class="form-label fw-bold mb-2">Meta Description</label>
                        <input type="text" class="form-control mb-2" name="meta_description" placeholder="Meta Description">

                        <!-- Product Variants -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title mb-1">Product Variants</h5>
                            </div>
                            <div class="card-body" id="variant-section">
                                <!-- Initial Variant -->
                            </div>
                            <button type="button" class="btn btn-primary btn-md mx-4 mb-4  mt-2" onclick="addVariant()">Add Variant</button>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const units = @json($units);
        let variantCount = 0;

        function addVariant() {
            const section = document.getElementById('variant-section');

            const div = document.createElement('div');
            div.classList.add('variant-group', 'mb-2');
            div.innerHTML = `
                <label class="form-label fw-bold mb-2">Flavor</label>
                <input type="text" class="form-control mb-2" name="variants[${variantCount}][flavor]" placeholder="Flavor (e.g., Lavender)">

                <label class="form-label fw-bold mb-2">Size</label>
                <input type="text" class="form-control mb-2" name="variants[${variantCount}][size]" placeholder="Size (e.g., 750ml)">

                <label class="form-label fw-bold mb-2">Variant Images</label>
                <input type="file" class="form-control mb-3" name="variants[${variantCount}][images][]" multiple>

                <div class="d-flex variant-prices mb-2" data-variant="${variantCount}">
                    ${generatePriceRow(variantCount, 0)}
                </div>
                <button type="button" class="btn btn-info btn-sm mb-4" onclick="addPriceRow(${variantCount})">Add Price</button> <br>
               

                <button type="button" class="btn btn-danger btn-md remove-variant">Remove Variant</button>
                    <hr>
            `;

            section.appendChild(div);
            variantCount++;
        }

        function generatePriceRow(variantIndex, priceIndex) {
            let unitOptions = `<option value="">Select Unit</option>`;
            units.forEach(unit => {
                unitOptions += `<option value="${unit.id}">${unit.attribute_value}</option>`;
            });

            return `
                <div class="price-row mb-2 mx-1">
                    <select class="form-control mb-2" name="variants[${variantIndex}][prices][${priceIndex}][unit]">
                        ${unitOptions}
                    </select>
                    <input type="number" class="form-control mb-2" name="variants[${variantIndex}][prices][${priceIndex}][price]" placeholder="Price">
                    <input type="number" class="form-control mb-2" name="variants[${variantIndex}][prices][${priceIndex}][stock]" placeholder="Stock">
                    <button type="button" class="btn btn-danger btn-sm remove-price mb-1">Remove Price</button>
                    
                </div>
            `;
        }

        function addPriceRow(variantIndex) {
            const priceWrapper = document.querySelector(`.variant-prices[data-variant="${variantIndex}"]`);
            const newIndex = priceWrapper.querySelectorAll('.price-row').length;
            priceWrapper.insertAdjacentHTML('beforeend', generatePriceRow(variantIndex, newIndex));
        }

        // Remove Variant
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-variant')) {
                e.target.closest('.variant-group').remove();
            }
        });

        // Remove Price
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-price')) {
                e.target.closest('.price-row').remove();
            }
        });

        // Initialize first variant
        window.onload = () => {
            addVariant();
        };
    </script>
@endsection
