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
                    <form action="{{ route('vendor.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <label for="product_name" class="form-label fw-bold mb-2">Product Name</label>
                        <input type="text" class="form-control mb-2" name="product_name" placeholder="Harpic 750Ml">

                        <label for="description" class="form-label fw-bold mb-2">Product Description</label>
                        <textarea class="form-control mb-2" name="description" placeholder="Describe your product"
                            rows="10"></textarea>

                        <label for="images" class="form-label fw-bold mb-2">Product Images</label>
                        <input type="file" class="form-control mb-2" name="images[]" multiple>


                        <label for="sku" class="form-label fw-bold mb-2">SKU</label>
                        <input type="text" class="form-control mb-2" name="sku" placeholder="SKU">

                        <livewire:category-subcategory /> 

                        <label for="store_id" class="form-label fw-bold mb-2">Product Store</label>
                        <select class="form-control mb-2" name='store_id'>
                            <option value="">Select a Store</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                            @endforeach
                        </select>

                        {{-- <label for="regular_price	" class="form-label fw-bold mb-2">Regular Price</label>
                        <input type="number" class="form-control mb-2" name="regular_price" placeholder="100.00"> --}}
{{-- 
                        <label for="discounted_price" class="form-label fw-bold mb-2">Discounted Price</label>
                        <input type="number" class="form-control mb-2" name="discounted_price" placeholder="50.00"> --}}

                        <label for="tax_rate" class="form-label fw-bold mb-2">Tax Rate</label>
                        <input type="number" class="form-control mb-2" name="tax_rate" placeholder="13">

                        {{-- <label for="stock_quantity	" class="form-label fw-bold mb-2">Stock Quantity</label>
                        <input type="number" class="form-control mb-2" name="stock_quantity" placeholder="500"> --}}

                        <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                        <input type="text" class="form-control mb-2" name="slug" placeholder="demo">


                        <label for="meta_title" class="form-label fw-bold mb-2">Meta Title</label>
                        <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta Titles">

                        <label for="meta_description" class="form-label fw-bold mb-2">Meta Description</label>
                        <input type="text" class="form-control mb-2" name="meta_description"
                            placeholder="Meta Descriptions">







                        <button type="submit" class="btn btn-primary w-100">Add Product</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection