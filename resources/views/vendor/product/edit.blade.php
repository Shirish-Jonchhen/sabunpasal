@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Create Product - Vendor')

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
                            {{-- <ul type="none"> --}}
                                @foreach ($errors->all() as $error)
                                    {{-- <li> --}}
                                        *{{ $error }} <br>
                                        {{-- </li> --}}
                                @endforeach
                                {{-- </ul> --}}
                        </div>
                    @endif
                    @if (session("success"))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session("success") }}
                        </div>
                    @endif
                    <form action="{{ route('vendor.update.product', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label for="product_name" class="form-label fw-bold mb-2">Product Name</label>
                        <input type="text" class="form-control mb-2" name="product_name" placeholder="Harpic 750Ml"
                            value="{{ $product->product_name }}">

                        <label class="form-label fw-bold mb-2">Product Images</label>
                        <div class="mb-3">
                            <!-- Show existing images -->
                            <div id="image-container" class="d-flex flex-wrap gap-3">
                                @foreach($product->images as $image)
                                    <div class="position-relative image-wrapper"
                                        style="width: 150px; height: 200px; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image"
                                            class="img-thumbnail object-fit-contain" style="max-width: 100%; max-height: 100%;">
                                        <button type="button"
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-image"
                                            data-image-id="{{ $image->id }}">✖</button>
                                    </div>
                                @endforeach
                            </div>


                            <!-- Hidden field to track deleted images -->
                            <input type="hidden" name="deleted_images" id="deleted-images" value="">


                            <label class="form-label fw-bold mb-2">Add New Images</label>
                            <input type="file" name="new_images[]" id="image-input" multiple class="form-control mb-2">


                            <label for="description" class="form-label fw-bold mb-2">Product Description</label>
                            <textarea class="form-control mb-2" name="description" placeholder="Describe your product"
                                rows="10">{{ $product->description }}</textarea>

                            {{-- <label for="images" class="form-label fw-bold mb-2">Product Images</label>
                            <input type="file" class="form-control mb-2" name="images[]" multiple> --}}


                            <label for="sku" class="form-label fw-bold mb-2">SKU</label>
                            <input readonly type="text" class="form-control mb-2" name="sku" placeholder="SKU"
                                value="{{ $product->sku }}">

                            <label for="category_id" class="form-label fw-bold mb-2">Product Category</label>
                            <input readonly type="text" class="form-control mb-2" name="category_id" placeholder="SKU"
                                value="{{ $product->category->category_name }}">

                            {{-- <livewire:category-subcategory /> --}}

                            <label for="subcategory_id" class="form-label fw-bold mb-2">Product Subcategory</label>
                            <input readonly type="text" class="form-control mb-2" name="subcategory_id" placeholder="SKU"
                                value="{{ $product->subcategory->subcategory_name }}">

                            {{-- <livewire:category-subcategory /> --}}

                            <label for="store_id" class="form-label fw-bold mb-2">Product Store</label>
                            <input readonly type="text" class="form-control mb-2" name="store_id" placeholder="SKU"
                                value="{{ $product->store->store_name }}">



                            <label for="regular_price	" class="form-label fw-bold mb-2">Regular Price</label>
                            <input type="number" class="form-control mb-2" name="regular_price" placeholder="100.00"
                                value="{{ $product->regular_price }}">

                            <label for="discounted_price" class="form-label fw-bold mb-2">Discounted Price</label>
                            <input type="number" class="form-control mb-2" name="discounted_price" placeholder="50.00"
                                value="{{ $product->discounted_price }}">

                            <label for="tax_rate" class="form-label fw-bold mb-2">Tax Rate</label>
                            <input type="number" class="form-control mb-2" name="tax_rate" placeholder="13"
                                value="{{ $product->tax_rate }}">

                            <label for="stock_quantity" class="form-label fw-bold mb-2">Stock Quantity</label>
                            <input type="number" class="form-control mb-2" name="stock_quantity" placeholder="500"
                                value="{{ $product->stock_quantity }}">

                            <label for="stock_status" class="form-label fw-bold mb-2">Stock Status</label>
                            <select class="form-control mb-2" name="stock_status" id="stock_status">
                                <option value="In Stock" {{ $product->stock_status == 'In Stock' ? 'selected' : '' }}>In Stock
                                </option>
                                <option value="Out of Stock" {{ $product->stock_status == 'Out of Stock' ? 'selected' : '' }}>
                                    Out
                                    of Stock</option>
                            </select>

                            <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                            <input readonly type="text" class="form-control mb-2" name="slug" placeholder="demo"
                                value="{{ $product->slug }}">

                            <label class="form-label fw-bold mb-2" for="visibility">
                                Visible
                            </label><br>
                            <input class="mb-2" type="checkbox" name="visibility" id="visibility" value="1" {{ $product->visibility ? 'checked' : '' }}> <br>


                            <label for="meta_title" class="form-label fw-bold mb-2">Meta Title</label>
                            <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta Titles"
                                value="{{ $product->meta_title }}">

                            <label for="meta_description" class="form-label fw-bold mb-2">Meta Description</label>
                            <input type="text" class="form-control mb-2" name="meta_description"
                                placeholder="Meta Descriptions" value="{{ $product->meta_description }}">



                            <label for="status" class="form-label fw-bold mb-2">Status:</label>
                            <select class="form-control mb-2" name="status" id="status">
                                <option value="Draft" {{ $product->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Published" {{ $product->status == 'Published' ? 'selected' : '' }}>Published
                                </option>
                            </select>




                            <button type="submit" class="btn btn-primary w-100">Update Product</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            let deletedImages = [];

            // Remove existing images
            document.querySelectorAll('.remove-image').forEach(button => {
                button.addEventListener('click', function () {
                    let imageWrapper = this.closest('.image-wrapper');
                    let imageId = this.dataset.imageId;

                    if (imageWrapper) {
                        imageWrapper.remove(); // Remove from UI
                        deletedImages.push(imageId); // Store ID for backend
                        document.getElementById('deleted-images').value = deletedImages.join(',');
                    }
                });
            });

            // Preview newly added images
            document.getElementById('image-input').addEventListener('change', function (event) {
                let previewContainer = document.getElementById('new-image-preview');
                previewContainer.innerHTML = ""; // Clear previous previews

                Array.from(event.target.files).forEach(file => {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        let imgWrapper = document.createElement('div');
                        imgWrapper.classList.add('position-relative', 'image-wrapper');
                        imgWrapper.style.width = '150px';
                        imgWrapper.style.height = '200px';
                        imgWrapper.style.display = 'flex';
                        imgWrapper.style.alignItems = 'center';
                        imgWrapper.style.justifyContent = 'center';

                        imgWrapper.innerHTML = `
                                                <img src="${e.target.result}" class="img-thumbnail object-fit-contain" style="max-width: 100%; max-height: 100%;">
                                            `;

                        previewContainer.appendChild(imgWrapper);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
@endsection