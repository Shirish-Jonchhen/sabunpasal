@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Edit Product Variant - Vendor')

@section('vendor_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Product Variant</h5>
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
                    <form action="{{ route('vendor.update.product.variant', $product_variant->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="product_id" class="form-label fw-bold mb-2">Product Name</label>
                        <input type="text" class="form-control mb-2" name="product_id" placeholder="Harpic 750Ml" value="{{ $product_variant->product->product_name }}" readonly>

                        <label for="attribute_id" class="form-label fw-bold mb-2">Product Attribute</label>
                        <input type="text" class="form-control mb-2" name="product_id" placeholder="Harpic 750Ml" value="{{ $product_variant->attribute->attribute_value }}" readonly>

                        <label class="form-label fw-bold mb-2">Product Images</label>
                        <div class="mb-3">
                            <!-- Show existing images -->
                            <div id="image-container" class="d-flex flex-wrap gap-3">
                                @foreach($product_variant->product->images as $image)
                                    <div class="position-relative image-wrapper"
                                        style="width: 150px; height: 200px; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image"
                                            class="img-thumbnail object-fit-contain" style="max-width: 100%; max-height: 100%;">
                                
                                    </div>
                                @endforeach
                            </div>
                            
                            
                        <label for="regular_price	" class="form-label fw-bold mb-2">Regular Price</label>
                        <input type="number" class="form-control mb-2" name="regular_price" placeholder="100.00" value="{{ $product_variant->regular_price }}">

                        <label for="discounted_price" class="form-label fw-bold mb-2">Discounted Price</label>
                        <input type="number" class="form-control mb-2" name="discounted_price" placeholder="50.00" value="{{ $product_variant->discounted_price }}">

                        <label for="stock_quantity	" class="form-label fw-bold mb-2">Stock Quantity</label>
                        <input type="number" class="form-control mb-2" name="stock_quantity" placeholder="500" value="{{ $product_variant->stock_quantity }}">

                        <button type="submit" class="btn btn-primary w-100">Add Product Varient</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection