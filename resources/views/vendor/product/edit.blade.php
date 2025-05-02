@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Edit Product - Vendor')

@section('vendor_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Product</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show">
                            @foreach ($errors->all() as $error)
                                *{{ $error }} <br>
                            @endforeach
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissable fade show">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('vendor.update.product', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label class="form-label fw-bold mb-2">Product Name</label>
                        <input type="text" class="form-control mb-2" name="product_name" value="{{ $product->name }}"
                            placeholder="Harpic 750Ml">

                        <label class="form-label fw-bold mb-2">Product Description</label>
                        <textarea class="form-control mb-2" name="description" rows="5" placeholder="Describe your product">{{ $product->description }}</textarea>

                        <label class="form-label fw-bold mb-2">SKU</label>
                        <input type="text" class="form-control mb-2" name="sku" value="{{ $product->sku }}"
                            placeholder="SKU">


                        <label class="form-label fw-bold mb-2">Category</label>
                        <input type="text" class="form-control mb-2" name="category_name"
                            value="{{ $product->brand->name }}" placeholder="Brand Name" readonly>
                        <input type="hidden" class="form-control mb-2" name="category_id" value="{{ $product->brand->id }}"
                            readonly>

                        <label class="form-label fw-bold mb-2">Sub Category</label>
                        <input type="text" class="form-control mb-2" name="sub_category_name"
                            value="{{ $product->category->category_name }}" readonly>
                        <input type="hidden" class="form-control mb-2" name="brand_id"
                            value="{{ $product->category->id }}" readonly>

                        <label class="form-label fw-bold mb-2">Brand</label>
                        <input type="text" class="form-control mb-2" name="brand_name"
                            value="{{ $product->subcategory->subcategory_name }}" readonly>
                        <input type="hidden" class="form-control mb-2" name="subcategory_id"
                            value="{{ $product->subcategory->id }}" readonly>

                        <label class="form-label fw-bold mb-2">Store</label>
                        <input type="text" class="form-control mb-2" name="store_name"
                            value="{{ $product->store->store_name }}" readonly>
                        <input type="hidden" class="form-control mb-2" name="store_id" value="{{ $product->store->id }}"
                            readonly>

                        <label class="form-label fw-bold mb-2">Tax Rate</label>
                        <input type="number" class="form-control mb-2" name="tax_rate" value="{{ $product->tax_rate }}"
                            placeholder="13">

                        <label class="form-label fw-bold mb-2">Meta Title</label>
                        <input type="text" class="form-control mb-2" name="meta_title"
                            value="{{ $product->meta_title }}" placeholder="Meta Title">

                        <label class="form-label fw-bold mb-2">Meta Description</label>
                        <input type="text" class="form-control mb-2" name="meta_description"
                            value="{{ $product->meta_description }}" placeholder="Meta Description">

                        <!-- Product Variants -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Variants</h5>
                            </div>
                            <div class="card-body" id="variant-section">
                                @foreach ($product->variants as $variantIndex => $variant)
                                    <div class="variant-group mb-4">
                                        
                                        <label class="form-label fw-bold mb-2">Flavor</label>
                                        <input type="text" class="form-control mb-2"
                                            name="variants[{{ $variantIndex }}][flavor]"
                                            value="{{ $variant->variant_name }}" placeholder="Flavor (e.g., Lavender)">

                                        <label class="form-label fw-bold mb-2">Size</label>
                                        <input type="text" class="form-control mb-2"
                                            name="variants[{{ $variantIndex }}][size]" value="{{ $variant->size }}"
                                            placeholder="Size (e.g., 750ml)">

                                        <label class="form-label fw-bold mb-2">Variant Images</label>
                                        <input type="file" class="form-control mb-3"
                                            name="variants[{{ $variantIndex }}][images][]" multiple>

                                        <label class="form-label fw-bold mb-2">Existing Images</label>
                                        <div class="row existing-images mb-3" data-variant="{{ $variantIndex }}">
                                            @if ($variant->images->isEmpty())
                                                <p>  No existing images</p>
                                            @else
                                            @foreach ($variant->images as $imageIndex => $image)
                                            <div class="col-md-3 mb-2 existing-image-wrapper"
                                                data-image-id="{{ $image->id }}">
                                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                                    class="img-thumbnail" style="height:100px; object-fit:contain;">
                                                <input type="hidden"
                                                    name="variants[{{ $variantIndex }}][existing_images][]"
                                                    value="{{ $image->image_path }}">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger btn-block mt-1 remove-existing-image">x</button>
                                            </div>
                                        @endforeach
                                            @endif
                                           
                                        </div>

                                        <div class="variant-prices d-flex mb-2" data-variant="{{ $variantIndex }}">
                                            @foreach ($variant->prices as $priceIndex => $price)
                                                <div class="price-row mb-2 mx-1 ">
                                                    <select class="form-control mb-2"
                                                        name="variants[{{ $variantIndex }}][prices][{{ $priceIndex }}][unit]">
                                                        <option value="">Select Unit</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                {{ $price->unit_id == $unit->id ? 'selected' : '' }}>
                                                                {{ $unit->attribute_value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="number" class="form-control mb-2"
                                                        name="variants[{{ $variantIndex }}][prices][{{ $priceIndex }}][price]"
                                                        value="{{ $price->price }}" placeholder="Price">
                                                    <input type="number" class="form-control mb-2"
                                                        name="variants[{{ $variantIndex }}][prices][{{ $priceIndex }}][stock]"
                                                        value="{{ $price->stock }}" placeholder="Stock">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-price">Remove Price</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-info btn-sm mb-4"
                                            onclick="addPriceRow({{ $variantIndex }})">Add Price</button> <br>
                                        <button type="button" class="btn btn-danger btn-md remove-variant">Remove Variant</button>
                                        <hr>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-primary mt-2" onclick="addVariant()">Add
                                Variant</button>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const units = @json($units);
        let variantCount = {{ count($product->variants) }};

        function addVariant() {
            const section = document.getElementById('variant-section');
            const div = document.createElement('div');
            div.classList.add('variant-group', 'mb-4');
            div.innerHTML = `
                <label class="form-label fw-bold mb-2">Flavor</label>
                <input type="text" class="form-control mb-2" name="variants[${variantCount}][flavor]" placeholder="Flavor (e.g., Lavender)">

                <label class="form-label fw-bold mb-2">Size</label>
                <input type="text" class="form-control mb-2" name="variants[${variantCount}][size]" placeholder="Size (e.g., 750ml)">

                <label class="form-label fw-bold mb-2">Variant Images</label>
                <input type="file" class="form-control mb-3" name="variants[${variantCount}][images][]" multiple>

                <div class="variant-prices mb-2 d-flex" data-variant="${variantCount}">
                    ${generatePriceRow(variantCount, 0)}
                </div>
                <button type="button" class="btn btn-info btn-sm mb-2" onclick="addPriceRow(${variantCount})">Add Price</button>
                <button type="button" class="btn btn-danger btn-sm remove-variant">Remove Variant</button>
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
                <div class="price-row mx-1 mb-2">
                    <select class="form-control mb-2" name="variants[${variantIndex}][prices][${priceIndex}][unit]">
                        ${unitOptions}
                    </select>
                    <input type="number" class="form-control mb-2" name="variants[${variantIndex}][prices][${priceIndex}][price]" placeholder="Price">
                    <input type="number" class="form-control mb-2" name="variants[${variantIndex}][prices][${priceIndex}][stock]" placeholder="Stock">
                    <button type="button" class="btn btn-danger btn-sm remove-price">Remove Price</button>
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
        document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-existing-image')) {
            const wrapper = e.target.closest('.existing-image-wrapper');
            wrapper.remove();
        }
    });
    </script>
@endsection
