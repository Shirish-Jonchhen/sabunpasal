@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Create Product Variant - Vendor')

@section('vendor_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add Product Variant</h5>
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
                    <form action="{{ route('vendor.product.variant.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <label for="product_id" class="form-label fw-bold mb-2">Product Name</label>
                        <select class="form-control mb-2" name='product_id'>
                            <option value="">Select a Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->id }} - {{ $product->product_name }} - {{$product->store->store_name}}</option>
                            @endforeach
                        </select>

                        <label for="attribute_id" class="form-label fw-bold mb-2">Product Attribute</label>
                        <select class="form-control mb-2" name='attribute_id'>
                            <option value="">Select a Attribute</option>
                            @foreach($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->attribute_value }}</option>
                            @endforeach
                        </select>

                        <label for="regular_price	" class="form-label fw-bold mb-2">Regular Price</label>
                        <input type="number" class="form-control mb-2" name="regular_price" placeholder="100.00">

                        <label for="discounted_price" class="form-label fw-bold mb-2">Discounted Price</label>
                        <input type="number" class="form-control mb-2" name="discounted_price" placeholder="50.00">

                        <label for="stock_quantity	" class="form-label fw-bold mb-2">Stock Quantity</label>
                        <input type="number" class="form-control mb-2" name="stock_quantity" placeholder="500">

                        <button type="submit" class="btn btn-primary w-100">Add Product Varient</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection