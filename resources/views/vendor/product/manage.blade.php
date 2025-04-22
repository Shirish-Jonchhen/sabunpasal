@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Manage Product - Vendor')

@section('vendor_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Products</h5>
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
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session('success') }}
                        </div>
                    @endif

                    <livewire:vendor.product-manager />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Sub Category</th>
                                    <th scope="col">Store</th>
                                    {{-- <th scope="col">Regular Price</th>
                                    <th scope="col">Discounted Price</th> --}}
                                    <th scope="col">Tax(%)</th>
                                    {{-- <th scope="col">Quantity</th> --}}
                                    <th scope="col">Stock Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Visibility</th>
                                    <th scope="col">On Sale</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td> {{ $product->id }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>
                                            @if ($product->images && $product->images->count() > 0)
                            
                                                @foreach ($product->images as $image)
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image"
                                                        width="50">
                                                @endforeach
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>{{ $product->subcategory->subcategory_name }}</td>
                                        <td>{{ $product->store->store_name }}</td>
                                        {{-- <td>{{ $product->regular_price }}</td> --}}
                                        {{-- <td>{{ $product->discounted_price }}</td> --}}
                                        <td>{{ $product->tax_rate }}</td>
                                        {{-- <td>{{ $product->stock_quantity }}</td> --}}
                                        <td>{{ $product->stock_status }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->visibility }}</td>
                                        <td>{{ $product->is_on_sale }}</td>
                                        <td>
                                            <a href="{{ route('vendor.product.show', $product->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route('vendor.product.delete', $product->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                            {{-- <a href="#" class="btn btn-danger btn-sm">Delete</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection